<?php

namespace App\Providers;

use App\Models\Attendance;
use App\Models\AttendanceTimeConfig;
use App\Models\Casbon;
use App\Models\Overtime;
use App\Models\PermitLeave;
use App\Models\Positition;
use App\Models\Task;
use App\Models\TaskType;
use App\Models\User;
use App\Models\AttendanceType;
use App\Observers\PermitLeaveObserver;
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
        $this->app->bind(\App\Interfaces\PermitLeaveInterface::class, \App\Repositories\PermitLeaveRepository::class);
        $this->app->bind(\App\Interfaces\TaskTypeInterface::class, \App\Repositories\TaskTypeRepository::class);
        $this->app->bind(\App\Interfaces\TaskInterface::class, \App\Repositories\TaskRepository::class);
        $this->app->bind(\App\Interfaces\AnnouncementInterface::class, \App\Repositories\AnnouncementRepository::class);
        $this->app->bind(\App\Interfaces\AttendanceInterface::class, \App\Repositories\AttendanceRepository::class);
        $this->app->bind(\App\Interfaces\AttendanceTypeInterface::class, \App\Repositories\AttendanceTypeRepository::class);
        
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
        PermitLeave::observe(PermitLeaveObserver::class);
        TaskType::observe(\App\Observers\TaskTypeObserver::class);
        Task::observe(\App\Observers\TaskObserver::class);
        Attendance::observe(\App\Observers\AttendanceObserver::class);
        AttendanceType::observe(\App\Observers\AttendanceTypeObserver::class);
    }
}
