<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserInfoObserver
{

    public function created(User $user)
    {
        // المستخدم الجديد قد يؤثر مباشرة على الإحصائيات
        Cache::forget('homepage_user_stats');
    }

    public function updated(User $user)
    {
        if (
            $user->wasChanged('is_active') ||
            $user->wasChanged('is_expert') ||
            $user->wasChanged('is_job_seeker') ||
            $user->wasChanged('gender')
        ) {
            Cache::forget('homepage_user_stats');
        }
    }

    public function deleted(User $user)
    {
        Cache::forget('homepage_user_stats');
    }
}
