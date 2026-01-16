<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;

class DangKyController extends Controller {
    public function DangKyForm() {
        $error = $_SESSION['error'] ?? null;
        $success = $_SESSION['success'] ?? null;

        // Xóa session sau khi lấy
        unset($_SESSION['error'], $_SESSION['success']);

        $this->render('GiaoDienUser/DangKy', [
            'error' => $error,
            'success' => $success
        ]);
    }

    public function DangKy() {  
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /DangKy');
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $firstName = trim($_POST['first_name'] ?? '');
        $lastName = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        if ($password !== $confirmPassword) {
            $_SESSION['error'] = "Mật khẩu và nhập lại mật khẩu không khớp!";
            header('Location: /DangKy');
            exit;
        }

        $userModel = new User();
        if ($userModel->getByEmailOrUsername($email) || $userModel->getByEmailOrUsername($username)) {
            $_SESSION['error'] = "Email hoặc username đã được sử dụng!";
            header('Location: /DangKy');
            exit;
        }
        $password = hash('sha256', $password);
        $result = $userModel->create($username, $firstName, $lastName, $email, $phone, $password);

        if ($result) {
            $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
            header('Location: /DangNhap');
            exit;
        } else {
            $_SESSION['error'] = "Đăng ký thất bại, thử lại sau.";
            header('Location: /DangKy');
            exit;
        }
    }
}
