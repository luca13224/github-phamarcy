<?php
namespace App\Http\Controllers;

use App\Models\nhacungcap;
use App\Models\thuoc;
use Illuminate\Http\Request;

class NhaCungCapController extends Controller
{
    public function index()
    {
        // Lấy tất cả nhà cung cấp
        $nhaCungCaps = nhacungcap::with('thuocs')->paginate(10);  // Liên kết với bảng thuốc
        return view('nha_cung_caps.index', compact('nhaCungCaps'));
    }

    public function create()
    {
        return view('nha_cung_caps.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten_NCC' => 'required',
            'SDT' => 'required',
            'dia_chi' => 'required'
        ]);

        nhacungcap::create($validatedData);
        return redirect()->route('nha_cung_cap.index');
    }

    public function edit($id)
    {
        $nhaCungCap = nhacungcap::findOrFail($id);
        return view('nha_cung_caps.edit', compact('nhaCungCaps'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ten_NCC' => 'required',
            'SDT' => 'required',
            'dia_chi' => 'required'
        ]);

        nhacungcap::where('ma_NCC', $id)->update($validatedData);
        return redirect()->route('nha_cung_cap.index');
    }

    public function destroy($id)
    {
        $nhaCungCap = nhacungcap::findOrFail($id);
        $nhaCungCap->delete();
        return redirect()->route('nha_cung_cap.index');
    }

    public function show($id)
    {
        $nhaCungCap = nhacungcap::with('thuocs')->find($id);
        return view('nha_cung_caps.show', compact('nhaCungCaps'));
    }

}
