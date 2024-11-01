<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhanvien extends Model
{
    use HasFactory;
    protected $fillable = ['ma_NV','ten_NV','SDT','dia_chi','ngay_sinh'];
    public function hoadon()
    {
        return $this->hasMany(hoadon::class, 'ma_NV');
    }
}
