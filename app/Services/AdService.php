<?php

namespace App\Services;

use App\Action\UploadMediaFileAction;
use App\Exceptions\MediaUploadException;
use App\Models\Ad;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use RuntimeException;

class AdService
{

    protected UploadMediaFileAction $mediaUploader;

    public function __construct(UploadMediaFileAction $mediaUploader)
    {
        $this->mediaUploader = $mediaUploader;
    }

    public function getPaginatedAds(int $limit = 6): LengthAwarePaginator
    {
        try {
            return Ad::latest()->paginate($limit);
        } catch (\Throwable $e) {
            Log::error('فشل استرجاع الإعلانات: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            // بديل آمن في حال الخطأ
            return Ad::whereNull('id')->paginate($limit);
        }
    }

    public function createAd(array $data): bool
    {
        $image = $data['image'] ?? null;
        unset($data['image']);

        try {
            DB::beginTransaction();

            $ad = Ad::create($data);

            $this->mediaUploader->execute($ad, $image, 'ad');

            DB::commit();
            cache()->forget('ads:by_position');

            return true;

        } catch (\Throwable $e) {
            DB::rollBack();

            // ✅ إذا كان الخطأ من نوع MediaUploadException، نعيده كما هو
            if ($e instanceof MediaUploadException) {
                throw $e;
            }
            Log::error('فشل إنشاء إعلان جديد', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);
            throw new \Exception('Ad created failed, please try again later.');
        }
    }


    public function updateAd(Ad $ad, array $data): bool
    {
        $image = $data['image'] ?? null;
        unset($data['image']);

        try {
            DB::beginTransaction();

            $ad->update($data);

            // ديناميكي عبر الـ Trait + Action العامة
            $this->mediaUploader->execute($ad, $image, 'ad');

            DB::commit();
            cache()->forget('ads:by_position');
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            // ✅ إذا كان الخطأ من نوع MediaUploadException، نعيده كما هو
            if ($e instanceof MediaUploadException) {
                throw $e;
            }
            Log::error('فشل تعديل الإعلان', ['error' => $e->getMessage()]);
            throw new \Exception('Ad update failed, please try again later.');
        }
    }

    public function deleteAd(Ad $ad): bool
    {
        try {
            // يمكن إضافة حذف الميديا يدويًا إن لم يكن تلقائيًا
            $ad->clearMediaCollection('ad');

            $ad->delete();
            cache()->forget('ads:by_position');
            return true;
        } catch (\Throwable $e) {
            Log::error('فشل حذف الإعلان', ['error' => $e->getMessage()]);
            return false;
        }
    }

    public function registerClick(Ad $ad): void
    {
        try {
            // يمكن لاحقًا تسجيل IP أو نوع الجهاز هنا
            $ad->increment('clicks');
        } catch (\Throwable $e) {
            Log::warning('فشل زيادة عدد النقرات', [
                'ad_id' => $ad->id,
                'error' => $e->getMessage(),
            ]);

            throw new \Exception("Could not register ad click");
        }
    }

    public function getVisibleAdsByPosition(string $position, int $limit = 10): Collection
    {
        return Ad::visible()
            ->where('position', $position)
            ->orderBy('start_at', 'desc')
            ->limit($limit)
            ->get();
    }


    public function getVisibleAdsGroupedByPosition(): array
    {
        return cache()->remember('ads:by_position', 300, function () {
            return Ad::visible()
                ->whereIn('position', ['header', 'sidebarLeft', 'sidebarRight', 'footer', 'inline'])
                ->orderBy('start_at', 'desc')
                ->get()
                ->groupBy('position')
                ->map(fn($ads) => $ads->values()->all()) // ✅ تحويل إلى array
                ->toArray();
        });
    }






}
