<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang;
use App\Models\DiaDiem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietDonHangController extends Controller
{
    public function themVaoGioHang(Request $request)
    {
        $khachhang = Auth::guard('sanctum')->user();
        $diadiem = DiaDiem::where('id', $request->id_san_pham)->first();
        if ($diadiem) {
            if ($diadiem->gia_khuyen_mai > 0) {
                $dongia = $diadiem->gia_khuyen_mai;
            } else {
                $dongia = $diadiem->gia_ban;
            }
            $tim = ChiTietDonHang::where('id_khach_hang', $khachhang->id)
                ->where('id_san_pham', $diadiem->id)
                ->whereNull('id_hoa_don')
                ->first();
            if ($tim) {
                $tim->so_luong   = $tim->so_luong + 1;
                $tim->thanh_tien = $tim->so_luong * $dongia;
                $tim->save();
            } else {
                ChiTietDonHang::create([
                    'id_khach_hang'     => $khachhang->id,
                    'id_san_pham'       => $diadiem->id,
                    'don_gia'           => $dongia,
                    'thanh_tien'        => $dongia * 1,
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => "Tour đã được thêm vào giỏ hàng thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }
    public function store()
    {
        $khachhang = Auth::guard('sanctum')->user();
        $data = ChiTietDonHang::where('id_khach_hang', $khachhang->id)
            ->join('dia_diems', 'dia_diems.id', 'chi_tiet_don_hangs.id_san_pham')
            ->select('dia_diems.hinh_anh', 'dia_diems.ten_tour', 'dia_diems.ticket', 'dia_diems.ngay_khoi_hanh', 'chi_tiet_don_hangs.*') // dia_diems.so_luong , dia_diems.ngay_khoi_hanh
            ->whereNull('id_hoa_don')->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function listChon(Request $request)
    {
        $khach_hang = Auth::guard('sanctum')->user();
        // $sanpham = SanPham::where('id', $request->id_san_pham)->first();
        $check = ChiTietDonHang::where('id', $request->ds_mua_sp)->where('id', $khach_hang->id)->get();
        if ($check) {
            if (count($request->ds_mua_sp) < 1) {
                return response()->json([
                    'status' => false,
                    'message' => "Bạn dã chọn Tour nào đâu mà Book"
                ]);
            } else {
                foreach ($request->ds_mua_sp as $key => $value) {
                    ChiTietDonHang::where('id', $value['id'])->update([
                        'is_gio_ve'    => 1,
                    ]);
                };
            }
        }
    }

    public function giohang(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $data = ChiTietDonHang::where('id_khach_hang', $user->id)->where('is_gio_ve', 1)
            ->join('dia_diems', 'dia_diems.id', 'chi_tiet_don_hangs.id_san_pham')
            ->select('dia_diems.hinh_anh', 'dia_diems.ten_tour', 'chi_tiet_don_hangs.*')
            ->whereNull('id_hoa_don')->get();
        return response()->json([
            'data'   => $data
        ]);
    }

    public function destroy(Request $request)
    {
        $khachhang = Auth::guard('sanctum')->user();
        $giohang = ChiTietDonHang::where('id', $request->id)->where('id_khach_hang', $khachhang->id)->first();
        if ($giohang) {
            $giohang->delete();
            return response()->json([
                'status' => true,
                'message' => "Tour này đã được xóa khỏi vào giỏ hàng thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }
}
