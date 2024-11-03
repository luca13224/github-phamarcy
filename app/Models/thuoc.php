<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thuoc extends Model
{
    use HasFactory;
    protected $table = 'thuoc'; // Đảm bảo tên bảng chính xác
    protected $primaryKey = 'ma_thuoc'; // Đặt khóa chính
    public $incrementing = false; // Nếu ma_thuoc không phải là số tự tăng
    public $timestamps = false;
    protected $fillable = ['ma_thuoc','ten_thuoc','thuong_hieu','lieu_luong','so_luong_ton','gia_nhap','gia_ban','HSD'];
    public function nhacungcap()
    {
        return $this->belongsToMany(NhaCungCap::class, 'ncc_thuoc', 'ma_thuoc', 'ma_ncc');
    }

    // Quan hệ một-nhiều với ChiTietHD
    public function ChiTietHD()
    {
        return $this->hasMany(ChiTietHD::class, 'ma_thuoc');
    }
    public function ChiTietPhieuHang()
    {
        return $this->hasMany(ChiTietNhapHang::class, 'ma_thuoc','ma_thuoc');
    }
}
