<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { overflow-x: hidden; }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        .nav-link { color: rgba(255,255,255,.8); padding: 12px 20px; }
        .nav-link:hover { background: rgba(255,255,255,.1); color: #fff; }
        .nav-link.active { background: #0d6efd; color: #fff; }
        #content-wrapper { width: 100%; background: #f8f9fa; }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav id="sidebar" class="bg-dark shadow">
            <div class="p-4 text-white">
                <h4>Admin</h4>
                <hr>
            </div>
            <ul class="nav flex-column border-0">
                <li class="nav-item">
                    <a href="/Admin/QuanLyLoai" class="nav-link">
                        <i class="bi bi-tag me-2"></i> Quản Lý Loại
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Admin/QuanLyTruyen" class="nav-link">
                        <i class="bi bi-book me-2"></i> Quản Lý Truyện
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Admin/QuanLyTaiKhoan" class="nav-link">
                        <i class="bi bi-people me-2"></i> Quản Lý Tài Khoản
                    </a>
                </li>
                <hr class="text-secondary">
                <li class="nav-item">
                    <a href="/Admin/TrangChu" class="nav-link text-warning">
                        <i class="bi bi-house-door me-2"></i> Xem Trang Chủ
                    </a>
                </li>
            </ul>
        </nav>

        <div id="content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3">
                <div class="container-fluid">
                    <span class="navbar-brand">Hệ thống Quản trị</span>
                    <div class="ms-auto">
                        <span class="me-3">Xin chào, <strong>Admin</strong></span>

                        <a href="/DangXuat" class="btn btn-sm btn-outline-danger">Đăng xuất</a>
                    </div>
                </div>
            </nav>

            <main class="p-4">
                <?= $content ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>