<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nhacungcap;

class NhaCungCapController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nhacungcaps = nhacungcap::paginate(10);
        return view('nha_cung_caps.index', compact('nhaCungCaps'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nha_cung_caps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ten_NCC' => 'required',
            'SDT' => 'required',
            'dia_chi' => 'required',
        ]);

        nhacungcap::create($request->all());

        return redirect()->route('nha_cung_caps.index')->with('success', 'Nhà cung cấp đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nhacungcap = nhacungcap::findOrFail($id);
        return view('nha_cung_caps.show', compact('nhacungcap'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nhacungcap = nhacungcap::findOrFail($id);
        return view('nha_cung_caps.edit', compact('nhacungcap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ten_NCC' => 'required',
            'SDT' => 'required',
            'dia_chi' => 'required',
        ]);

        $nhacungcap = nhacungcap::findOrFail($id);
        $nhacungcap->update($request->all());

        return redirect()->route('nha_cung_caps.index')->with('success', 'Nhà cung cấp đã được cập nhật');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nhacungcap = nhacungcap::findOrFail($id);
        $nhacungcap->delete();

        return redirect()->route('nha_cung_caps.index')->with('success', 'Nhà cung cấp đã được xóa thành công!');
    }
}
