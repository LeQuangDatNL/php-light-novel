<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>MovieApp - Anime Style</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top" style="background-color:#2b2b3d;">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand text-warning d-flex align-items-center" href="/TrangChu">
      <i class="fa-solid fa-book-open me-2"></i> Live NovelApp
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Menu chính -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link fw-bold text-light" href="/TrangChu">Trang chủ</a></li>
        <li class="nav-item"><a class="nav-link fw-bold text-light" href="/DanhSachTruyen">Danh sách truyện</a></li>
        <li class="nav-item"><a class="nav-link fw-bold text-light" href="/DanhSachTruyen/RandomTruyen">Random</a></li>
        <li class="nav-item"><a class="nav-link fw-bold text-light" href="/XepHang">Xếp hạng</a></li>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
          <li class="nav-item">
              <a class="nav-link fw-bold text-warning" href="/Admin/TrangChu">Quay về Admin</a>
          </li>
        <?php endif; ?>
      </ul>


      <!-- User / Đăng nhập -->
      <div class="d-flex align-items-center">
        <?php if(isset($_SESSION['user'])): ?>
          <!-- Đã đăng nhập -->
          <i class="fa-solid fa-check text-success me-2" title="Đã đăng nhập"></i>

          <div class="dropdown">
            <a class="dropdown-toggle text-light text-decoration-none fw-bold" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <?= htmlspecialchars($_SESSION['user']['username']); ?>
              <i class="fa-solid fa-user-circle ms-1"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="/profile">Thông tin cá nhân</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/DangXuat">Đăng xuất</a></li>
            </ul>
          </div>

        <?php else: ?>
          <!-- Chưa đăng nhập -->
          <a href="/DangNhap" class="btn btn-outline-warning me-2">
            <i class="fa-solid fa-user-circle me-1"></i> Đăng nhập
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-4">