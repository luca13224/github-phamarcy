<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\ThuocController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\ChiTietHDController;
use App\Http\Controllers\PhieuNhapController;
use App\Http\Controllers\ChiTietPhieuNhapController;
use App\Http\Controllers\BaoCaoController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth']);

// Nha Cung Cap routes
Route::resource('nha-cung-cap', NhaCungCapController::class);

// Thuoc routes
Route::resource('thuoc', ThuocController::class);

// Nhan Vien routes
Route::resource('nhan-vien', NhanVienController::class);

// Khach Hang routes
Route::resource('khach-hang', KhachHangController::class);

// Hoa Don routes
Route::resource('hoa-don', HoaDonController::class);

// Chi Tiet Hoa Don routes
Route::resource('chi-tiet-hd', ChiTietHDController::class);

// Phieu Nhap routes
Route::resource('phieu-nhap', PhieuNhapController::class);

// Chi Tiet Nhap Hang routes
Route::resource('chi-tiet-nhap-hang', ChiTietPhieuNhapController::class);

// Routes for advanced reporting and analysis
Route::get('/bao-cao/doanh-thu-hang-thang', [BaoCaoController::class, 'doanhThuHangThang'])->name('bao_cao.doanh_thu_hang_thang');
Route::get('/bao-cao/thuoc-sap-het-han', [BaoCaoController::class, 'thuocSapHetHan'])->name('bao_cao.thuoc_sap_het_han');
Route::get('/bao-cao/chi-tieu-khach-hang', [BaoCaoController::class, 'chiTieuKhachHang'])->name('bao_cao.chi_tieu_khach_hang');
Route::get('/bao-cao/hang-ton-kho', [BaoCaoController::class, 'hangTonKho'])->name('bao_cao.hang_ton_kho');