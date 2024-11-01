<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\khachhang;
use Illuminate\Support\Facades\DB;

class KhachHangController 
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $khachHangs = DB::table('khachhang as kh')
        ->leftJoin('v_LichSuMuaKH as ls', 'kh.ma_KH', '=', 'ls.ma_KH')
        ->select('kh.*', 
             DB::raw('COALESCE(ls.So_don_hang, 0) as So_don_hang'), 
             DB::raw('COALESCE(ls.Tong_chi_tieu, 0) as Tong_chi_tieu'))
        ->when($query, function ($queryBuilder) use ($query) {
        return $queryBuilder->where('kh.ten_KH', 'LIKE', "%{$query}%")
            ->orWhere('kh.SDT_KH', 'LIKE', "%{$query}%");
    })
    ->paginate(10); 
    return view('khachhangs.index', compact('khachHangs', 'query'));
}
    public function show(string $id)
    {
        $khachhang = KhachHang::where('ma_KH', $id)->firstOrFail();
        return view('khach-hangs.show', compact('khachhang'));
    }
    public function create()
    {
        return view('khachhangs.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'ten_KH' => 'required',
            'SDT_KH' => 'required',
            'gioi_tinh' => 'required',
            'ngay_sinh' => 'required|date',
            'diem_tich' => 'integer'
        ]);

        try {
            KhachHang::create($request->all());
            return redirect()->route('khach-hangs.index')->with('success', 'Khách hàng đã được thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $khachhang = KhachHang::where('ma_KH', $id)->firstOrFail();
        return view('khachhangs.edit', compact('khachhang'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'ten_KH' => 'required',
        'SDT_KH' => 'required',
        'gioi_tinh' => 'required',
        'ngay_sinh' => 'required|date',
        'diem_tich' => 'integer'
    ]);

    // Sử dụng đúng model và khóa chính
    $khachhang = KhachHang::where('ma_KH', $id)->firstOrFail(); 
    $khachhang->update($request->only(['ten_KH', 'SDT_KH', 'gioi_tinh', 'ngay_sinh', 'diem_tich']));

    return redirect()->route('khach-hangs.index')->with('success', 'Khách hàng đã được cập nhật thành công!');
}
    public function destroy($id)
    {
        $khachhang = KhachHang::where('ma_KH', $id)->firstOrFail(); 
        $khachhang->delete();
        return redirect()->route('khach-hangs.index')->with('success', 'Khách hàng đã được xóa thành công!');
    }
       
}
