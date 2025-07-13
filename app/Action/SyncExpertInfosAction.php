<?php

namespace App\Action;

use App\Models\ExpertInfo;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class SyncExpertInfosAction
{
    /**
     * Synchronizes the user's expert experiences with the database.
     *
     * This method performs checksum-based synchronization:
     * - Deletes outdated records not present in the new data.
     * - Performs an upsert based on unique keys (user_id, category, title).
     *
     * @param User $user  The user whose experiences are being updated.
     * @param  array  $experiences  An array of experience data (each with category and title).
     * @return array  Contains the number of deleted and upserted records.
     */
    public function execute(User $user, array $experiences): array
    {
        $new = $this->prepareData($user, $experiences);
        $rawChecksumSql = "MD5(CONCAT(user_id, '|', category, '|', title))";
        $checksums = $new->pluck('checksum')->toArray();

        // حذف السجلات القديمة غير المطابقة
        $deletedCount = ExpertInfo::where('user_id', $user->id)
            ->whereRaw("{$rawChecksumSql} NOT IN ('" . implode("','", $checksums) . "')")
            ->delete();

        // upsert على المفاتيح المحددة
        ExpertInfo::upsert(
            $new->map(fn($exp) => Arr::except($exp, ['checksum']))->toArray(),
            ['user_id', 'category', 'title'],
            ['title_normalized']
        );

        return [
            'deleted'  => $deletedCount,
            'upserted' => $new->count(),
        ];
    }


    /**
     * Prepares and normalizes experience data for synchronization.
     *
     * Filters out entries without a title, adds normalized title and checksum.
     * The checksum is used to detect changes and avoid redundant updates.
     *
     * @param User $user  The user associated with the experiences.
     * @param  array  $experiences  Raw experience data.
     * @return Collection  A collection of structured experience records.
     */
    private function prepareData(User $user, array $experiences): Collection
    {
        return collect($experiences)
            ->filter(fn($exp) => !empty($exp['title']))
            ->map(fn($exp) => [
                'user_id'          => $user->id,
                'category'         => $exp['category'],
                'title'            => $exp['title'],
                'title_normalized' => strtolower($exp['title']),
                'checksum'         => md5($user->id . '|' . $exp['category'] . '|' . $exp['title']),
            ]);
    }
}
