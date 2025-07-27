<?php

namespace App\Services;

use App\Action\UploadMediaFileAction;
use App\Jobs\SendNewsletterToSubscriberJob;
use App\Models\Newsletters;
use App\Models\NewsletterSubscriber;
use App\ValueObjects\EmailAddress;
use App\Services\EmailValidatorService;
use App\DTO\SubscriptionResult;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\QueryException;

class NewsletterService
{
    protected EmailAddress $emailAddress;

    public function __construct(protected EmailValidatorService $validator) {}

    public function subscribe(string $email, bool $skipValidation = true): SubscriptionResult
    {
        try {
            $this->emailAddress = new EmailAddress($email);

            if (! $skipValidation) {
                $result = $this->validator->validate($this->emailAddress);
                if (! $result['valid']) {
                    return new SubscriptionResult(false, $result['message']);
                }
            }

            if ($this->isAlreadySubscribed()) {
                return new SubscriptionResult(false, 'البريد مشترك مسبقًا.');
            }

            NewsletterSubscriber::create([
                'email' => $this->emailAddress->getAddress(),
            ]);

            Cache::forget('subscribed_' . md5($email));

            return new SubscriptionResult(true, 'تم الاشتراك بنجاح!');
        } catch (QueryException $e) {
            Log::error('Database error during newsletter subscription', ['error' => $e->getMessage()]);
            return new SubscriptionResult(false, 'حدث خطأ أثناء حفظ البريد. يرجى المحاولة لاحقًا.');
        } catch (Exception $e) {
            Log::error($e);
            return new SubscriptionResult(false, 'لم نتمكن من معالجة الطلب. البريد غير صالح أو غير مدعوم.');
        }
    }


    protected function isAlreadySubscribed(): bool
    {
        $key = 'subscribed_' . md5($this->emailAddress->getAddress());

        return Cache::remember($key, now()->addMinutes(10), function () {
            return NewsletterSubscriber::where('email', $this->emailAddress->getAddress())->exists();
        });
    }

    public function getValidator(): EmailValidatorService
    {
        return $this->validator;
    }


    public function getSubscribers(int $perPage = 15)
    {
        return NewsletterSubscriber::orderByDesc('created_at')->paginate($perPage);

    }
    public function getLetters(int $perPage = 15)
    {
        return Newsletters::orderByDesc('created_at')->paginate($perPage);

    }

    public function delete(int $id): SubscriptionResult
    {
        try {
            $subscriber = NewsletterSubscriber::findOrFail($id);
            Cache::forget('subscribed_' . md5($subscriber->email));
            $subscriber->delete();

            return new SubscriptionResult(true, 'تم حذف الاشتراك بنجاح.');
        } catch (ModelNotFoundException $e) {
            return new SubscriptionResult(false, 'المشترك غير موجود.');
        } catch (Exception $e) {
            Log::error('Newsletter deletion failed', ['error' => $e->getMessage()]);
            return new SubscriptionResult(false, 'حدث خطأ أثناء الحذف. يرجى المحاولة لاحقًا.');
        }
    }

    public function store(array $data): SubscriptionResult
    {
        $image = $data['image'] ?? null;
        unset($data['image']);
        try {
            DB::beginTransaction();

            $newsletter = Newsletters::create([
                'title'     => $data['title'],
                'body'      => $data['body'],
                'cta_label' => $data['cta_label'] ?? null,
                'cta_url'   => $data['cta_url'] ?? null,
                'send_at' => isset($data['send_at'])
                    ? Carbon::parse($data['send_at'], 'Asia/Damascus')->setTimezone('UTC')
                    : null,
                'repeat_type'     => $data['repeat_type'] ?? 'none',
                'repeat_interval' => $data['repeat_interval'] ?? 1,
            ]);

            if ($image) {
                app(UploadMediaFileAction::class)->execute($newsletter, $image, 'newsletters');
            }

            DB::commit();
            return new SubscriptionResult(true, 'Newsletter saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Failed to save newsletter', ['error' => $e->getMessage(), 'data' => $data]);
            return new SubscriptionResult(false, 'An error occurred while saving the newsletter. Please try again later.');
        }
    }


    public function deleteLetters(int $id): SubscriptionResult
    {
        try {
            $newsletter = Newsletters::findOrFail($id);
            $newsletter->delete();

            return new SubscriptionResult(true, 'Newsletter deleted successfully.');
        } catch (ModelNotFoundException) {
            return new SubscriptionResult(false, 'Newsletter not found.');
        } catch (Exception $e) {
            Log::error('Newsletter deletion failed', ['error' => $e->getMessage()]);
            return new SubscriptionResult(false, 'An error occurred while deleting. Please try again later.');
        }
    }

    public function find(int $id): ?Newsletters
    {
        return Newsletters::find($id); // مرن ولا يرمي استثناء، مفيد للعرض فقط
    }


    public function update(int $id, array $data): SubscriptionResult
    {
        $image = $data['image'] ?? null;
        unset($data['image']);
        try {
            DB::beginTransaction();

            $newsletter = Newsletters::findOrFail($id);

            $newsletter->update([
                'title'           => $data['title'],
                'body'            => $data['body'],
                'cta_label'       => $data['cta_label'] ?? null,
                'cta_url'         => $data['cta_url'] ?? null,
                'send_at' => isset($data['send_at'])
                    ? Carbon::parse($data['send_at'], 'Asia/Damascus')->setTimezone('UTC')
                    : null,
                'repeat_type'     => $data['repeat_type'] ?? 'none',
                'repeat_interval' => $data['repeat_interval'] ?? 1,
            ]);


            if ($image) {
                app(UploadMediaFileAction::class)->execute($newsletter, $image, 'newsletters');
            }

            DB::commit();
            return new SubscriptionResult(true, 'Newsletter updated successfully.');
        } catch (ModelNotFoundException) {
            return new SubscriptionResult(false, 'Newsletter not found.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Failed to update newsletter', ['error' => $e->getMessage(), 'data' => $data]);
            return new SubscriptionResult(false, 'An error occurred while updating the newsletter. Please try again later.');
        }
    }

    public function processAll(): void
    {
        $this->sendSingleNewsletters();
        $this->sendRecurringNewsletters();
    }

    public function sendSingleNewsletters(): void
    {
        $now = now()->setTimezone('UTC');

        Newsletters::where('is_sent', false)
            ->whereNotNull('send_at')
            ->where('send_at', '<=', $now)
            ->where(function ($query) {
                $query->whereNull('repeat_type')
                    ->orWhere('repeat_type', 'none');
            })

            ->each(function ($newsletter) {
                try {
                    $this->dispatch($newsletter->id);

                } catch (\Exception $e) {
                    Log::error("فشل إرسال النشرة الفردية رقم [{$newsletter->id}]: {$e->getMessage()}");
                }
            });
    }

    public function sendRecurringNewsletters(): void
    {
        $now = now()->setTimezone('UTC');
        Newsletters::whereNotNull('next_send_at')
            ->where('next_send_at', '<=', $now)
            ->where('repeat_type', '!=', 'none')
            ->each(function ($newsletter) {
                try {
                    $this->dispatch($newsletter->id);

                    $newsletter->next_send_at = $newsletter->calculateNextSendAtFrom($newsletter->next_send_at);
                    $newsletter->save();
                } catch (\Exception $e) {
                    Log::error("فشل إرسال النشرة المتكررة رقم [{$newsletter->id}]: {$e->getMessage()}");
                }
            });
    }

    public function dispatch(int $newsletterId): bool
    {
        try {
            $newsletter = Newsletters::findOrFail($newsletterId);
        } catch (ModelNotFoundException $e) {
            Log::error("النشرة رقم [{$newsletterId}] غير موجودة.");
            return false; // أو يمكن return null لإعطاء مرونة أكثر
        }

        NewsletterSubscriber::select(['email'])
            ->chunk(100, function ($subscribers) use ($newsletter) {
                foreach ($subscribers as $subscriber) {
                    SendNewsletterToSubscriberJob::dispatch($subscriber->email, $newsletter);
                }
            });

        $newsletter->update(['is_sent' => true]);

        Log::info("Newsletter [{$newsletterId}] تم إرسالها لجميع المشتركين.");

        return true;
    }



}

