<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\ThuocController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\PhieuNhapController;
use App\Http\Controllers\DoanhthuController;
use App\Http\Controllers\LichSuMuaController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth']);

Route::resource('nha-cung-caps', NhaCungCapController::class);

Route::resource('thuoc', ThuocController::class);
Route::get('/thuocs', [ThuocController::class, 'index'])->name('thuoc.index');

Route::resource('nhan-viens', NhanVienController::class);

Route::resource('khach-hangs', KhachHangController::class);
Route::get('/lich-su-mua', [LichSuMuaController::class, 'index'])->name('lich-su-mua.index');

Route::resource('hoa-dons', HoaDonController::class);
Route::get('/hoa-don/{ma_HD}', [HoaDonController::class, 'showDetails'])->name('hoa_don.show');

Route::resource('phieu-nhaps', PhieuNhapController::class);
Route::get('phieu-nhap/{ma_PN}/details', [PhieuNhapController::class, 'showDetails'])->name('phieu-nhap.details');

Route::get('/doanh-thu', [DoanhthuController::class, 'thongKe'])->name('doanhthu.thongke');
Route::get('/khach-hang/chi-tiet/{month}/{year}', [DoanhthuController::class, 'showKhachHangDetails'])->name('khachhang.details');
