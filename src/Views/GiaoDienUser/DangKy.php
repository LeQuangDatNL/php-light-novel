<?php
ob_start();
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4 rounded-4" style="width:100%; max-width:400px; background:#fff8dc; color:#333;">
        <div class="text-center mb-4">
            <i class="fas fa-film fa-3x text-warning"></i>
            <h3 class="mt-2">Đăng ký MovieApp</h3>
            <p class="text-muted">Tạo tài khoản mới để bắt đầu</p>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
        </div>
        <form action="/XyLyDangKy" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="username" class="form-control  border-secondary" id="username" name="username" placeholder="dat123" required>
            </div>
            <div class="row">
                
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">Họ</label>
                    <input type="text" class="form-control border-secondary" id="first_name" name="first_name" placeholder="Nguyen" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Tên</label>
                    <input type="text" class="form-control border-secondary" id="last_name" name="last_name" placeholder="An" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control  border-secondary" id="email" name="email" placeholder="name@example.com" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control  border-secondary" id="password" name="password" placeholder="Mật khẩu" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Nhập lại mật khẩu</label>
                <input type="password" class="form-control border-secondary" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
            </div>
            <button type="submit" class="btn w-100" style="background:#ffd700; color:#121212; font-weight:bold;">Đăng ký</button>
        </form>
        <div class="mt-3 text-center">
            Đã có tài khoản? <a href="/DangNhap" style="color: #ffd700; text-decoration: none;">Đăng nhập</a>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/layout.php'); 
?>