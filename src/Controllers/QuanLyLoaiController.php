<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Loai;

class QuanLyLoaiController extends Controller
{
    private $loaiModel;

    public function __construct()
    {
        $this->loaiModel = new Loai();
    }

    // Hiển thị danh sách
    public function index()
    {
        $loai_list = $this->loaiModel->getAllLoai();
        $this->render('GiaoDienAdmin/QuanLyLoai', ['loai_list' => $loai_list]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenLoai = $_POST['TenLoai'] ?? '';
            if (!empty($tenLoai)) {
                $this->loaiModel->createLoai($tenLoai);
            }
            header('Location: /Admin/QuanLyLoai');
        }
    }

    public function update()
    {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenLoai = $_POST['TenLoai'] ?? '';
            $this->loaiModel->updateLoai($id, $tenLoai);
            header('Location: /Admin/QuanLyLoai');
        }
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        $this->loaiModel->deleteLoai($id);
        header('Location: /Admin/QuanLyLoai');
    }
}