<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhacungcap extends Model
{
    use HasFactory;
    protected $table = 'nhacungcap';
    protected $primaryKey = 'ma_NCC'; // Đặt khóa chính
    public $incrementing = false; // Nếu ma_thuoc không phải là số tự tăng
    public $timestamps = false;
    
    protected $fillable = ['ma_NCC','ten_NCC','SDT','dia_chi'];
    public function thuoc()
    {
        return $this->belongsToMany(thuoc::class, 'NCC_Thuoc', 'ma_NCC', 'ma_thuoc');
    }
}
