<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiTietHD;
class ChiTietHDController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chitiethds = ChiTietHD::paginate(10);
        return view('chi_tiet_hds.index', compact('chitiethds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('chi_tiet_hds.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ma_HD' => 'required',
            'ma_Thuoc' => 'required',
            'so_luong' => 'required|integer',
        ]);

        ChiTietHD::create($request->all());

        return redirect()->route('chi_tiet_hds.index')->with('success', 'Chi tiết hóa đơn đã được thêm thành công!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $chitiethd = ChiTietHD::findOrFail($id);
        return view('chi_tiet_hds.show', compact('chitiethd'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chitiethd = ChiTietHD::findOrFail($id);
        return view('chi_tiet_hds.edit', compact('chitiethd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ma_HD' => 'required',
            'ma_Thuoc' => 'required',
            'so_luong' => 'required|integer',
        ]);

        $chitiethd = ChiTietHD::findOrFail($id);
        $chitiethd->update($request->all());

        return redirect()->route('chi_tiet_hds.index')->with('success', 'Chi tiết hóa đơn đã được cập nhật thàng công!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chitiethd = ChiTietHD::findOrFail($id);
        $chitiethd->delete();

        return redirect()->route('chi_tiet_hds.index')->with('success', 'Chi tiết hóa đơn đã được xóa');

    }
}
