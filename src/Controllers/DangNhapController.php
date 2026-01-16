<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;

class DangNhapController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        session_start();
    }

    public function loginForm()
    {
        $message = $_SESSION['login_error'] ?? null;
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['login_error']); 
        unset($_SESSION['success']); 
        $this->render('GiaoDienUser/DangNhap', [
            'message' => $message,
            'success' => $success
        ]);
    }

    public function login()
    {
        $emailOrUsername = $_POST['emailOrUsername'] ?? '';
        $password = $_POST['password'] ?? '';


        if (empty($emailOrUsername) || empty($password)) {
            $_SESSION['login_error'] = "Vui lòng nhập đầy đủ thông tin!";
            header("Location: /DangNhap");
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['login_error'] = "Mật khẩu phải có ít nhất 6 ký tự!";
            header("Location: /DangNhap");
            exit;
        }


        $userModel = new User();
        $user = $userModel->getByEmailOrUsername($emailOrUsername);

        if (!$user) {
            $_SESSION['login_error'] = "Tài khoản không tồn tại!";
            header("Location: /DangNhap");
            exit;
        }

        unset($_SESSION['user']['password']);
        $passwordHash = hash('sha256', $password);


        if ($passwordHash !== $user['password']) {
            $_SESSION['login_error'] = "Mật khẩu không đúng!";
            header("Location: /DangNhap");
            exit;
        }


        unset($user['password']);
        $_SESSION['user'] = $user;

        header("Location: /TrangChu");
        exit;
    }

    /**
     * Logout
     */
    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /DangNhap");
        exit;
    }
}
