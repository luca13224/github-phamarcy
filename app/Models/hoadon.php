<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hoadon extends Model
{
    use HasFactory;
    protected $table = 'HoaDon'; // Đảm bảo tên bảng chính xác
    protected $primaryKey = 'ma_HD'; // Khóa chính
    public $timestamps = false; // Nếu bảng không có timestamps
    protected $fillable = ['ma_NV', 'ma_KH', 'ngay_tao']; // Các trường có thể điền
    public function chiTietHD()
    {
        return $this->hasMany(ChiTietHD::class, 'ma_HD', 'ma_HD'); // Đảm bảo các tên cột chính xác
    }

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'ma_KH', 'ma_KH');
    }

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'ma_NV', 'ma_NV');
    }
}
