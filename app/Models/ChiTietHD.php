<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHD extends Model
{
    use HasFactory;
    protected $fillable = ['ma_CTHD','ma_HD','ma_thuoc','so_luong'];
    
    public function hoadon()
    {
        return $this->belongsTo(hoadon::class);
    }
    public function thuoc()
    {
        return $this->belongsTo(thuoc::class);
    }
}
