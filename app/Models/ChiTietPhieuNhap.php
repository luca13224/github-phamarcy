<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuNhap extends Model
{
    use HasFactory;
    protected $fillable = ['ma_CTNH','ma_PN','ma_thuoc','so_luong_nhap'];
    public function phieunhap()
    {
        return $this->belongsTo(phieunhap::class,'ma_PN');
    }
    public function thuoc()
    {
        return $this->belongsTo(thuoc::class,'ma_thuoc');
    }
    
}
