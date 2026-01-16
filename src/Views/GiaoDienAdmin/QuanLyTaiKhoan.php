<?php
ob_start();
?>

<div class="container-fluid my-5 px-4">
    <div class="mb-4">
        <h2><i class="bi bi-people"></i> Quản Lý Tài Khoản Người Dùng</h2>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Username</th>
                            <th>Họ Tên</th>
                            <th>Email</th>
                            <th>Số Điện Thoại</th>
                            <th>Quyền</th>
                            <th class="text-center">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($user_list)): ?>
                            <?php foreach ($user_list as $user): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($user['username']) ?></strong></td>
                                <td><?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['phone']) ?></td>
                                <td><span class="badge bg-secondary"><?= $user['role'] ?></span></td>
                                <td class="text-center">
                                <?php if ($user['username'] === $_SESSION['user']['username']): ?>
                                    <span class="badge bg-secondary">Bạn</span>

                                <?php elseif ($user['role'] === 'admin'): ?>
                                    <a href="/Admin/QuanLyTaiKhoan/CapQuyen?username=<?= $user['username'] ?>&action=demote"
                                    class="btn btn-sm btn-danger">
                                        Hạ quyền
                                    </a>

                                <?php else: ?>
                                    <a href="/Admin/QuanLyTaiKhoan/CapQuyen?username=<?= $user['username'] ?>&action=promote"
                                    class="btn btn-sm btn-success">
                                        Cấp quyền
                                    </a>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Không có tài khoản nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/adminlayout.php');
?>