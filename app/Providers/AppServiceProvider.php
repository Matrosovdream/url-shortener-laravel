<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\SafeBrowsingService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SafeBrowsingService::class, function ($app) {
            return new SafeBrowsingService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
