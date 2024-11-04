<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class LichSuMuaController 
{
    public function index(Request $request)
    {
        // Lấy dữ liệu từ request
        $tenKhachHang = $request->input('ten_khach_hang', '%');
        $startDate = $request->input('start_date', null);
        $endDate = $request->input('end_date', null);
    
        // Ghi lại giá trị tham số để kiểm tra
        \Log::info('Tham số tìm kiếm:', [
            'ten_khach_hang' => $tenKhachHang,'%' ,
            'start_date' => $startDate ,null,
            'end_date' => $endDate, null
        ]);
    
        $results = DB::select("CALL sp_LichSuMuaKH(?, ?, ?)", [$tenKhachHang, $startDate, $endDate]);
    
        // Kiểm tra kết quả
        if (empty($results)) {
            return back()->with('message', 'Không tìm thấy kết quả nào.');
        }

        // Chuyển đổi kết quả thành một paginated collection
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = collect($results)->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $paginator = new LengthAwarePaginator(
            $currentItems,
            count($results),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('lichsumua.index', compact('paginator'));
    }
}
