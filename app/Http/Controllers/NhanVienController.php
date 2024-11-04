<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nhanvien;

class NhanVienController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nhanviens = nhanvien::paginate(10);
        return view('nhan_viens.index', compact('nhanviens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nhan_viens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ma_NV' => 'required',
            'ten_NV' => 'required',
            'SDT' => 'required',
            'dia_chi' => 'required',
            'ngay_sinh' => 'required|date',
        ]);

        nhanvien::create($request->all());

        return redirect()->route('nhan-viens.index')->with('success', 'Nhân viên đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nhanvien = nhanvien::findOrFail($id);
        return view('nhan_viens.show', compact('nhanvien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nhanvien = nhanvien::findOrFail($id);
        return view('nhan_viens.edit', compact('nhanvien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ten_NV' => 'required',
            'SDT' => 'required',
            'dia_chi' => 'required',
            'ngay_sinh' => 'required|date',
        ]);

    $existingNhanVien = nhanvien::where('ma_NV', $request->ma_NV)->first();
    if ($existingNhanVien && $existingNhanVien->ma_NV != $id) {
        return back()->withErrors(['ma_NV' => 'Mã nhân viên đã tồn tại.']);
    }
        $nhanvien = nhanvien::findOrFail($id);
        $nhanvien->update($request->all());

        return redirect()->route('nhan-viens.index')->with('success', 'Nhân viên đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        $nhanvien = nhanvien::findOrFail($id);
        $nhanvien->delete();

        return redirect()->route('nhan-viens.index')->with('success', 'Nhân viên đã được xóa thành công!');

    }
}
