<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hoadon;

class HoaDonController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hoadons = hoadon::paginate(10);
        return view('hoa_dons.index', compact('hoadons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hoa_dons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ma_NV' => 'required',
            'ma_KH' => 'required',
            'ngay_tao' => 'required|date',
        ]);

        hoadon::create($request->all());

        return redirect()->route('hoa_dons.index')->with('success', 'Hóa đơn đã được thêm thành công!');
 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hoadon = hoadon::findOrFail($id);
        return view('hoa_dons.show', compact('hoadon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hoadon = hoadon::findOrFail($id);
        return view('hoa_dons.edit', compact('hoadon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ma_NV' => 'required',
            'ma_KH' => 'required',
            'ngay_tao' => 'required|date',
        ]);

        $hoadon = hoadon::findOrFail($id);
        $hoadon->update($request->all());

        return redirect()->route('hoa_dons.index')->with('success', 'Hóa đơn đã được cập nhật thành công!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hoadon = hoadon::findOrFail($id);
        $hoadon->delete();

        return redirect()->route('hoa_dons.index')->with('success', 'Hóa đơn đã được xóa thành công!');

    }
}
