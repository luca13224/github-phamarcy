<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhieuNhap;
use App\Models\NhaCungCap; // Import your supplier model
use App\Models\Thuoc;
use App\Models\ChiTietNhapHang;

class PhieuNhapController
{
    public function index()
{
    $phieuNhaps = PhieuNhap::with('chitiet.thuoc.nhacungcap')->paginate(10); // Thay đổi đây
    foreach ($phieuNhaps as $phieuNhap) {
        $phieuNhap->tong_so_luong_nhap = $phieuNhap->chitiet->sum('so_luong_nhap');
        $phieuNhap->tong_tien = $phieuNhap->chitiet->sum(function ($chiTiet) {
            return $chiTiet->so_luong_nhap * $chiTiet->thuoc->gia_nhap;
        });
    }
    return view('phieu_nhaps.index', compact('phieuNhaps'));
}
public function showDetails($ma_PN)
{
    $chiTietNhapHang = ChiTietNhapHang::with('thuoc', 'thuoc.nhaCungCap')
        ->where('ma_PN', $ma_PN)
        ->get();
    return view('phieu_nhaps.details', compact('chiTietNhapHang'));
}

    public function create()
{
    $nhaCungCaps = NhaCungCap::all();
    $thuocs = Thuoc::all();
    return view('phieu_nhaps.create', compact('nhaCungCaps', 'thuocs'));
}
    public function store(Request $request)
{
    // Validate yêu cầu
    $request->validate([
        'ngay_dat' => 'required|date',
        'ngay_nhan' => 'required|date',
        'thuoc' => 'required|array',
        'thuoc.*.ma_thuoc' => 'required|exists:thuoc,ma_thuoc',
        'thuoc.*.so_luong' => 'required|integer|min:1',
    ]);

    // Tạo phiếu nhập mới
    $phieuNhap = PhieuNhap::create($request->only(['ngay_dat', 'ngay_nhan']));
    
    // Kiểm tra phiếu nhập đã được tạo thành công chưa
    if (!$phieuNhap) {
        return redirect()->back()->withErrors('Không thể tạo phiếu nhập.');
    }

    // Lưu chi tiết nhập hàng
    foreach ($request->thuoc as $item) {
        ChiTietNhapHang::create([
            'ma_PN' => $phieuNhap->ma_PN, // Gán giá trị ma_PN ở đây
            'ma_thuoc' => $item['ma_thuoc'],
            'so_luong_nhap' => $item['so_luong'],
        ]);    
        // Cập nhật tồn kho
        $thuoc = Thuoc::find($item['ma_thuoc']);
        if ($thuoc) {
            $thuoc->so_luong_ton += $item['so_luong']; // Cập nhật số lượng tồn
            $thuoc->save(); // Lưu thay đổi
        }
    }

    return redirect()->route('phieu-nhaps.index')->with('success', 'Phiếu nhập đã được thêm thành công.');
}

public function destroy(string $id)
{
    $phieunhap = PhieuNhap::where('ma_PN', $id)->firstOrFail();
    ChiTietNhapHang::where('ma_PN', $id)->delete();
    $phieunhap->delete();

    return redirect()->route('phieu-nhaps.index')->with('success', 'Phiếu nhập đã được xóa thành công!');
}

}
