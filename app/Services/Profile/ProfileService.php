<?php

namespace App\Services\Profile;

use App\Action\SyncExpertInfosAction;
use App\Action\UpdateUserInfoAction;
use App\Action\UploadCvFileAction;
use App\Action\UploadProfileImageAction;
use App\Exceptions\MediaUploadException;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class ProfileService
{

    /**
     * Updates the user's profile information, experiences, and media files.
     *
     * This method orchestrates multiple actions:
     * - Updates basic user attributes.
     * - Synchronizes expert experiences if provided.
     * - Uploads profile image and CV file if present.
     * - Logs any errors and throws a runtime exception on failure.
     *
     * @param User $user The user whose profile is being updated.
     * @param array $data An associative array containing profile fields, experiences, and media files.
     *
     * @return void
     * @throws RuntimeException If any part of the update process fails.
     *
     */
    public function update(User $user, array $data): void
    {
        DB::beginTransaction();
        try {
            // فصل الملفات
            $profileImage = $data['profile_image'] ?? null;
            $cvFile = $data['cv_file'] ?? null;
            unset($data['profile_image'], $data['cv_file']);

            // تحديث المعلومات الأساسية
            (new UpdateUserInfoAction())->execute($user, $data);

            // مزامنة الخبرات
            if (!empty($data['experiences'])) {
                (new SyncExpertInfosAction())->execute($user, $data['experiences']);
            }

            DB::commit();
            // رفع الملفات

            (new UploadProfileImageAction())->execute($user, $profileImage);
            (new UploadCvFileAction())->execute($user, $cvFile);


        } catch (\Throwable $e) {
            DB::rollBack();

            // ✅ إذا كان الخطأ من نوع MediaUploadException، نعيده كما هو
            if ($e instanceof MediaUploadException) {
                throw $e;
            }
            Log::error("Profile update failed for user {$user->id}", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw new RuntimeException('Profile update failed, please try again later.');
        }
    }


    /**
     * Retrieves a paginated list of expert users based on optional filters.
     *
     * Filters include location, name, and title. Only users marked as experts and active are returned.
     * The query includes media relations and selects key profile fields.
     *
     * @param string|null $location Optional location keywords (country or city).
     * @param string|null $title Optional title to filter expertise.
     * @param string|null $name Optional name to filter users.
     *
     * @return LengthAwarePaginator Paginated list of expert users.
     * @throws \RuntimeException If the query fails.
     *
     */
    public function getExperts(?string $location = null, ?string $title = null, ?string $name = null): LengthAwarePaginator
    {
        try {
            return $this->buildFilteredUsersQuery(
                baseQuery: User::query()
                    ->select('id', 'name', 'slug', 'country', 'is_expert', 'available_for_remote', 'is_job_seeker', 'city', 'bio')
                    ->with('media')
                    ->where('is_expert', 1)
                    ->where('is_active', 1),
                location: $location,
                title: $title,
                name: $name,
                category: "experience"
            )->paginate(4);

        } catch (\Exception $e) {
            Log::error('Failed to fetch experts', ['error' => $e->getMessage()]);
            throw new RuntimeException('Get Experts failed, please try again later.');
        }
    }


    /**
     * Retrieves a paginated list of job seekers based on optional filters.
     *
     * Filters include location, name, and title. Only users marked as job seekers and active are returned.
     * The query includes media relations and selects key profile fields.
     *
     * @param string|null $location Optional location keywords (country or city).
     * @param string|null $title Optional title to filter expertise.
     * @param string|null $name Optional name to filter users.
     *
     * @return LengthAwarePaginator Paginated list of job seekers.
     * @throws \RuntimeException If the query fails.
     *
     */
    public function getJobSeeker(?string $location = null, ?string $title = null, ?string $name = null): LengthAwarePaginator
    {
        try {
            return $this->buildFilteredUsersQuery(
                baseQuery: User::query()
                    ->select('id', 'name', 'slug', 'country', 'is_expert', 'available_for_remote', 'is_job_seeker', 'city', 'bio')
                    ->with('media')
                    ->where('is_job_seeker', 1)
                    ->where('is_active', 1),
                location: $location,
                title: $title,
                name: $name,
                category: "experience"
            )->paginate(4);

        } catch (\Exception $e) {
            Log::error('Failed to fetch JobSeeker', ['error' => $e->getMessage()]);
            throw new RuntimeException('Get JobSeeker failed, please try again later.');
        }
    }


    /**
     * Filters active users based on specialization criteria.
     *
     * Applies optional filters for location, name, and title.
     * Only users marked as active are included in the result.
     *
     * @param string|null $location Optional location keywords (country or city).
     * @param string|null $title Optional title to filter expertise.
     * @param string|null $name Optional name to filter users.
     *
     * @return LengthAwarePaginator Paginated list of filtered users.
     * @throws \RuntimeException If the query fails.
     *
     */
    public function filterUserBySpecialization(?string $location = null, ?string $title = null, ?string $name = null): LengthAwarePaginator
    {
        try {
            return $this->buildFilteredUsersQuery(
                baseQuery: User::query()
                    ->select('id', 'name', 'slug', 'country','social_links', 'is_expert', 'available_for_remote', 'is_job_seeker', 'city', 'bio')
                    ->with('media')
                    ->where('is_active', 1),
                location: $location,
                title: $title,
                name: $name,

            )->paginate(4);

        } catch (\Exception $e) {
            Log::error('Failed to fetch filterUserBySpecialization', ['error' => $e->getMessage()]);
            throw new RuntimeException('Get Users failed, please try again later.');
        }
    }


    /**
     * Retrieves a paginated list of inactive users based on optional filters.
     *
     * Applies optional filters for location, name, and title.
     * Only users marked as inactive are included in the result.
     *
     * @param string|null $location Optional location keywords (country or city).
     * @param string|null $title Optional title to filter expertise.
     * @param string|null $name Optional name to filter users.
     *
     * @return LengthAwarePaginator Paginated list of inactive users.
     * @throws \RuntimeException If the query fails.
     *
     */
    public function inactiveUsers(?string $location = null, ?string $title = null, ?string $name = null): LengthAwarePaginator
    {
        try {
            return $this->buildFilteredUsersQuery(
                baseQuery: User::query()
                    ->select('id', 'name', 'slug', 'country', 'is_expert', 'available_for_remote', 'is_job_seeker', 'city', 'bio')
                    ->with('media')
                    ->inactive(),

                location: $location,
                title: $title,
                name: $name,
                category: "experience"
            )->paginate(5);

        } catch (\Exception $e) {
            Log::error('Failed to fetch inactive Users', ['error' => $e->getMessage()]);
            throw new RuntimeException('Get inactive Users failed, please try again later.');
        }
    }


    /**
     * Toggles the activation status of a user.
     *
     * This method flips the `is_active` flag for the given user.
     * If the user is currently active, they will be deactivated, and vice versa.
     * Logs any errors and throws a runtime exception on failure.
     *
     * @param \App\Models\User $user The user whose activation status will be toggled.
     *
     * @return string A message indicating whether the user was activated or deactivated.
     * @throws \RuntimeException If the update process fails.
     *
     */
    public function toggleActivation(User $user): string
    {
        try {
            $newStatus = !$user->is_active;

            $user->update(['is_active' => $newStatus]);

            $message = $newStatus
                ? 'The user was successfully activated.'
                : 'The user was successfully deactivated.';

            return $message;
        } catch (\Exception $e) {
            Log::error('فشل في تبديل حالة التفعيل', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException('An error occurred while modifying the activation status., please try again later.');
        }
    }


    /**
     * Retrieves homepage data including active users, statistics, and grouped specializations.
     *
     * - Fetches the latest 6 active users.
     * - Caches user statistics for 10 minutes.
     * - Caches grouped specializations for 15 minutes.
     * - Logs errors and returns fallback data on failure.
     *
     * @return array Contains 'users', 'stats', and 'specializations'.
     * @throws \Throwable If any part of the process fails.
     *
     */
    public function getActiveUsersWithStats(): array
    {
        try {
            $stats = $this->getHomepageStats();
            $specializations = $this->getHomepageSpecializations();
            $certificates = $this->getHomepageCertificates();
            $users = $this->getActiveUsers();
            $experts = $this->getRandomExperts();
            $jobSeekers = $this->getRandomJobSeekers();


            return compact('stats', 'specializations', 'certificates', 'users', 'experts', 'jobSeekers');

        } catch (\Throwable $e) {
            Log::error('Error loading homepage user stats: ' . $e->getMessage());

            return [
                'experts' => collect(),
                'job_seekers' => collect(),
                'users' => collect(),
                'stats' => (object)[
                    'total_active' => 0,
                    'total_experts' => 0,
                    'total_job_seekers' => 0,
                    'male_count' => 0,
                    'female_count' => 0,
                ],
                'specializations' => collect(),
            ];
        }
    }

    protected function getActiveUsers()
    {
        return User::active()
            ->select('id', 'name', 'slug', 'country','social_links',
                'is_expert', 'available_for_remote', 'is_job_seeker', 'city', 'bio')
            ->latest()->take(5)->get();
    }

    protected function getRandomExperts(): Collection
    {
        return User::active()
            ->where('is_expert', true)
            ->select(['id', 'name', 'bio', 'slug']) // ← اختيار الأعمدة المطلوبة فقط
            ->inRandomOrder()
            ->limit(5)
            ->get();
    }

    protected function getRandomJobSeekers(): Collection
    {
        return User::active()
            ->where('is_job_seeker', true)
            ->select(['id', 'name', 'bio', 'country', 'city', 'slug'])
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }


    protected function getHomepageStats(): object
    {
        return Cache::remember('homepage_user_stats', now()->addMinutes(10), fn() => $this->getActiveStats());
    }

    protected function getHomepageSpecializations(): Collection
    {
        return Cache::remember(
            'homepage_grouped_specializations',
            now()->addMinutes(15),
            fn() => $this->getSpecializationsAndTheirNumber(16)
        );
    }

    protected function getHomepageCertificates(): Collection
    {
        return Cache::remember(
            'homepage_top_certificates',
            now()->addMinutes(15),
            fn() => $this->getTopCertificates(6)
        );
    }


    protected function getActiveStats(): object
    {
        return User::selectRaw("
                COUNT(*) as total_active,
                SUM(is_expert) as total_experts,
                SUM(is_job_seeker) as total_job_seekers,
                SUM(gender = 'male') as male_count,
                SUM(gender = 'female') as female_count
            ")
            ->where('is_active', true)
            ->first();
    }

    public function getSpecializationsAndTheirNumber(?int $limit = null, ?string $title = null): Collection
    {
        return DB::table('expert_infos')
            ->select('title_normalized as title', DB::raw('COUNT(*) as total'))
            ->where('category', 'experience')
            ->when($title, fn($query) => $query->where('title_normalized', 'LIKE', '%' . strtolower($title) . '%')
            )
            ->groupBy('title_normalized')
            ->orderByDesc('total')
            ->when($limit, fn($query) => $query->limit($limit))
            ->get();
    }

    public function getTopCertificates(?int $limit = 6, ?string $title = null): Collection
    {
        return DB::table('expert_infos')
            ->select('title_normalized', DB::raw('MAX(title) as display_title'), DB::raw('COUNT(*) as total'))
            ->where('category', 'certificate')
            ->when($title, fn($query) => $query->where('title_normalized', 'LIKE', '%' . strtolower($title) . '%')
            )
            ->groupBy('title_normalized')
            ->orderByDesc('total')
            ->when($limit, fn($query) => $query->limit($limit))
            ->get();
    }

    /**
     * Builds a filtered query for users based on location, name, title, and category.
     *
     * This method applies dynamic filters to the base query:
     * - Location: Matches keywords against `country` and `city` fields.
     * - Name: Performs a partial match on the user's name.
     * - Expertise: Filters related `infos` by category and normalized title.
     *
     * @param Builder $baseQuery The initial user query builder.
     * @param string|null $location Comma-separated location keywords (country or city).
     * @param string|null $title Partial title to match against `title_normalized`.
     * @param string|null $name Partial name to match against the user's name.
     * @param string|null $category Category to filter expertise records.
     *
     * @return Builder  The modified query builder with applied filters.
     */
    private function buildFilteredUsersQuery($baseQuery, ?string $location, ?string $title, ?string $name = null, ?string $category = null): Builder
    {
        // 🔍 فلترة حسب الموقع
        if ($location) {
            $keywords = array_map('trim', explode(',', strtolower($location)));

            $baseQuery->where(function ($query) use ($keywords) {
                foreach ($keywords as $word) {
                    $query->orWhere('country', 'LIKE', "%{$word}%")
                        ->orWhere('city', 'LIKE', "%{$word}%");
                }
            });
        }

        // 🔍 فلترة حسب الاسم
        if ($name) {
            $baseQuery->where('name', 'LIKE', '%' . strtolower($name) . '%');
        }

        // 🧠 فلترة حسب الاختصاصات
        $baseQuery->whereHas('infos', function ($query) use ($title, $category) {
            if ($category) {
                $query->where('category', $category);
            }

            if ($title) {
                $query->where('title_normalized', 'LIKE', '%' . strtolower(trim($title)) . '%');
            }
        });

        return $baseQuery;
    }


}
