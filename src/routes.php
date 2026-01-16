<?php

use App\Router;
use App\Controllers\GiaoDienController;
use App\Controllers\DangNhapController;
use App\Controllers\TruyenController;
use App\Controllers\ChuongController;
use App\Controllers\QuanLyLoaiController;     
use App\Controllers\QuanLyTaiKhoanController;
use App\Controllers\QuanLyTruyenController;
use App\Controllers\QuanLyChuongController;
use App\Controllers\QuanLyLoaiTruyenController;
use App\Controllers\DangKyController;
// Khởi tạo các Controller
$DangKyController = new DangKyController();
$giaoDienController = new GiaoDienController();
$dangNhapController = new DangNhapController();
$truyenController = new TruyenController();
$ChuongController = new ChuongController();
$QuanLyLoaiController = new QuanLyLoaiController();
$QuanLyTaiKhoanController = new QuanLyTaiKhoanController();
$QuanLyTruyenController = new QuanLyTruyenController();
$QuanLyChuongController = new QuanLyChuongController();
$QuanLyLoaiTruyenController = new QuanLyLoaiTruyenController();

$router = new Router();


if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

    $router->addRoute('#^/Admin/TrangChu$#', [$giaoDienController, 'TrangChuAdmin']);
    

    $router->addRoute('#^/Admin/QuanLyLoai$#', [$QuanLyLoaiController, 'index']);
    $router->addRoute('#^/Admin/QuanLyLoai/Them$#', [$QuanLyLoaiController, 'store']);
    $router->addRoute('#^/Admin/QuanLyLoai/CapNhat$#', [$QuanLyLoaiController, 'update']);
    $router->addRoute('#^/Admin/QuanLyLoai/Xoa$#', [$QuanLyLoaiController, 'update']);
    $router->addRoute('#^/Admin/QuanLyLoai/Xoa$#', [$QuanLyLoaiController, 'delete']);
    // Quản lý Truyện
    $router->addRoute('#^/Admin/QuanLyTruyen$#', [$QuanLyTruyenController, 'index']); 
    $router->addRoute('#^/Admin/QuanLyTruyen/Them$#', [$QuanLyTruyenController, 'them']);   
    $router->addRoute('#^/Admin/QuanLyTruyen/Store$#', [$QuanLyTruyenController, 'store']);  
    $router->addRoute('#^/Admin/QuanLyTruyen/Sua$#', [$QuanLyTruyenController, 'sua']);
    $router->addRoute('#^/Admin/QuanLyTruyen/Update$#', [$QuanLyTruyenController, 'update']);
    $router->addRoute('#^/Admin/QuanLyTruyen/Xoa$#', [$QuanLyTruyenController, 'xoa']);
    
    
    // Quản lý Chuong
    $router->addRoute('#^/Admin/QuanLyTruyen/ChiTietChuong$#', [$QuanLyTruyenController, 'chiTietChuong']);
    $router->addRoute('#^/Admin/QuanLyTruyen/ChiTietChuong/FormThem$#', [$QuanLyChuongController, 'formthemChuong']);
    $router->addRoute('#^/Admin/QuanLyTruyen/ChiTietChuong/Them$#', [$QuanLyChuongController, 'themChuong']);
    $router->addRoute('#^/Admin/QuanLyTruyen/ChiTietChuong/FormSua$#', [$QuanLyChuongController, 'formsuaChuong']);
    $router->addRoute('#^/Admin/QuanLyTruyen/ChiTietChuong/Sua$#', [$QuanLyChuongController, 'updateChuong']);
    $router->addRoute('#^/Admin/QuanLyTruyen/ChiTietChuong/Xoa$#', [$QuanLyChuongController, 'xoaChuong']);
    // Quản lý Tài Khoản
    $router->addRoute('#^/Admin/QuanLyTaiKhoan$#', [$QuanLyTaiKhoanController, 'index']);
    $router->addRoute('#^/Admin/QuanLyTaiKhoan/CapQuyen$#', [$QuanLyTaiKhoanController, 'capQuyen']);
    // Quản lý Loại Truyện cho từng truyện
    $router->addRoute('#^/Admin/QuanLyTruyen/ChiTietLoai$#', [$QuanLyLoaiTruyenController, 'chiTietLoai']);
    $router->addRoute('#^/Admin/QuanLyTruyen/ChiTietLoai/Them$#', [$QuanLyLoaiTruyenController, 'them']);
    $router->addRoute('#^/Admin/QuanLyTruyen/ChiTietLoai/Xoa$#', [$QuanLyLoaiTruyenController, 'delete']);
} 
else if (strpos($_SERVER['REQUEST_URI'], '/Admin/') === 0) {
    header('Location: /TrangChu');
    exit;
}
$router->addRoute('#^/$#', [$giaoDienController, 'TrangChu']);
$router->addRoute('#^/TrangChu$#', [$giaoDienController, 'TrangChu']);
$router->addRoute('#^/DangKy$#', [$DangKyController, 'DangKyForm']);
$router->addRoute('#^/XyLyDangKy$#', [$DangKyController, 'DangKy']);
$router->addRoute('#^/DangXuat$#', [$dangNhapController, 'logout']);
$router->addRoute('#^/DangNhap$#', [$dangNhapController, 'loginForm']);
$router->addRoute('#^/XyLyDangNhap$#', [$dangNhapController, 'login']);
$router->addRoute('#^/DanhSachTruyen$#', [$truyenController, 'index']);
$router->addRoute('#^/DanhSachTruyen/RandomTruyen$#', [$truyenController, 'randomTruyen']);
$router->addRoute('#^/DanhSachTruyen/ChiTietTruyen$#', [$truyenController, 'show']);
$router->addRoute('#^/DanhSachTruyen/ChiTietTruyen/ChuongChiTiet$#', [$ChuongController, 'show']);
$router->addRoute('#^/Truyen/XuLyDanhGia$#', [$truyenController, 'submitRating']);
$router->addRoute('#^/XepHang$#', [$truyenController, 'xepHang']);
$router->addRoute('#^/profile$#', [$giaoDienController, 'Profile']);