<?php

namespace App\Services\Profile;

use App\Models\ExpertInfo;
use App\Models\User;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;
use RuntimeException;

class ExpertInfoService
{

    /**
     * Retrieves a user's profile along with their expert information grouped by category.
     *
     * This method performs eager loading to avoid N+1 queries and returns:
     * - The user model with media relations.
     * - Expert infos grouped by category.
     *
     * @param User $user  The user whose profile and expert infos are being retrieved.
     *
     * @throws RuntimeException If the query fails.
     *
     * @return array{
     *     user: \App\Models\User,
     *     expert_infos: \Illuminate\Support\Collection
     * }
     */
    #[ArrayShape(['user' => "array", 'expert_infos' => "mixed"])]
    public function getProfileWithExpertInfo(User $user): array
    {
        try {
            // eager load لتفادي N+1 queries
            $expertInfos = $user->infos()
                ->orderBy('category') // 🔥 يجعل البيانات مرتبة مسبقًا
                ->select([
                    'id',
                    'user_id',
                    'category',
                    'title',
                    'title_normalized',
                ])
                ->get()
                ->groupBy('category');


            $user->load('media');
            return [
                'user' => $user,
                'expert_infos' => $expertInfos,
            ];
        } catch (\Exception $e) {
            Log::error('Failed to fetch Profile', ['error' => $e->getMessage()]);
            throw new RuntimeException('Get profile failed, please try again later.');
        }
    }


    public function autocompleteTitles(string $category, ?string $query): Collection
    {
        $cacheKey = "autocomplete_titles:{$category}:" . md5($query ?? '');

        return Cache::remember($cacheKey, now()->addHours(6), function () use ($category, $query) {
            return ExpertInfo::select('title')
                ->where('category', $category)
                ->whereNotNull('title')
                ->when($query, fn($q) => $q->where('title', 'like', '%' . $query . '%'))
                ->distinct()
                ->pluck('title');
        });
    }

    /**
     * Persist the expert information for the specified user.
     *
     * Wraps the creation in a database transaction and logs any failure.
     * Returns the created ExpertInfo instance.
     *
     * @param  array  $data  The validated data to be stored.
     * @param User $user  The user related to the expert info.
     * @return ExpertInfo
     *
     * @throws Exception  If the database transaction fails.
     */
    public function store(array $data, User $user): ExpertInfo
    {
        try {
            return DB::transaction(function () use ($data, $user) {
                return ExpertInfo::create([
                    'user_id' => $user->id,
                    'category' => $data['category'],
                    'title' => $data['title'],
                    'institution' => $data['institution'] ?? null,
                    'description' => $data['description'] ?? null,
                    'start_date' => $data['start_date'] ?? null,
                    'end_date' => $data['end_date'] ?? null,
                ]);
            });
        } catch (Exception $e) {
            Log::error('Failed to store Expert Info', [
                'user_id' => $user->id,
                'category' => $data['category'],
                'error' => $e->getMessage(),
            ]);

            throw $e; // إعادة رمي الاستثناء ليتم التعامل معه في الـ Controller
        }
    }

    public function update(array $data, ExpertInfo $expertInfo): ExpertInfo
    {
        try {
            return DB::transaction(function () use ($data, $expertInfo) {
                $expertInfo->update([
                    'category' => $data['category'],
                    'title' => $data['title'],
                    'institution' => $data['institution'] ?? null,
                    'description' => $data['description'] ?? null,
                    'start_date' => $data['start_date'] ?? null,
                    'end_date' => $data['end_date'] ?? null,
                ]);

                return $expertInfo;
            });
        } catch (Exception $e) {
            Log::error('Failed to update Expert Info', [
                'expert_info_id' => $expertInfo->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }



}
