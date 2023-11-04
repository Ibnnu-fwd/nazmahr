<?php

use App\Http\Controllers\Admin\AttendanceTimeConfigController;
use App\Http\Controllers\Admin\CasbonController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
});

require __DIR__ . '/auth.php';
