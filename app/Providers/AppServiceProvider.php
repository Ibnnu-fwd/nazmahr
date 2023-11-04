<?php

namespace App\Providers;

use App\Models\AttendanceTimeConfig;
use App\Models\Positition;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\PositionInterface::class, \App\Repositories\PositionRepository::class);
        $this->app->bind(\App\Interfaces\AttendanceTimeConfigInterface::class, \App\Repositories\AttendanceTimeConfigRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Positition::observe(\App\Observers\PositionObserver::class);
        AttendanceTimeConfig::observe(\App\Observers\AttendanceTimeConfigObserver::class);
    }
}
