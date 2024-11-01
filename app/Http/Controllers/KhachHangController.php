<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\khachhang;

class KhachHangController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $khachhangs = khachhang::paginate(10);
        return view('khach_hangs.index', compact('khachhangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('khach_hangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ten_KH' => 'required',
            'SDT_KH' => 'required',
            'gioi_tinh' => 'required',
            'ngay_sinh' => 'required|date',
            'diem_tich' => 'required|integer',
        ]);

        khachhang::create($request->all());

        return redirect()->route('khach_hangs.index')->with('success', 'Khách hàng đã được thêm thành công!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $khachhang = khachhang::findOrFail($id);
        return view('khach_hangs.show', compact('khachhang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $khachhang = khachhang::findOrFail($id);
        return view('khach_hangs.edit', compact('khachhang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ten_KH' => 'required',
            'SDT_KH' => 'required',
            'gioi_tinh' => 'required',
            'ngay_sinh' => 'required|date',
            'diem_tich' => 'required|integer',
        ]);

        $khachhang = khachhang::findOrFail($id);
        $khachhang->update($request->all());

        return redirect()->route('khach_hangs.index')->with('success', 'Khách hàng đã được cập nhật thành công!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $khachhang = khachhang::findOrFail($id);
        $khachhang->delete();

        return redirect()->route('khach_hangs.index')->with('success', 'Khách hàng đã được xóa thành công!');
    }
}
