<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HDcuaKH 
{
public function index(Request $request)
{
    $thang = $request->input('thang', null);
    $nam = $request->input('nam', null);

    // Gọi function để lấy dữ liệu
    $result = DB::select("SELECT fn_KhachHangCoHDTheoThangNam(?, ?)", [$thang, $nam]);

    // Xử lý kết quả
    $data = [];
    if ($result) {
        // Chia tách kết quả từ chuỗi
        $data = explode('; ', $result[0]->fn_KhachHangCoHDTheoThangNam);
    }

    return view('khachhangs.index', compact('data'));
}
}