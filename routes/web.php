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

Route::get('test', function () {
    function chonSanPhamNgauNhien($soLuongSanPham)
    {
        // Tính tổng số lượng
        $tongSoLuong = array_sum($soLuongSanPham);

        // Tính tỉ lệ phần trăm cho từng sản phẩm
        $tilesanpham = array_map(function ($soLuong) use ($tongSoLuong) {
            return $soLuong / $tongSoLuong;
        }, $soLuongSanPham);

        // Tạo số ngẫu nhiên từ 0 đến 1
        $soNgauNhien = rand(0, 100) / 100;

        // Chọn sản phẩm dựa trên số ngẫu nhiên
        $cumulativePercentage = 0;
        foreach ($tilesanpham as $index => $tile) {
            $cumulativePercentage += $tile;
            if ($soNgauNhien <= $cumulativePercentage) {
                return "Sản phẩm " . ($index + 1);
            }
        }

        return "Không có sản phẩm nào được chọn.";
    }

    // Số lượng của các sản phẩm (có thể là một mảng động)
    $soLuongSanPham = [310, 0, 10, 15, 25];

    // Gọi hàm để chọn sản phẩm ngẫu nhiên
    $sanPhamDuocChon = chonSanPhamNgauNhien($soLuongSanPham);

    // Xuất kết quả
    echo "Sản phẩm được chọn ngẫu nhiên: " . $sanPhamDuocChon;
});

Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');


Route::middleware('auth:admin')->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

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
