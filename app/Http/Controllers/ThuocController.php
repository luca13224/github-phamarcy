<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thuoc;
use Illuminate\Support\Facades\DB;

class ThuocController
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $thuocsQuery = Thuoc::with('nhacungcap');

        if ($query) {
            $thuocs = Thuoc::where('ten_thuoc', 'LIKE', "%{$query}%")
                ->orWhere('lieu_luong', 'LIKE', "%{$query}%")
                ->paginate(10);
        } else {
            $thuocs = Thuoc::paginate(10);
        }

        return view('thuocs.index', compact('thuocs', 'query'));
    }

    public function create()
    {
        return view('thuocs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ma_thuoc' => 'required|integer',
            'ten_thuoc' => 'required',
            'thuong_hieu' => 'required',
            'lieu_luong' => 'required',
            'so_luong_ton' => 'required|integer',
            'gia_nhap' => 'required|numeric',
            'gia_ban' => 'required|numeric',
            'HSD' => 'required|date',
        ]);

        // Kiểm tra xem ma_thuoc đã tồn tại chưa
        $existingThuoc = Thuoc::where('ma_thuoc', $request->ma_thuoc)->first();
        if ($existingThuoc) {
            return redirect()->back()->withErrors(['error' => 'Mã thuốc đã tồn tại.']);
        }

        try {
            DB::statement('CALL ThemThuoc(?, ?, ?, ?, ?, ?, ?, ?)', [
                $request->ma_thuoc,
                $request->ten_thuoc,
                $request->thuong_hieu,
                $request->lieu_luong,
                $request->so_luong_ton,
                $request->gia_nhap,
                $request->gia_ban,
                $request->HSD
            ]);

            return redirect()->route('thuoc.index')->with('success', 'Thuốc đã được thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(string $ma_thuoc)
    {
        $thuoc = Thuoc::findOrFail($ma_thuoc);
        return view('thuocs.show', compact('thuoc'));
    }

    public function edit(string $id)
    {
        $thuoc = Thuoc::where('ma_thuoc', $id)->firstOrFail();
        return view('thuocs.edit', compact('thuoc'));
    }

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

    public function destroy($id)
    {
        $thuoc = Thuoc::where('ma_thuoc', $id)->firstOrFail();
        $thuoc->delete();

        return redirect()->route('thuoc.index')->with('success', 'Thuốc đã được xóa');
    }
}

