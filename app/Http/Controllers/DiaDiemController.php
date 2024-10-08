<?php

namespace App\Http\Controllers;

use App\Models\DiaDiem;
use Illuminate\Http\Request;

class DiaDiemController extends Controller
{
    public function select()
    {
        $data = DiaDiem::get();
        $new = DiaDiem::orderByDESC('id')
            ->take(9)
            ->get();
        $outstanding = DiaDiem::orderByDESC('gia_khuyen_mai')
            ->take(9)
            ->get();
        return response()->json([
            'data' => $data,
            'new'  => $new,
            'outstanding'  => $outstanding,
        ]);
    }

    public function selectChiTietSanPham($id)
    {
        $diadiem = DiaDiem::where('id', $id)->first();
        if ($diadiem) {
            return response()->json([
                'status' => true,
                'data'   => $diadiem,
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => "Không Có Sản Phẩm!"
            ]);
        }
    }

    public function timKiemTrangChu(Request $request)
    {
        $tim_kiem = "%" . $request->thong_tin_tim . "%";

        $data   = DiaDiem::where('ten_tour', "like", $tim_kiem)->get();
        // $danh_muc = $danh_muc =  DanhMuc::where('id', $request->id)->first();

        return response()->json([
            'data' => $data,
            // 'danh_muc' => $danh_muc
        ]);
    }
}
