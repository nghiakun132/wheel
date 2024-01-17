<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RewardController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::get('/export', [AdminController::class, 'export'])->name('admin.export');

        Route::prefix('reward')->group(function () {
            Route::get('/', [RewardController::class, 'index'])->name('admin.reward.index');
            Route::post('/update', [RewardController::class, 'update'])->name('admin.reward.update');
        });

        Route::get('/rewarded', [RewardController::class, 'rewarded'])->name('admin.rewarded');
    });
});
