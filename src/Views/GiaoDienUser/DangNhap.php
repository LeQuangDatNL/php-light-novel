<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card shadow p-4 rounded-4" style="width:100%; max-width:400px; background:#fff8dc; color:#333;">
        <div class="text-center mb-4">
            <i class="fas fa-book fa-3x" style="color:#ff6f61;"></i>
            <h3 class="mt-2">Đăng nhập TruyenApp</h3>
            <p class="text-muted">Nhập thông tin để tiếp tục</p>
        </div>
        
        <?php if (!empty($message)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/XyLyDangNhap">
            <div class="mb-3">
                <label class="form-label">Email hoặc Username</label>
                <input type="text"
                       class="form-control border-secondary"
                       name="emailOrUsername"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password"
                       class="form-control border-secondary"
                       name="password"
                       required>
            </div>

            <button type="submit"
                    class="btn w-100"
                    style="background:#ff6f61; color:#fff; font-weight:bold;">
                Đăng nhập
            </button>
        </form>

        <div class="mt-3 text-center">
            Chưa có tài khoản?
            <a href="/DangKy" style="color:#1e90ff; text-decoration:none;">
                Đăng ký ngay
            </a>
        </div>
    </div>
</div>

<?php if (!empty($success)): ?>
<script>
    alert("<?= addslashes($success) ?>"); // Hoặc dùng SweetAlert2 cho đẹp
</script>
<?php endif; ?>
<?php
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/layout.php');
?>
