<?php

use App\Http\Controllers\ChiTietDonHangController;
use App\Http\Controllers\ConTactController;
use App\Http\Controllers\DiaChiController;
use App\Http\Controllers\DiaDiemController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\KhachHangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/trang-chu/dia-diem/select', [DiaDiemController::class, 'select']);
Route::get('trang-chu/chi-tiet-dia-diem/select/{id}', [DiaDiemController::class, 'selectChiTietSanPham']);


//khach hang
Route::post('/khach-hang/dang-ky', [KhachHangController::class, 'dangky']);
Route::post('/khach-hang/kich-hoat-tai-khoan', [KhachHangController::class, 'kichHoatTaiKhoan']);

Route::get('/kich-hoat-tai-khoan/{id}',                 [KhachHangController::class, 'kichHoatTaiKhoanMail']); // Mail


Route::post('/khach-hang/dang-nhap', [KhachHangController::class, 'dangNhap']);
Route::post('/khach-hang/check-login', [KhachHangController::class, 'checkloginUser']);
Route::get('/khach-hang/dang-xuat',                     [KhachHangController::class, 'dangxuat']);
Route::get('/khach-hang/dang-xuat-tat-ca-thiet-bi',     [KhachHangController::class, 'dangXuatTatCaThietBi']);
Route::post('/khach-hang/check-email',                  [KhachHangController::class, 'checkEmail']);
//profile
Route::get('/khach-hang/thong-tin',                     [KhachHangController::class, 'thongTin']);
Route::post('/khach-hang/updateProfile',                [KhachHangController::class, 'updateProfile']);
Route::post('/khach-hang/updatePassword',               [KhachHangController::class, 'updatePassword']);

// them vao gio hang
Route::post('chi-tiet-don-hang/them-vao-gio-hang', [ChiTietDonHangController::class, 'themVaoGioHang']);
Route::get('chi-tiet-don-hang/select-gio-hang',         [ChiTietDonHangController::class, 'store']);
Route::post('/gio-hang/list-chon-san-pham',             [ChiTietDonHangController::class, 'listChon']);
Route::post('chi-tiet-don-hang/delete-san-pham-gio-hang', [ChiTietDonHangController::class, 'destroy']);

//trang thanh toan
Route::get('/gio-hang/gio-hang-thanh-toan',             [ChiTietDonHangController::class, 'giohang']);


// diachi
Route::post('dia-chi/create',                           [DiaChiController::class, 'create']);
//thanh toan
Route::post('/don-hang/thanh-toan',                     [DonHangController::class, 'thanhToan']);
// tim kiem
Route::post('/trang-chu/tim-kiem', [DiaDiemController::class, 'timKiemTrangChu']);


//contact
Route::post('/contact/post', [ConTactController::class, 'create']);

//Đơn Hàng
Route::get('/profile/thong-tin-don-hang', [DonHangController::class, 'donHangProfile']);
