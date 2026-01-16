<?php

namespace App\Controllers;
use App\Controller;
use App\Models\Chuong;
class ChuongController extends Controller
{
    private $ChuongModel;
    public function __construct()
    {
        $this->chuongModel = new Chuong();
    }

    public function show() {
        $maChuong = $_GET['id'] ?? null;

        if (!$maChuong) {
            header('Location: /DanhSachTruyen');
            exit;
        }

        // Lấy thông tin chi tiết chương
        $chuongDetail = $this->chuongModel->getChuongDetail($maChuong);

        $this->render('GiaoDienUser/ChiTietChuong', [
            'chapter' => $chuongDetail
        ]);
    }
}