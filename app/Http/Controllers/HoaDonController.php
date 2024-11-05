<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon; // Đổi tên từ hoadon
use App\Models\Thuoc;
use App\Models\NhanVien; // Đổi tên từ nhanvien
use App\Models\KhachHang; // Đổi tên từ khachhang
use App\Models\ChiTietHD; // Đổi tên từ ChiTietHD

class HoaDonController
{
    public function index(Request $request)
    {
        $query = $request->get('query');

        $hoaDons = HoaDon::with(['nhanVien', 'khachHang', 'chiTietHD.thuoc'])
            ->when($query, function($queryBuilder) use ($query) {
                return $queryBuilder->whereHas('khachHang', function($q) use ($query) {
                    $q->where('ten_KH', 'like', "%{$query}%"); // Kiểm tra trường ten_KH
                });
            })
            ->paginate(10);

        foreach ($hoaDons as $hoaDon) {
            $hoaDon->tong_tien = $hoaDon->chiTietHD->sum(function ($chiTiet) {
                return $chiTiet->thuoc ? ($chiTiet->so_luong * $chiTiet->thuoc->gia_ban) : 0;
            });
        }

        return view('hoa_dons.index', compact('hoaDons'));
    }

    public function showDetails($ma_HD)
    {
        $chiTietHoaDon = ChiTietHD::with('thuoc')->where('ma_HD', $ma_HD)->get();
        return view('hoa_dons.details', compact('chiTietHoaDon'));
    }

    public function create()
    {
        $nhanViens = NhanVien::all(); // Lấy danh sách nhân viên
        $khachHangs = KhachHang::all(); // Lấy danh sách khách hàng

        return view('hoa_dons.create', compact('nhanViens', 'khachHangs'));
    }

    public function store(Request $request)
    {
        // Validate yêu cầu
        $request->validate([
            'ma_NV' => 'required',
            'ma_KH' => 'required',
            'ngay_tao' => 'required|date',
            'chiTietHD.*.ma_Thuoc' => 'required|integer',
            'chiTietHD.*.so_luong' => 'required|integer',
            'diem_doi' => 'nullable|integer|min:0',
        ]);

        // Tạo hóa đơn và lưu
        $hoaDon = HoaDon::create($request->only(['ma_NV', 'ma_KH', 'ngay_tao']));

        // Kiểm tra xem hóa đơn có được tạo thành công không
        if (!$hoaDon) {
            return redirect()->back()->withErrors('Không thể tạo hóa đơn.');
        }
        $tongTien = 0;
        foreach ($request->chiTietHD as $chiTiet) {
            $thuoc = Thuoc::find($chiTiet['ma_Thuoc']);
            if ($thuoc) {
                $tongTien += $chiTiet['so_luong'] * $thuoc->gia_ban; // Giả sử bạn có thuộc tính `gia_ban` trong mô hình Thuoc
            }
        }

        // Cộng điểm cho khách hàng
        $diem = floor($tongTien / 50000); // Số điểm nhận được
        $khachHang = KhachHang::find($request->ma_KH);
        if ($khachHang) {
            $khachHang->diem_tich += $diem; // Cộng điểm
            $khachHang->save(); // Lưu cập nhật
        }

        // Xử lý điểm đổi
        $diemDoi = $request->diem_doi ?? 0; // Số điểm khách hàng muốn đổi
        $tienDoi = $diemDoi * 1000; // Số tiền sẽ được trừ từ tổng tiền

        // Trừ tiền tương ứng với số điểm đổi
        if ($tienDoi > 0) {
            // Kiểm tra xem khách hàng có đủ điểm để đổi không
            if ($khachHang->diem_tich >= $diemDoi) {
                $khachHang->diem_tich -= $diemDoi; // Giảm điểm
                $khachHang->save(); // Lưu cập nhật
                $tongTien -= $tienDoi; // Giảm tổng tiền
            } else {
                return redirect()->back()->withErrors('Không đủ điểm để đổi.');
            }
        }

        // Lưu chi tiết hóa đơn
        foreach ($request->chiTietHD as $chiTiet) {
            $chiTietHD = new ChiTietHD();
            $chiTietHD->ma_HD = $hoaDon->ma_HD; // Đảm bảo ma_HD đã được gán
            $chiTietHD->ma_Thuoc = $chiTiet['ma_Thuoc']; // Lấy giá trị ma_Thuoc từ request
            $chiTietHD->so_luong = $chiTiet['so_luong']; // Lấy giá trị so_luong từ request
            $chiTietHD->save(); // Lưu chi tiết hóa đơn
        }

        // Có thể lưu tổng tiền sau khi trừ vào hóa đơn nếu cần
        $hoaDon->tong_tien = $tongTien;
        $hoaDon->save();

        return redirect()->route('hoa-dons.index')->with('success', 'Hóa đơn đã được thêm thành công! Tổng tiền: ' . number_format($tongTien) . ' VND' . ' | Điểm tích lũy: ' . $diem);
    }
    public function destroy(string $id)
    {
        // Xóa tất cả chi tiết hóa đơn liên quan
        ChiTietHD::where('ma_HD', $id)->delete();

        // Sau đó xóa hóa đơn
        $hoadon = HoaDon::findOrFail($id);
        $hoadon->delete();

        return redirect()->route('hoa-dons.index')->with('success', 'Hóa đơn đã được xóa thành công!');
    }
}
