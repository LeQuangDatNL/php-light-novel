<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Loai;

class QuanLyLoaiTruyenController extends Controller
{
    private $loaiModel;

    public function __construct()
    {
        $this->loaiModel = new Loai();
    }

    // Hiển thị chi tiết loại của một truyện
    public function chiTietLoai()
    {
        $maTruyen = $_GET['id'] ?? 0;
        if (!$maTruyen) {
            header('Location: /Admin/QuanLyTruyen');
            exit;
        }

        $loai_list = $this->loaiModel->getAllLoai();  
        $loai_truyen = $this->loaiModel->getAllLoaiTruyen($maTruyen);

        $this->render('GiaoDienAdmin/QuanLyLoaiTruyen', [
            'listLoai' => $loai_list,       
            'loai_truyen' => $loai_truyen,  
            'maTruyen' => $maTruyen
        ]);
    }

    // Thêm loại vào truyện
    public function them()
    {
        // Lấy MaLoai từ GET hoặc POST
        $maLoai = $_GET['maLoai'] ?? $_POST['maLoai'] ?? null;
        $maTruyen = $_GET['maTruyen'] ?? $_POST['MaTruyen'] ?? null;

        if ($maLoai && $maTruyen) {
            $this->loaiModel->addLoaiToTruyen($maLoai, $maTruyen);
        }

        header("Location: /Admin/QuanLyTruyen/ChiTietLoai?id=$maTruyen");
        exit;
    }

    // Xóa loại khỏi truyện
    public function delete()
    {
        $maLoai = $_GET['id'] ?? null;
        $maTruyen = $_GET['MaTruyen'] ?? null;

        if ($maLoai && $maTruyen) {
            $this->loaiModel->deleteLoaiFromTruyen($maLoai, $maTruyen);
            header("Location: /Admin/QuanLyTruyen/ChiTietLoai?id=$maTruyen");
            exit;
        }

        header("Location: /Admin/QuanLyTruyen");
        exit;
    }
}
