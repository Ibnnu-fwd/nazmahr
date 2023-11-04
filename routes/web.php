<?php

use App\Http\Controllers\Admin\DashboardController;
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

    // Position
    Route::group(['prefix' => 'position'], function () {
        Route::get('/', [PositionController::class, 'index'])->name('admin.position.index');
        Route::get('create', [PositionController::class, 'create'])->name('admin.position.create');
        Route::post('store', [PositionController::class, 'store'])->name('admin.position.store');
        Route::get('{id}/edit', [PositionController::class, 'edit'])->name('admin.position.edit');
        Route::put('{id}/update', [PositionController::class, 'update'])->name('admin.position.update');
        Route::delete('{id}/destroy', [PositionController::class, 'destroy'])->name('admin.position.destroy');
    });
});

require __DIR__ . '/auth.php';
