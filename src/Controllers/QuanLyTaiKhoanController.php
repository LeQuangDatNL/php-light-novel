<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;

class QuanLyTaiKhoanController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }
    public function index()
    {
        $user_list = $this->userModel->getAll();
        $this->render('GiaoDienAdmin/QuanLyTaiKhoan', ['user_list' => $user_list]);
    }
    public function capQuyen()
    {
        $username = $_GET['username'] ?? null;
        $action = $_GET['action'] ?? null;

        if ($username && $action) {
            if ($action === 'promote') {
                $this->userModel->updateRole($username, 'admin');
            } elseif ($action === 'demote') {
                $this->userModel->updateRole($username, 'user');
            }
        }

        header('Location: /Admin/QuanLyTaiKhoan');
        exit;
    }   
}