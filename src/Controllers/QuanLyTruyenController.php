<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Truyen;
use App\Models\Chuong;
class QuanLyTruyenController extends Controller
{
    private $truyenModel;
    private $chuongModel;
     
    public function __construct()
    {
        $this->truyenModel = new Truyen();
        $this->chuongModel = new Chuong();
    }


    public function index()
    {
        $truyen_list = $this->truyenModel->getAllTruyen();
        $this->render('GiaoDienAdmin/QuanLyTruyen', ['truyen_list' => $truyen_list]);
    }


    public function them()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bia = '';

            if (!empty($_FILES['bia']['name'])) {
                $uploadDir = __DIR__ . '/../../public/LightNovel/Bia/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $ext = pathinfo($_FILES['bia']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid('bia_', true) . '.' . $ext;

                move_uploaded_file(
                    $_FILES['bia']['tmp_name'],
                    $uploadDir . $fileName
                );

                $bia = '/public/LightNovel/Bia/' . $fileName;
            }

            $this->truyenModel->createTruyen(
                $_POST['tenTruyen'],
                $_POST['moTa'],
                $_POST['tacGia'],
                $bia
            );

            header('Location: /Admin/QuanLyTruyen');
            exit;
        }

        $this->render('GiaoDienAdmin/ThemTruyen');
    }

    public function sua()
    {
        $maTruyen = $_GET['id'] ?? null;
        if (!$maTruyen) {
            header('Location: /Admin/QuanLyTruyen');
            exit;
        }

        $truyen = $this->truyenModel->getTruyenById($maTruyen);
        $this->render('GiaoDienAdmin/SuaTruyen', ['truyen' => $truyen]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /Admin/QuanLyTruyen');
            exit;
        }

        $maTruyen = $_POST['id'] ?? null;
        if (!$maTruyen) {
            header('Location: /Admin/QuanLyTruyen');
            exit;
        }

        $truyen = $this->truyenModel->getTruyenById($maTruyen);
        $bia = $truyen['Bia']; 

        if (!empty($_FILES['bia']['name'])) {
            $uploadDir = __DIR__ . '/../../public/LightNovel/Bia/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (!empty($bia)) {
                $oldPath = __DIR__ . '/../../' . ltrim($bia, '/');
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $ext = pathinfo($_FILES['bia']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid('bia_', true) . '.' . $ext;

            move_uploaded_file(
                $_FILES['bia']['tmp_name'],
                $uploadDir . $fileName
            );

            $bia = '/public/LightNovel/Bia/' . $fileName;
        }

        $this->truyenModel->updateTruyen(
            $maTruyen,
            $_POST['tenTruyen'],
            $_POST['moTa'],
            $_POST['tacGia'],
            $bia
        );

        header('Location: /Admin/QuanLyTruyen');
        exit;
    }
    public function xoa()
    {
        $maTruyen = $_GET['id'] ?? null;
        if ($maTruyen) {
            $truyen = $this->truyenModel->getTruyenById($maTruyen);

            // Xóa bìa cũ nếu có
            if (!empty($truyen['Bia']) && file_exists(__DIR__ . '/' . $truyen['Bia'])) {
                unlink(__DIR__ . '/' . $truyen['Bia']);
            }

            $this->truyenModel->deleteTruyen($maTruyen);
        }

        header('Location: /Admin/QuanLyTruyen');
        exit;
    }


    public function chiTietChuong()
    {
        $maTruyen = $_GET['id'] ?? null;
        if (!$maTruyen) {
            header('Location: /Admin/QuanLyTruyen');
            exit;
        }

        // Lấy thông tin truyện
        $truyen = $this->truyenModel->getTruyenById($maTruyen);

        // Lấy danh sách chương
        $listChuong = $this->chuongModel->getListChuongByTruyen($maTruyen);

        // Render view
        $this->render('GiaoDienAdmin/ChiTietChuong', [
            'truyen' => $truyen,
            'listChuong' => $listChuong
        ]);
    }
    
}
