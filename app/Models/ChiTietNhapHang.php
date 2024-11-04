<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietNhapHang extends Model
{
    use HasFactory;
    protected $table = 'chitietnhaphang';
    protected $primaryKey = 'ma_CTNH'; // Đặt khóa chính
    public $incrementing = false; // Nếu ma_thuoc không phải là số tự tăng
    public $timestamps = false;
    
    protected $fillable = ['ma_PN','ma_thuoc','so_luong_nhap'];
    public function phieuNhap()
    {
        return $this->belongsTo(PhieuNhap::class, 'ma_PN', 'ma_PN');
    }
    public function thuoc()
    {
        return $this->belongsTo(thuoc::class,'ma_thuoc','ma_thuoc');
    }
    
}
