<?php

namespace App\Observers;

use App\Models\ExpertInfo;
use Illuminate\Support\Facades\Cache;

class ExpertInfoObserver
{
    public function created(ExpertInfo $expertInfo)
    {
        if ($expertInfo->category === 'experience') {
            Cache::forget('homepage_grouped_specializations');
        }
    }

    public function updated(ExpertInfo $expertInfo)
    {
        if (
            $expertInfo->wasChanged('title') ||
            $expertInfo->wasChanged('title_normalized') ||
            $expertInfo->wasChanged('category')
        ) {
            Cache::forget('homepage_grouped_specializations');
        }
    }

    public function deleted(ExpertInfo $expertInfo)
    {
        if ($expertInfo->category === 'experience') {
            Cache::forget('homepage_grouped_specializations');
        }
    }
}
