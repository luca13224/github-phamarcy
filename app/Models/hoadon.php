<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hoadon extends Model
{
    use HasFactory;
    protected $table = 'HoaDon'; // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'ma_HD'; // Khóa chính nếu khác với id
    protected $fillable = ['ma_HD','ma_NV','ma_KH','ngay_tao'];
    public function nhanvien()
    {
        return $this->belongsTo(nhanvien::class,'ma_NV');
    }
    public function khachhang()
    {
        return $this->belongsTo(khachhang::class,'ma_KH','ma_KH');
    }
    public function ChiTietHD()
    {
        return $this->hasMany(ChiTietHD::class, 'ma_HD');
    }
}
