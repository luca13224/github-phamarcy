<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHD extends Model
{
    use HasFactory;
    protected $table = 'ChiTietHD'; 
    protected $primaryKey = 'ma_CTHD'; // Đặt khóa chính
    public $incrementing = false; // Nếu ma_thuoc không phải là số tự tăng
    public $timestamps = false;
    
    protected $fillable = ['ma_HD','ma_thuoc','so_luong'];
    
    public function hoadon()
    {
        return $this->belongsTo(hoadon::class);
    }
    public function thuoc()
    {
        return $this->belongsTo(Thuoc::class, 'ma_Thuoc', 'ma_thuoc'); // Đảm bảo khóa ngoại đúng
    }

}
