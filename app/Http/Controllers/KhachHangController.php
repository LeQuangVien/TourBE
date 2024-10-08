<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KhachHangController extends Controller
{
    public function dangky(Request $request)
    {
        try {
            KhachHang::create([
                'ho_va_ten'     => $request->ho_va_ten,
                'email'         => $request->email,
                'so_dien_thoai' => $request->so_dien_thoai,
                'password'      => bcrypt($request->password),
            ]);
            return response()->json([
                'status'     => true,
                'message'   => "Đăng Ký Tài Khoản Thành Công!"
            ]);
        } catch (Exception) {
            return response()->json([
                'status'    => false,
                'message'   => "Đăng Ký Thất Bại!"
            ]);
        }
    }

    public function checkEmail(Request $request)
    {
        $data = KhachHang::where('email', $request->email)
            ->where('id', '<>', $request->id)
            ->first();
        if ($data) {
            return response()->json([
                'status'   =>   true,
                'message'  => "Email này đã tồn tại! Vui lòng nhập Email Mới"
            ]);
        } else {
            return response()->json([
                'status'   =>   false,
                'message'  => 'Email có thể dùng'
            ]);
        }
    }

    public function kichHoatTaiKhoan(Request $request)
    {
        $khach_hang = KhachHang::where('id', $request->id)->first();
        if ($khach_hang) {
            if ($khach_hang->is_active == 0) {
                $khach_hang->is_active = 1;
                $khach_hang->save();

                return response()->json([
                    'status' => true,
                    'message' => "Đã kích hoạt tài khoản thành công!"
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function dangNhap(Request $request)
    {
        $check = Auth::guard('khach_hang')->attempt([
            'email'   => $request->email,
            'password' => $request->password
        ]);
        if ($check) {
            $user = Auth::guard('khach_hang')->user();
            if ($user->is_active == 0) {
                return response()->json([
                    'message'  =>   'Tài khoản của bạn chưa được kích hoạt!',
                    'status'   =>   2
                ]);
            } else {
                if ($user->is_block) {
                    return response()->json([
                        'message'  =>   'Tài khoản của bạn đã bị khóa!',
                        'status'   =>   0
                    ]);
                }
                return response()->json([
                    'message'   =>   'Đã đăng nhập thành công!',
                    'status'    =>   1,
                    'chia_khoa' =>   $user->createToken('ma_so_bi_mat_khach_hang')->plainTextToken,
                    'ten_kh'    =>   $user->ho_va_ten
                ]);
            }
        } else {
            return response()->json([
                'message'  =>   'Tài khoản hoặc mật khẩu không đúng!',
                'status'   =>   0
            ]);
        }
    }

    public function checkloginUser()
    {
        $khach_hang = $this->isUserKhachHang();
        if ($khach_hang) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Vui lòng đăng nhập"
            ]);
        }
    }

    public function dangxuat()
    {
        $khach_hang = Auth::guard('sanctum')->user();
        if ($khach_hang) {
            DB::table('personal_access_tokens')
                ->where('id', $khach_hang->currentAccessToken()->id)->delete();
            return response()->json([
                'status' => true,
                'message' => "Đã đăng xuất thiết bị này thành công"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Vui lòng đăng nhập"
            ]);
        }
    }

    public function dangXuatTatCaThietBi()
    {
        $khach_hang = Auth::guard('sanctum')->user();
        if ($khach_hang) {
            $ds_token = $khach_hang->tokens;
            foreach ($ds_token as $k => $v) {
                $v->delete();
            }
            return response()->json([
                'status' => true,
                'message' => "Đã đăng xuất tất cả thiết bị này thành công"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Vui lòng đăng nhập"
            ]);
        }
    }
}
