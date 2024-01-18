<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\StoreController;
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



Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');

Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::get('/survey', [HomeController::class, 'index'])->name('index');

    Route::prefix('admin')->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::get('/export', [AdminController::class, 'export'])->name('admin.export');

        Route::prefix('reward')->group(function () {
            Route::get('/', [RewardController::class, 'index'])->name('admin.reward.index');
            Route::post('/update', [RewardController::class, 'update'])->name('admin.reward.update');
        });

        Route::get('/rewarded', [RewardController::class, 'rewarded'])->name('admin.rewarded');

        Route::group(['prefix' => 'store'], function () {
            Route::get('/', [StoreController::class, 'index'])->name('admin.store');
            Route::post('/store', [StoreController::class, 'store'])->name('admin.store.store');
            Route::get('/delete/{id}', [StoreController::class, 'delete'])->name('admin.store.delete');
        });
    });
});
