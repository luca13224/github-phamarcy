<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\thuoc;

class ThuocController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thuocs = thuoc::paginate(10);
        return view('thuocs.index', compact('thuocs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('thuocs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            //'ma_thuoc' => 'required|unique:thuoc,ma_thuoc|integer',
            'ten_thuoc' => 'required',
            'thuong_hieu' => 'required',
            'lieu_luong' => 'required',
            'so_luong_ton' => 'required|integer',
            'gia_nhap' => 'required|numeric',
            'gia_ban' => 'required|numeric',
            'HSD' => 'required|date',
        ]);

        thuoc::create($request->all());

        return redirect()->route('thuoc.index')->with('success', 'Thuốc đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ma_thuoc)
    {
        $thuoc = thuoc::findOrFail($ma_thuoc);
        return view('thuocs.show', compact('thuoc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $thuoc = Thuoc::where('ma_thuoc', $id)->firstOrFail();

        return view('thuocs.edit', compact('thuoc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'ten_thuoc' => 'required',
            'thuong_hieu' => 'required',
            'lieu_luong' => 'required',
            'so_luong_ton' => 'required|integer',
            'gia_nhap' => 'required|numeric',
            'gia_ban' => 'required|numeric',
            'HSD' => 'required|date',
        ]);

        $thuoc = Thuoc::where('ma_thuoc', $id)->firstOrFail();
        $thuoc->update($request->only(['ten_thuoc', 'thuong_hieu', 'lieu_luong', 'so_luong_ton', 'gia_nhap', 'gia_ban', 'HSD']));

        return redirect()->route('thuoc.index')->with('success', 'Thuốc đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $thuoc = Thuoc::where('ma_thuoc', $id)->firstOrFail();
        $thuoc->delete();
    
        return redirect()->route('thuoc.index')->with('success', 'Thuốc đã được xóa');
    }
    
}
