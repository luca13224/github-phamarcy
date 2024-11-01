<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhieuNhap;
class PhieuNhapController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phieunhaps = PhieuNhap::paginate(10);
        return view('phieu_nhaps.index', compact('phieuNhaps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('phieu_nhaps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ngay_dat' => 'required|date',
            'ngay_nhan' => 'required|date',
        ]);

        PhieuNhap::create($request->all());

        return redirect()->route('phieu_nhaps.index')->with('success', 'Phiếu nhập đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $phieunhap = PhieuNhap::findOrFail($id);
        return view('phieu_nhaps.show', compact('phieunhap'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $phieunhap = PhieuNhap::findOrFail($id);
        return view('phieu_nhaps.edit', compact('phieunhap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ngay_dat' => 'required|date',
            'ngay_nhan' => 'required|date',
        ]);

        $phieunhap = PhieuNhap::findOrFail($id);
        $phieunhap->update($request->all());

        return redirect()->route('phieu_nhaps.index')->with('success', 'Phiếu nhập đã được cập nhật thành công!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phieunhap = PhieuNhap::findOrFail($id);
        $phieunhap->delete();

        return redirect()->route('phieu_nhaps.index')->with('success', 'Phiếu nhập đã được xóa');

    }
}
