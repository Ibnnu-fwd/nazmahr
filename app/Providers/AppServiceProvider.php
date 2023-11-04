<?php

namespace App\Providers;

use App\Models\AttendanceTimeConfig;
use App\Models\Casbon;
use App\Models\Overtime;
use App\Models\Positition;
use App\Models\User;
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
        $this->app->bind(\App\Interfaces\EmployeeInterface::class, \App\Repositories\EmployeeRepository::class);
        $this->app->bind(\App\Interfaces\CasbonInterface::class, \App\Repositories\CasbonRepository::class);
        $this->app->bind(\App\Interfaces\OvertimeInterface::class, \App\Repositories\OvertimeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Positition::observe(\App\Observers\PositionObserver::class);
        AttendanceTimeConfig::observe(\App\Observers\AttendanceTimeConfigObserver::class);
        User::observe(\App\Observers\UserObserver::class);
        Casbon::observe(\App\Observers\CasbonObserver::class);
        Overtime::observe(\App\Observers\OvertimeObserver::class);
    }
}
