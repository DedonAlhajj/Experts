<?php

namespace App\Providers;

use App\Models\ExpertInfo;
use App\Models\Newsletters;
use App\Models\User;
use App\Observers\ExpertInfoObserver;
use App\Observers\NewsletterObserver;
use App\Observers\UserInfoObserver;
use App\Policies\UserPolicy;
use App\Services\SettingService;
use Illuminate\Support\Facades\Blade;
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
        $this->app->singleton('setting', function () {
            return new SettingService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Newsletters::observe(NewsletterObserver::class);
        ExpertInfo::observe(ExpertInfoObserver::class);
        User::observe(UserInfoObserver::class);
        Blade::directive('setting', function ($key) {
            return "<?php echo \Setting::get($key); ?>";
        });
    }


}
