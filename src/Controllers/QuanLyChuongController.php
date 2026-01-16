<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Chuong;
use App\Models\Truyen;

class QuanLyChuongController extends Controller
{
    private $chuongModel;

    public function __construct()
    {
        $this->chuongModel = new Chuong();
    }
    public function formthemChuong()
    {
        $maTruyen = $_GET['id'] ?? null;

        $this->render('GiaoDienAdmin/ThemChuong', [
            'maTruyen' => $maTruyen
        ]);
    }
    public function themChuong()
    {
        $maTruyen = $_GET['id'] ?? null;
        $soChuong = $_POST['soChuong'];
        $tenChuong = $_POST['tenChuong'];
        $noiDung = $_POST['noiDung'];

        $this->chuongModel->createChuong($maTruyen, $soChuong, $tenChuong, $noiDung);

        header("Location: /Admin/QuanLyTruyen/ChiTietChuong?id=$maTruyen");
        exit;
    }


    public function formsuaChuong()
    {
        $maChuong = $_GET['id'] ?? null;
        $matruyen = $_GET['matruyen'] ?? null;  
        if (!$maChuong) {
            header('Location: /Admin/QuanLyTruyen');
            exit;
        }

        $chuong = $this->chuongModel->getChuongDetail($maChuong);

        $this->render('GiaoDienAdmin/SuaChuong', [
            'matruyen' => $matruyen,
            'chuong' => $chuong
        ]);
    }

    // Xử lý POST cập nhật chương
    public function updateChuong()
    {
        $maTruyen = $_GET['matruyen'] ?? null;
        $maChuong = $_GET['id'] ?? null;
        $soChuong = $_POST['soChuong'];
        $tenChuong = $_POST['tenChuong'];
        $noiDung = $_POST['noiDung'];

        $this->chuongModel->updateChuong($maChuong, $soChuong, $tenChuong, $noiDung);
        header("Location: /Admin/QuanLyTruyen/ChiTietChuong?id=$maTruyen");
        exit;  
    }

    // Xóa chương
    public function xoaChuong()
    {
        $maChuong = $_GET['id'] ?? null;
        if ($maChuong) {
            $chuong = $this->chuongModel->getChuongDetail($maChuong);
            $maTruyen = $chuong['MaTruyen'];
            $this->chuongModel->deleteChuong($maChuong);

            header("Location: /Admin/QuanLyTruyen/ChiTietChuong?id=$maTruyen");
            exit;
        }

        header('Location: /Admin/QuanLyTruyen');
        exit;
    }
}
