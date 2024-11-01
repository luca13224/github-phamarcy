<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiTietPhieuNhap;
class ChiTietPhieuNhapController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chitietphieunhaps = ChiTietPhieuNhap::paginate(10);
        return view('chi_tiet_phieu_nhaps.index', compact('chitietphieunhaps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('chi_tiet_phieu_nhaps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'ma_PN' => 'required',
            'ma_thuoc' => 'required',
            'so_luong_nhap' => 'required|integer',
        ]);

        ChiTietPhieuNhap::create($request->all());

        return redirect()->route('chi_tiet_phieu_nhaps.index')->with('success', 'Chi tiết phiếu nhập đã được thêm thành công!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $chitietphieunhap = ChiTietPhieuNhap::findOrFail($id);
        return view('chi_tiet_phieu_nhaps.show', compact('chitietphieunhap'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chitietphieunhap = ChiTietPhieuNhap::findOrFail($id);
        return view('chi_tiet_phieu_nhaps.edit', compact('chitietphieunhap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ma_PN' => 'required',
            'ma_thuoc' => 'required',
            'so_luong_nhap' => 'required|integer',
        ]);

        $chitietphieunhap = ChiTietPhieuNhap::findOrFail($id);
        $chitietphieunhap->update($request->all());

        return redirect()->route('chi_tiet_phieu_nhaps.index')->with('success', 'Chi tiết phiếu nhập đã được cập nhật thàng công!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chitietphieunhap = ChiTietPhieuNhap::findOrFail($id);
        $chitietphieunhap->delete();

        return redirect()->route('chi_tiet_phieu_nhaps.index')->with('success', 'Chi tiết phiếu nhập đã được xóa');

    }
}
