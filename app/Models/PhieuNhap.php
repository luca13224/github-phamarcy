<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuNhap extends Model
{
    use HasFactory;
    protected $fillable = ['ma_PN','ngay_dat','ngay_nhap'];
    public function ChiTietPhieuNhap()
    {
        return $this->hasMany(ChiTietPhieuNhap::class, 'ma_PN');
    }
}
