<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\AttendanceTimeConfigController;
use App\Http\Controllers\Admin\CasbonController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\OvertimeController;
use App\Http\Controllers\Admin\PermitLeaveController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\ReprimandController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TaskTypeController;
use App\Http\Controllers\Admin\AttendanceTypeController;
use App\Http\Controllers\Admin\CompanyConfigurationSettingController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\RequestAttendanceController;
use App\Http\Controllers\Admin\RequestReimbursementController;
use App\Http\Controllers\Admin\TimeTrackerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\PermitLeaveController as UserPermitLeaveController;
use App\Http\Controllers\User\OvertimeController as UserOvertimeController;
use App\Http\Controllers\User\RequestReimbursementController as UserRequestReimbursementController;
use App\Http\Controllers\User\TaskController as UserTaskController;
use App\Http\Controllers\User\AttendanceController as UserAttendanceController;
use App\Http\Controllers\User\RequestAttendanceController as UserRequestAttendanceController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// admin
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Attendance Time Config
    Route::group(['prefix' => 'attendance-time-config'], function () {
        Route::get('/', [AttendanceTimeConfigController::class, 'index'])->name('admin.attendance-time-config.index');
        Route::get('create', [AttendanceTimeConfigController::class, 'create'])->name('admin.attendance-time-config.create');
        Route::post('store', [AttendanceTimeConfigController::class, 'store'])->name('admin.attendance-time-config.store');
        Route::get('{id}/edit', [AttendanceTimeConfigController::class, 'edit'])->name('admin.attendance-time-config.edit');
        Route::put('{id}/update', [AttendanceTimeConfigController::class, 'update'])->name('admin.attendance-time-config.update');
        Route::delete('{id}/destroy', [AttendanceTimeConfigController::class, 'destroy'])->name('admin.attendance-time-config.destroy');
    });

    // Position
    Route::group(['prefix' => 'position'], function () {
        Route::get('/', [PositionController::class, 'index'])->name('admin.position.index');
        Route::get('create', [PositionController::class, 'create'])->name('admin.position.create');
        Route::post('store', [PositionController::class, 'store'])->name('admin.position.store');
        Route::get('{id}/edit', [PositionController::class, 'edit'])->name('admin.position.edit');
        Route::put('{id}/update', [PositionController::class, 'update'])->name('admin.position.update');
        Route::delete('{id}/destroy', [PositionController::class, 'destroy'])->name('admin.position.destroy');
    });

    // Employee
    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('admin.employee.index');
        Route::get('create', [EmployeeController::class, 'create'])->name('admin.employee.create');
        Route::post('store', [EmployeeController::class, 'store'])->name('admin.employee.store');
        Route::get('{id}/edit', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
        Route::put('{id}/update', [EmployeeController::class, 'update'])->name('admin.employee.update');
        Route::delete('{id}/destroy', [EmployeeController::class, 'destroy'])->name('admin.employee.destroy');
    });

    // Casbon
    Route::group(['prefix' => 'casbon'], function () {
        Route::get('/', [CasbonController::class, 'index'])->name('admin.casbon.index');
        Route::get('create', [CasbonController::class, 'create'])->name('admin.casbon.create');
        Route::post('store', [CasbonController::class, 'store'])->name('admin.casbon.store');
        Route::get('{id}/edit', [CasbonController::class, 'edit'])->name('admin.casbon.edit');
        Route::put('{id}/update', [CasbonController::class, 'update'])->name('admin.casbon.update');
        Route::delete('{id}/destroy', [CasbonController::class, 'destroy'])->name('admin.casbon.destroy');
    });

    // Overtime
    Route::group(['prefix' => 'overtime'], function () {
        Route::get('/', [OvertimeController::class, 'index'])->name('admin.overtime.index');
        Route::get('create', [OvertimeController::class, 'create'])->name('admin.overtime.create');
        Route::post('store', [OvertimeController::class, 'store'])->name('admin.overtime.store');
        Route::get('{id}/edit', [OvertimeController::class, 'edit'])->name('admin.overtime.edit');
        Route::put('{id}/update', [OvertimeController::class, 'update'])->name('admin.overtime.update');
        Route::delete('{id}/destroy', [OvertimeController::class, 'destroy'])->name('admin.overtime.destroy');
    });

    // Permit Leave
    Route::group(['prefix' => 'permit-leave'], function () {
        Route::get('/', [PermitLeaveController::class, 'index'])->name('admin.permit-leave.index');
        Route::get('create', [PermitLeaveController::class, 'create'])->name('admin.permit-leave.create');
        Route::post('store', [PermitLeaveController::class, 'store'])->name('admin.permit-leave.store');
        Route::get('{id}/edit', [PermitLeaveController::class, 'edit'])->name('admin.permit-leave.edit');
        Route::put('{id}/update', [PermitLeaveController::class, 'update'])->name('admin.permit-leave.update');
        Route::delete('{id}/destroy', [PermitLeaveController::class, 'destroy'])->name('admin.permit-leave.destroy');
        Route::get('{id}/show', [PermitLeaveController::class, 'show'])->name('admin.permit-leave.show');
        Route::post('{id}/change-status', [PermitLeaveController::class, 'changeStatus'])->name('admin.permit-leave.change-status');
    });

    // Task Type
    Route::group(['prefix' => 'task-type'], function () {
        Route::get('/', [TaskTypeController::class, 'index'])->name('admin.task-type.index');
        Route::get('create', [TaskTypeController::class, 'create'])->name('admin.task-type.create');
        Route::post('store', [TaskTypeController::class, 'store'])->name('admin.task-type.store');
        Route::get('{id}/edit', [TaskTypeController::class, 'edit'])->name('admin.task-type.edit');
        Route::put('{id}/update', [TaskTypeController::class, 'update'])->name('admin.task-type.update');
        Route::delete('{id}/destroy', [TaskTypeController::class, 'destroy'])->name('admin.task-type.destroy');
    });

    // Task
    Route::group(['prefix' => 'task'], function () {
        Route::get('/', [TaskController::class, 'index'])->name('admin.task.index');
        Route::get('create', [TaskController::class, 'create'])->name('admin.task.create');
        Route::post('store', [TaskController::class, 'store'])->name('admin.task.store');
        Route::get('{id}/edit', [TaskController::class, 'edit'])->name('admin.task.edit');
        Route::put('{id}/update', [TaskController::class, 'update'])->name('admin.task.update');
        Route::delete('{id}/destroy', [TaskController::class, 'destroy'])->name('admin.task.destroy');
        Route::get('{id}/show', [TaskController::class, 'show'])->name('admin.task.show');
    });

    // Announcement
    Route::group(['prefix' => 'announcement'], function () {
        Route::get('/', [AnnouncementController::class, 'index'])->name('admin.announcement.index');
        Route::get('create', [AnnouncementController::class, 'create'])->name('admin.announcement.create');
        Route::post('store', [AnnouncementController::class, 'store'])->name('admin.announcement.store');
        Route::get('{id}/edit', [AnnouncementController::class, 'edit'])->name('admin.announcement.edit');
        Route::put('{id}/update', [AnnouncementController::class, 'update'])->name('admin.announcement.update');
        Route::delete('{id}/destroy', [AnnouncementController::class, 'destroy'])->name('admin.announcement.destroy');
    });

    // Attendance Type
    Route::group(['prefix' => 'attendance-type'], function () {
        Route::get('/', [AttendanceTypeController::class, 'index'])->name('admin.attendance-type.index');
        Route::get('create', [AttendanceTypeController::class, 'create'])->name('admin.attendance-type.create');
        Route::post('store', [AttendanceTypeController::class, 'store'])->name('admin.attendance-type.store');
        Route::get('{id}/edit', [AttendanceTypeController::class, 'edit'])->name('admin.attendance-type.edit');
        Route::put('{id}/update', [AttendanceTypeController::class, 'update'])->name('admin.attendance-type.update');
        Route::delete('{id}/destroy', [AttendanceTypeController::class, 'destroy'])->name('admin.attendance-type.destroy');
    });

    // Reprimand
    Route::group(['prefix' => 'reprimand'], function () {
        Route::get('/', [ReprimandController::class, 'index'])->name('admin.reprimand.index');
        Route::get('create', [ReprimandController::class, 'create'])->name('admin.reprimand.create');
        Route::post('store', [ReprimandController::class, 'store'])->name('admin.reprimand.store');
        Route::get('{id}/edit', [ReprimandController::class, 'edit'])->name('admin.reprimand.edit');
        Route::put('{id}/update', [ReprimandController::class, 'update'])->name('admin.reprimand.update');
        Route::delete('{id}/destroy', [ReprimandController::class, 'destroy'])->name('admin.reprimand.destroy');
    });

    // Request Attendance
    Route::group(['prefix' => 'request-attendance'], function () {
        Route::get('/', [RequestAttendanceController::class, 'index'])->name('admin.request-attendance.index');
        Route::get('create', [RequestAttendanceController::class, 'create'])->name('admin.request-attendance.create');
        Route::post('store', [RequestAttendanceController::class, 'store'])->name('admin.request-attendance.store');
        Route::get('{id}/edit', [RequestAttendanceController::class, 'edit'])->name('admin.request-attendance.edit');
        Route::put('{id}/update', [RequestAttendanceController::class, 'updateAdmin'])->name('admin.request-attendance.update');
        Route::delete('{id}/destroy', [RequestAttendanceController::class, 'destroy'])->name('admin.request-attendance.destroy');
    });

    // Attendance
    Route::group(['prefix' => 'attendance'], function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('admin.attendance.index');
        Route::get('create', [AttendanceController::class, 'create'])->name('admin.attendance.create');
        Route::post('store', [AttendanceController::class, 'store'])->name('admin.attendance.store');
        Route::get('{id}/edit', [AttendanceController::class, 'edit'])->name('admin.attendance.edit');
        Route::put('{id}/update', [AttendanceController::class, 'update'])->name('admin.attendance.update');
        Route::get('{id}/show', [AttendanceController::class, 'show'])->name('admin.attendance.show');
        Route::delete('{id}/destroy', [AttendanceController::class, 'destroy'])->name('admin.attendance.destroy');
        Route::get('live-attendance', [AttendanceController::class, 'liveAttendance'])->name('admin.attendance.live');
        Route::post('live-attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('admin.attendance.clock-in');
        Route::post('live-attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('admin.attendance.clock-out');
        Route::get('recap', [AttendanceController::class, 'recap'])->name('admin.attendance.recap');
    });

    // Time Tracker
    Route::group(['prefix' => 'time-tracker'], function () {
        Route::get('/', [TimeTrackerController::class, 'index'])->name('admin.time-tracker.index');
        Route::get('create', [TimeTrackerController::class, 'create'])->name('admin.time-tracker.create');
        Route::post('store', [TimeTrackerController::class, 'store'])->name('admin.time-tracker.store');
        Route::get('{id}/edit', [TimeTrackerController::class, 'edit'])->name('admin.time-tracker.edit');
        Route::put('{id}/update', [TimeTrackerController::class, 'update'])->name('admin.time-tracker.update');
        Route::delete('{id}/destroy', [TimeTrackerController::class, 'destroy'])->name('admin.time-tracker.destroy');
        Route::post('start/{id}', [TimeTrackerController::class, 'start'])->name('admin.time-tracker.start');
        Route::post('stop/{id}', [TimeTrackerController::class, 'stop'])->name('admin.time-tracker.stop');
        Route::post('continue/{id}', [TimeTrackerController::class, 'continue'])->name('admin.time-tracker.continue');
        Route::post('{id}/finish', [TimeTrackerController::class, 'finish'])->name('admin.time-tracker.finish');
    });

    // Request Reimbursement
    Route::group(['prefix' => 'request-reimbursement'], function () {
        Route::get('/', [RequestReimbursementController::class, 'index'])->name('admin.request-reimbursement.index');
        Route::get('create', [RequestReimbursementController::class, 'create'])->name('admin.request-reimbursement.create');
        Route::post('store', [RequestReimbursementController::class, 'store'])->name('admin.request-reimbursement.store');
        Route::get('{id}/edit', [RequestReimbursementController::class, 'edit'])->name('admin.request-reimbursement.edit');
        Route::put('{id}/update', [RequestReimbursementController::class, 'updateAdmin'])->name('admin.request-reimbursement.update');
        Route::delete('{id}/destroy', [RequestReimbursementController::class, 'destroy'])->name('admin.request-reimbursement.destroy');
        Route::get('{id}/show', [RequestReimbursementController::class, 'show'])->name('admin.request-reimbursement.show');
        Route::post('{id}/change-status', [RequestReimbursementController::class, 'changeStatus'])->name('admin.request-reimbursement.change-status');
    });

    // Profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profile.index');
        Route::get('{id}/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::put('{id}/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    });

    // Payroll
    Route::group(['prefix' => 'payroll'], function () {
        Route::get('/', [PayrollController::class, 'index'])->name('admin.payroll.index');
        Route::get('create', [PayrollController::class, 'create'])->name('admin.payroll.create');
        Route::post('store', [PayrollController::class, 'store'])->name('admin.payroll.store');
        Route::get('{id}/edit', [PayrollController::class, 'edit'])->name('admin.payroll.edit');
        Route::put('{id}/update', [PayrollController::class, 'update'])->name('admin.payroll.update');
        Route::delete('{id}/destroy', [PayrollController::class, 'destroy'])->name('admin.payroll.destroy');
        Route::get('change-status/{id}/{status}', [PayrollController::class, 'changeStatus'])->name('admin.payroll.change-status');
        Route::get('monthly-recap/{id}/{month}', [PayrollController::class, 'monthlyRecap'])->name('admin.payroll.monthly-recap');
    });

    // Company Configuration Setting
    Route::group(['prefix' => 'company-configuration-setting'], function () {
        Route::get('/', [CompanyConfigurationSettingController::class, 'index'])->name('admin.company-configuration-setting.index');
        Route::put('update', [CompanyConfigurationSettingController::class, 'update'])->name('admin.company-configuration-setting.update');
    });
});

// User
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('user.dashboard.index');

    // Request Attendance
    Route::group(['prefix' => 'request-attendance'], function () {
        Route::get('/', [UserRequestAttendanceController::class, 'index'])->name('user.request-attendance.index');
        Route::get('create', [UserRequestAttendanceController::class, 'create'])->name('user.request-attendance.create');
        Route::post('store', [UserRequestAttendanceController::class, 'store'])->name('user.request-attendance.store');
        Route::get('{id}/edit', [UserRequestAttendanceController::class, 'edit'])->name('user.request-attendance.edit');
        Route::put('{id}/update', [UserRequestAttendanceController::class, 'update'])->name('user.request-attendance.update');
        Route::delete('{id}/destroy', [UserRequestAttendanceController::class, 'destroy'])->name('user.request-attendance.destroy');
    });

    // Request Reimbursement
    Route::group(['prefix' => 'request-reimbursement'], function () {
        Route::get('/', [UserRequestReimbursementController::class, 'index'])->name('user.request-reimbursement.index');
        Route::get('create', [UserRequestReimbursementController::class, 'create'])->name('user.request-reimbursement.create');
        Route::post('store', [UserRequestReimbursementController::class, 'store'])->name('user.request-reimbursement.store');
        Route::get('{id}/edit', [UserRequestReimbursementController::class, 'edit'])->name('user.request-reimbursement.edit');
        Route::put('{id}/update', [UserRequestReimbursementController::class, 'update'])->name('user.request-reimbursement.update');
        Route::delete('{id}/destroy', [UserRequestReimbursementController::class, 'destroy'])->name('user.request-reimbursement.destroy');
    });

    // Attendance
    Route::group(['prefix' => 'attendance'], function () {
        Route::get('/', [UserAttendanceController::class, 'index'])->name('user.attendance.index');
        Route::get('create', [UserAttendanceController::class, 'create'])->name('user.attendance.create');
        Route::post('store', [UserAttendanceController::class, 'store'])->name('user.attendance.store');
        Route::get('{id}/edit', [UserAttendanceController::class, 'edit'])->name('user.attendance.edit');
        Route::put('{id}/update', [UserAttendanceController::class, 'update'])->name('user.attendance.update');
        Route::delete('{id}/destroy', [UserAttendanceController::class, 'destroy'])->name('user.attendance.destroy');
        Route::get('live-attendance', [UserAttendanceController::class, 'liveAttendance'])->name('user.attendance.live');
        Route::post('live-attendance/clock-in', [UserAttendanceController::class, 'clockIn'])->name('user.attendance.clock-in');
        Route::post('live-attendance/clock-out', [UserAttendanceController::class, 'clockOut'])->name('user.attendance.clock-out');
    });

    // Overtime
    Route::group(['prefix' => 'overtime'], function () {
        Route::get('/', [UserOvertimeController::class, 'index'])->name('user.overtime.index');
        Route::get('create', [UserOvertimeController::class, 'create'])->name('user.overtime.create');
        Route::post('store', [UserOvertimeController::class, 'store'])->name('user.overtime.store');
        Route::get('{id}/edit', [UserOvertimeController::class, 'edit'])->name('user.overtime.edit');
        Route::put('{id}/update', [UserOvertimeController::class, 'update'])->name('user.overtime.update');
        Route::delete('{id}/destroy', [UserOvertimeController::class, 'destroy'])->name('user.overtime.destroy');
    });

    // Permit Leave
    Route::group(['prefix' => 'permit-leave'], function () {
        Route::get('/', [UserPermitLeaveController::class, 'index'])->name('user.permit-leave.index');
        Route::get('create', [UserPermitLeaveController::class, 'create'])->name('user.permit-leave.create');
        Route::post('store', [UserPermitLeaveController::class, 'store'])->name('user.permit-leave.store');
        Route::get('{id}/edit', [UserPermitLeaveController::class, 'edit'])->name('user.permit-leave.edit');
        Route::put('{id}/update', [UserPermitLeaveController::class, 'update'])->name('user.permit-leave.update');
        Route::delete('{id}/destroy', [UserPermitLeaveController::class, 'destroy'])->name('user.permit-leave.destroy');
    });

    // Task
    Route::group(['prefix' => 'task'], function () {
        Route::get('/', [UserTaskController::class, 'index'])->name('user.task.index');
        Route::get('create', [UserTaskController::class, 'create'])->name('user.task.create');
        Route::post('store', [UserTaskController::class, 'store'])->name('user.task.store');
        Route::get('{id}/edit', [UserTaskController::class, 'edit'])->name('user.task.edit');
        Route::put('{id}/update', [UserTaskController::class, 'update'])->name('user.task.update');
        Route::delete('{id}/destroy', [UserTaskController::class, 'destroy'])->name('user.task.destroy');
    });

    // Profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [UserProfileController::class, 'index'])->name('user.profile.index');
        Route::get('{id}/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
        Route::put('{id}/update', [UserProfileController::class, 'update'])->name('user.profile.update');
    });
});
require __DIR__ . '/auth.php';
