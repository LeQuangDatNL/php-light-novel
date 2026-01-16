<?php

namespace App\Controllers;
use App\Controller;
use App\Models\Truyen;
use App\Models\Loai;
use App\Models\Chuong;
use App\Models\DanhGia;
class TruyenController extends Controller
{
    private $truyenModel;
    private $loaiModel;
    private $chuongModel;
    public function __construct()
    {
        
        $this->truyenModel = new Truyen();
        $this->loaiModel = new Loai();
        $this->chuongModel = new Chuong();
        $this->danhGiaModel = new DanhGia();
    }

    public function index() {
        $searchKeyword = $_GET['search'] ?? '';
        $categoryID = $_GET['category'] ?? '';
        $listLoai = $this->loaiModel->getAllLoai();
        
        $listTruyen = $this->truyenModel->searchTruyen($searchKeyword, $categoryID);
        
        
        $this->render('GiaoDienUser/DanhSachTruyen', [
            'listTruyen' => $listTruyen,
            'listLoai'      => $listLoai,
            'searchKeyword' => $searchKeyword,
            'categoryID' => $categoryID
        ]);
    }
    public function randomTruyen() {
        $randomTruyen = $this->truyenModel->getRandomTruyen();
        $id = $randomTruyen['MaTruyen'];
        $listChuong = $this->chuongModel->getListChuongByTruyen($id);


        $trungBinhSaoData = $this->danhGiaModel->getTrungBinhSao($id);

        $trungBinhSao = $trungBinhSaoData['trungBinh'] ?? 0.0;
        $soNguoiDanhGia = $trungBinhSaoData['soNguoi'] ?? 0;


        $userRated = false;
        $currentUserRating = null;
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $userRated = $this->danhGiaModel->hasUserRated($maTruyen, $username);
            if ($userRated) {
                $currentUserRating = $this->danhGiaModel->getDanhGiaByUser($maTruyen, $username);
            }
        }

        $this->render('GiaoDienUser/ChiTietTruyen', [
            'truyen' => $randomTruyen,
            'listChuong' => $listChuong,
            'trungBinhSao' => $trungBinhSao,
            'soNguoiDanhGia' => $soNguoiDanhGia,
            'userRated' => $userRated,
            'currentUserRating' => $currentUserRating
        ]);
    }
    public function show() {
        $maTruyen = $_GET['id'] ?? null;

        if (!$maTruyen) {
            header('Location: /DanhSachTruyen');
            exit;
        }


        $truyenDetail = $this->truyenModel->getTruyenById($maTruyen);


        $listChuong = $this->chuongModel->getListChuongByTruyen($maTruyen);


        $trungBinhSaoData = $this->danhGiaModel->getTrungBinhSao($maTruyen);

        $trungBinhSao = $trungBinhSaoData['trungBinh'] ?? 0.0;
        $soNguoiDanhGia = $trungBinhSaoData['soNguoi'] ?? 0;


        $userRated = false;
        $currentUserRating = null;
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user']['username'];
            $userRated = $this->danhGiaModel->hasUserRated($maTruyen, $username);
            if ($userRated) {
                $currentUserRating = $this->danhGiaModel->getDanhGiaByUser($maTruyen, $username);
            }
        }

        $this->render('GiaoDienUser/ChiTietTruyen', [
            'truyen' => $truyenDetail,
            'listChuong' => $listChuong,
            'trungBinhSao' => $trungBinhSao,
            'soNguoiDanhGia' => $soNguoiDanhGia,
            'userRated' => $userRated,
            'currentUserRating' => $currentUserRating
        ]);
    }
    public function submitRating()
    {
        session_start();


        if (!isset($_SESSION['user'])) {

            header('Location: /DangNhap');
            exit;
        }


        $maTruyen = $_POST['maTruyen'] ?? null;
        $sao = $_POST['sao'] ?? null;
        $username = $_SESSION['user']['username'];

        if (!$maTruyen || !$sao) {
            $_SESSION['error'] = "Dữ liệu không hợp lệ!";
            header("Location: /DanhSachTruyen/ChiTietTruyen?id=$maTruyen");
            exit;
        }


        $existingRating = $this->danhGiaModel->getDanhGiaByUser($maTruyen, $username);

        if ($existingRating) {

            $this->danhGiaModel->updateDanhGia($maTruyen, $username, $sao);
        } else {
            $this->danhGiaModel->insertDanhGia([
                'MaTruyen' => $maTruyen,
                'Username' => $username,
                'Sao' => $sao
            ]);
        }

        header("Location: /DanhSachTruyen/ChiTietTruyen?id=$maTruyen");
        exit;
    }
    public function xepHang() {
        $listTruyen = $this->truyenModel->SortTheoSao();
        $this->render('GiaoDienUser/XepHang', [
            'listTruyen' => $listTruyen
        ]);
    }

}