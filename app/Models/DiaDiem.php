<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaDiem extends Model
{
    use HasFactory;
    protected $table = 'dia_diems';
    protected $fillable = [
        'ten_tour',
        'thoi_gian',
        'dia_diem_chinh',
        'gia_goc',
        'gia_khuyen_mai',
        'hoat_dong_chinh',
        'mo_ta',
        'hinh_anh',
        'slot',
        'ticket',
        'ngay_khoi_hanh',
        'hinh_anh_2',
        'description_1',
        'description_2',
        'description_3',
    ];
    protected $casts = [
        'created_at' => 'datetime:d/m/Y', // Change your format
        'updated_at' => 'datetime:d/m/Y',
    ];
}
