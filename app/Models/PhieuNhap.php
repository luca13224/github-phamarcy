<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuNhap extends Model
{
    use HasFactory;
    protected $table = 'phieunhap';
    protected $primaryKey = 'ma_PN'; // Đặt khóa chính
    public $incrementing = false; // Nếu ma_thuoc không phải là số tự tăng
    public $timestamps = false;
    
    protected $fillable = ['ma_PN','ngay_dat','ngay_nhap'];
    public function ChiTiet()
    {
        return $this->hasMany(ChiTietNhapHang::class, 'ma_PN','ma_PN');
    }
}
