<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HoaDon;
use App\Models\ChiTietHD;
use App\Models\Thuoc;
use App\Models\KhachHang;
use Carbon\Carbon;

class DoanhthuController
{
    public function thongKe(Request $request)
{
    $month = $request->input('month', Carbon::now()->month);
    $year = $request->input('year', Carbon::now()->year);

    // Lấy doanh thu theo tháng
    $doanhThu = DB::table('HoaDon')
        ->join('ChiTietHD', 'HoaDon.ma_HD', '=', 'ChiTietHD.ma_HD')
        ->join('Thuoc', 'ChiTietHD.ma_Thuoc', '=', 'Thuoc.ma_thuoc')
        ->select(
            DB::raw('SUM(ChiTietHD.so_luong * Thuoc.gia_ban) as tong_tien'),
            'HoaDon.ma_KH'
        )
        ->whereMonth('HoaDon.ngay_tao', $month)
        ->whereYear('HoaDon.ngay_tao', $year)
        ->groupBy('HoaDon.ma_KH')
        ->get();

    // Tính tổng doanh thu và số khách hàng
    $tongDoanhThu = $doanhThu->sum('tong_tien'); // Tổng doanh thu từ tất cả hóa đơn
    $soKhachHang = $doanhThu->unique('ma_KH')->count(); // Đếm số khách hàng duy nhất

    return view('doanhthu.thongke', compact('tongDoanhThu', 'soKhachHang', 'month', 'year'));
}
public function showKhachHangDetails($month, $year)
{
    // Lấy thông tin chi tiết khách hàng
    $khachHangs = DB::table('HoaDon')
        ->join('KhachHang', 'HoaDon.ma_KH', '=', 'KhachHang.ma_KH')
        ->select('KhachHang.*')
        ->whereMonth('HoaDon.ngay_tao', $month)
        ->whereYear('HoaDon.ngay_tao', $year)
        ->distinct() // Lấy duy nhất mỗi khách hàng
        ->get();

    return view('doanhthu.khachhang_details', compact('khachHangs', 'month', 'year'));
}



}
// public function thuocSapHetHan()
// {
//     $currentDate = now();
//     $thresholdDate = $currentDate->copy()->addMonths(1);  // Giới hạn trong vòng 6 tháng tới

//     $thuocSapHetHan = Thuoc::where('HSD', '<', $thresholdDate)
//                             ->orderBy('HSD', 'asc')
//                             ->get();

//     return view('bao_cao.thuoc_sap_het_han', compact('thuocsaphethan'));
// }
// public function chiTieuKhachHang()
// {
//     $chiTieuKhachHang = khachhang::select('khach_hangs.ten_KH', 'khach_hangs.ma_KH',
//         \DB::raw('SUM(chi_tiet_hd.so_luong * chi_tiet_hd.gia_ban) as tong_chi_tieu'))
//         ->join('hoa_dons', 'khach_hangs.ma_KH', '=', 'hoa_dons.ma_KH')
//         ->join('chi_tiet_hd', 'hoa_dons.ma_HD', '=', 'chi_tiet_hd.ma_HD')
//         ->groupBy('khach_hangs.ma_KH', 'khach_hangs.ten_KH')
//         ->orderBy('tong_chi_tieu', 'desc')
//         ->get();

//     return view('bao_cao.chi_tieu_khach_hang', compact('chitieukhachhang'));
// }
// public function hangTonKho()
//     {
//         $thuocs = Thuoc::where('so_luong_ton', '>', 0)->get();
//         return view('bao_cao.hang_ton_kho', compact('thuocs'));
//     }

