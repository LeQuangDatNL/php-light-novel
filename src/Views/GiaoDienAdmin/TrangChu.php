<?php
ob_start();


date_default_timezone_set('Asia/Ho_Chi_Minh');
$currentDate = date('d/m/Y');
$currentTime = date('H:i');


$adminName = $_SESSION['user']['firstName'] ?? 'Quản trị viên';
?>

<div class="container-fluid px-4">
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-white p-5 text-center rounded-4">
                <div class="mb-4">
                    <i class="bi bi-person-badge text-primary" style="font-size: 4rem;"></i>
                </div>
                
                <h1 class="display-5 fw-bold text-dark">Xin chào, <?= htmlspecialchars($adminName) ?>!</h1>
                <p class="lead text-muted">Chào mừng bạn trở lại với hệ thống quản lý nội dung Light Novel.</p>
                
                <hr class="my-4 mx-5 opacity-25">

                <div class="d-flex justify-content-center gap-4">
                    <div class="text-center">
                        <span class="d-block text-uppercase small fw-bold text-secondary">Hôm nay là ngày</span>
                        <div class="h4 mb-0 text-primary"><i class="bi bi-calendar3 me-2"></i><?= $currentDate ?></div>
                    </div>
                    <div class="vr"></div>
                    <div class="text-center">
                        <span class="d-block text-uppercase small fw-bold text-secondary">Giờ hệ thống</span>
                        <div class="h4 mb-0 text-primary"><i class="bi bi-clock me-2"></i><?= $currentTime ?></div>
                    </div>
                    <a href="/TrangChu" class="btn btn-primary btn-lg rounded-pill shadow-sm text-white">
                        <i class="bi bi-house-door-fill me-2"></i> Xem giao diện người dùng
                    </a>
                </div>

                <div class="mt-5">
                    <p class="small text-secondary italic">Sử dụng thanh công cụ bên trái (Sidebar) để bắt đầu quản lý dữ liệu.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
include (__DIR__ . '/../../../templates/Adminlayout.php'); 
?>