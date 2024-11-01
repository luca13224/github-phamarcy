<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\ThuocController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\ChiTietHDController;
use App\Http\Controllers\PhieuNhapController;
use App\Http\Controllers\ChiTietNhapHangController;
use App\Http\Controllers\BaoCaoController;
use App\Http\Controllers\LichSuMuaController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth']);

// Nha Cung Cap routes
Route::resource('nha-cung-caps', NhaCungCapController::class);

// Thuoc routes
Route::resource('thuoc', ThuocController::class);
Route::get('/thuocs', [ThuocController::class, 'index'])->name('thuoc.index');
// Nhan Vien routes
Route::resource('nhan-viens', NhanVienController::class);

// Khach Hang routes
Route::resource('khach-hangs', KhachHangController::class);
Route::get('/lich-su-mua', [LichSuMuaController::class, 'index'])->name('lich-su-mua.index');

// Hoa Don routes
Route::resource('hoa-dons', HoaDonController::class);

// Chi Tiet Hoa Don routes
Route::resource('chi-tiet-hds', ChiTietHDController::class);

// Phieu Nhap routes
Route::resource('phieu-nhaps', PhieuNhapController::class);
Route::get('phieu-nhap/{ma_PN}/details', [PhieuNhapController::class, 'showDetails'])->name('phieu-nhap.details');

// Chi Tiet Nhap Hang routes
Route::resource('chi-tiet-nhap-hangs', ChiTietNhapHangController::class);

// Routes for advanced reporting and analysis
Route::get('/bao-cao/doanh-thu-hang-thang', [BaoCaoController::class, 'doanhThutheothang'])->name('bao_cao.doanh_thu_hang_thang');
