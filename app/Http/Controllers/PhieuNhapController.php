<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhieuNhap;
use App\Models\NhaCungCap; // Import your supplier model
use App\Models\Thuoc;
use App\Models\ChiTietNhapHang;

class PhieuNhapController
{
    /**
     * Display a listing of the resource.
     */
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $nhaCungCaps = NhaCungCap::all();
    $thuocs = Thuoc::all();
    return view('phieu_nhaps.create', compact('nhaCungCaps', 'thuocs'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ngay_dat' => 'required|date',
            'ngay_nhan' => 'required|date',
            'ma_ncc' => 'required|exists:nha_cung_cap,ma_NCC', // Kiểm tra mã nhà cung cấp
            'thuoc' => 'required|array', // Mảng thuốc
            'thuoc.*.ma_thuoc' => 'required|exists:thuoc,ma_thuoc', // Mã thuốc
            'thuoc.*.so_luong' => 'required|integer|min:1', // Số lượng
        ]);

        // Tạo phiếu nhập mới
        $phieuNhap = new PhieuNhap();
        $phieuNhap->ngay_dat = $request->ngay_dat;
        $phieuNhap->ngay_nhan = $request->ngay_nhan;
        $phieuNhap->ma_ncc = $request->ma_ncc; // Thêm mã nhà cung cấp
        $phieuNhap->save();

        // Lưu chi tiết nhập hàng
        foreach ($request->thuoc as $item) {
            ChiTietNhapHang::create([
                'ma_PN' => $phieuNhap->ma_PN, // Mã phiếu nhập
                'ma_thuoc' => $item['ma_thuoc'], // Mã thuốc
                'so_luong_nhap' => $item['so_luong'], // Số lượng nhập
            ]);
        }

        return redirect()->route('phieu-nhaps.index')->with('success', 'Phiếu nhập đã được thêm thành công.');

    }

    /**
     * Display the specified resource.
     */
    public function showDetails($ma_PN)
{
    $chiTietNhapHang = ChiTietNhapHang::with('thuoc', 'thuoc.nhaCungCap')
        ->where('ma_PN', $ma_PN)
        ->get();
    return view('phieu_nhaps.details', compact('chiTietNhapHang'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phieunhap = PhieuNhap::where('ma_PN', $id)->firstOrFail();
        $phieunhap->delete();

        return redirect()->route('phieu_nhaps.index')->with('success', 'Phiếu nhập đã được xóa thành công!');

    }
}
