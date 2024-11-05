<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhacungcap extends Model
{
    use HasFactory;
    protected $table = 'nhacungcap';
    protected $primaryKey = 'ma_NCC'; // Set the primary key
    public $incrementing = false; // If ma_NCC is not auto-incrementing
    public $timestamps = false;
    protected $fillable = ['ma_NCC','ten_NCC','SDT','dia_chi'];

    public function thuocs()
    {
        return $this->belongsToMany(thuoc::class, 'ncc_thuoc', 'ma_NCC', 'ma_thuoc');
    }
}
