<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_don_hangs';
    protected $fillable = [
        'id_khach_hang',
        'id_san_pham',
        // 'id_so_luong',
        // 'id_ngay_khoi_hanh',
        'don_gia',
        'thanh_tien',
        'id_hoa_don',
        'ghi_chu',
        'is_giao_kho',
        'is_giao_ve'
    ];
}
