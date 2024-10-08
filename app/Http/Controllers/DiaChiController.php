<?php

namespace App\Http\Controllers;

use App\Models\DiaChi;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiaChiController extends Controller
{

    public function create(Request $request)
    {
        $khach_hang = Auth::guard('sanctum')->user();
        if ($khach_hang) {
            $khach_hang = DiaChi::create([
                'id_khach_hang'     => $khach_hang->id,
                'ten_nguoi_nhan'    => $request->ten_nguoi_nhan,
                'so_dien_thoai'     => $request->so_dien_thoai,
                'dia_chi'           => $request->dia_chi,
                'email'             =>  $request->email,
                'ghi_chu'           =>  $request->ghi_chu,
            ]);
            return response()->json([
                'status' => true,
                'message' => "Bạn đã thêm mới địa chỉ thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }
}
