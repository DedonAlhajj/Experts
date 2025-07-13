<?php

namespace App\Providers;

use App\Models\ExpertInfo;
use App\Models\User;
use App\Observers\ExpertInfoObserver;
use App\Observers\UserInfoObserver;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected array $policies = [
        User::class => UserPolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ExpertInfo::observe(ExpertInfoObserver::class);
        User::observe(UserInfoObserver::class);
    }
}
