<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\hoadon;
use App\Models\khachhang;
use App\Models\thuoc;

class BaoCaoController extends Controller
{
public function doanhThuHangThang()
{
    $doanhThuThang = HoaDon::select(
            \DB::raw('YEAR(ngay_tao) as nam'),
            \DB::raw('MONTH(ngay_tao) as thang'),
            \DB::raw('SUM(chi_tiet_hd.so_luong * chi_tiet_hd.gia_ban) as doanh_thu')
        )
        ->join('chi_tiet_hd', 'hoa_dons.ma_HD', '=', 'chi_tiet_hd.ma_HD')
        ->groupBy('nam', 'thang')
        ->orderBy('nam', 'desc')
        ->orderBy('thang', 'desc')
        ->get();

    return view('bao_cao.doanh_thu_hang_thang', compact('doanhthuthang'));
}
public function thuocSapHetHan()
{
    $currentDate = now();
    $thresholdDate = $currentDate->copy()->addMonths(1);  // Giới hạn trong vòng 6 tháng tới

    $thuocSapHetHan = Thuoc::where('HSD', '<', $thresholdDate)
                            ->orderBy('HSD', 'asc')
                            ->get();

    return view('bao_cao.thuoc_sap_het_han', compact('thuocsaphethan'));
}
public function chiTieuKhachHang()
{
    $chiTieuKhachHang = khachhang::select('khach_hangs.ten_KH', 'khach_hangs.ma_KH',
        \DB::raw('SUM(chi_tiet_hd.so_luong * chi_tiet_hd.gia_ban) as tong_chi_tieu'))
        ->join('hoa_dons', 'khach_hangs.ma_KH', '=', 'hoa_dons.ma_KH')
        ->join('chi_tiet_hd', 'hoa_dons.ma_HD', '=', 'chi_tiet_hd.ma_HD')
        ->groupBy('khach_hangs.ma_KH', 'khach_hangs.ten_KH')
        ->orderBy('tong_chi_tieu', 'desc')
        ->get();

    return view('bao_cao.chi_tieu_khach_hang', compact('chitieukhachhang'));
}
public function hangTonKho()
    {
        $thuocs = Thuoc::where('so_luong_ton', '>', 0)->get();
        return view('bao_cao.hang_ton_kho', compact('thuocs'));
    }

}
