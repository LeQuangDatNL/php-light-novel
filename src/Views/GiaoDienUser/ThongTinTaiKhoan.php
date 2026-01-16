
<?php 
ob_start();
$user = $_SESSION['user'];
?>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header fw-bold">
            Thông tin tài khoản
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 fw-semibold">Tên đăng nhập:</div>
                <div class="col-md-8"><?= htmlspecialchars($user['username']) ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-semibold">Họ:</div>
                <div class="col-md-8"><?= htmlspecialchars($user['firstName']) ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-semibold">Tên:</div>
                <div class="col-md-8"><?= htmlspecialchars($user['lastName']) ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-semibold">Email:</div>
                <div class="col-md-8"><?= htmlspecialchars($user['email']) ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-semibold">Số điện thoại:</div>
                <div class="col-md-8"><?= htmlspecialchars($user['phone']) ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-semibold">Vai trò:</div>
                <div class="col-md-8">
                    <span class="badge bg-primary">
                        <?= htmlspecialchars($user['role']) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
$content = ob_get_clean(); 
include (__DIR__ . '/../../../templates/layout.php'); 
?>
