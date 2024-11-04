<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khachhang extends Model
{
    use HasFactory;
    protected $table = 'khachhang';
    protected $primaryKey = 'ma_KH'; // Đặt khóa chính
    public $incrementing = false; // Nếu ma_thuoc không phải là số tự tăng
    public $timestamps = false;
    protected $fillable = ['ma_KH','ten_KH','SDT_KH','gioi_tinh','ngay_sinh','diem_tich'];
    public function hoadon()
    {
        return $this->hasMany(hoadon::class, 'ma_KH');
    }
}
