<?php
ob_start();
?>

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h5 class="mb-0">Danh Mục Thể Loại</h5>
            <!-- Thêm mới inline -->
            <form action="/Admin/QuanLyLoai/Them" method="post" class="d-flex" style="gap:5px;">
                <input type="text" name="TenLoai" placeholder="Thêm thể loại mới" class="form-control form-control-sm" required>
                <button type="submit" class="btn btn-light btn-sm">+ Thêm</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Mã Loại</th>
                        <th>Tên Thể Loại</th>
                        <th class="text-end">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($loai_list as $l): ?>
                    <tr>
                        <td><?= $l['MaLoai'] ?></td>
                        <td>
                            <!-- Form sửa inline -->
                            <form action="/Admin/QuanLyLoai/CapNhat?id=<?= $l['MaLoai'] ?>" method="post" class="d-flex" style="gap:5px;">
                                <input type="text" name="TenLoai" value="<?= htmlspecialchars($l['TenLoai']) ?>" class="form-control form-control-sm" required>
                                <button type="submit" class="btn btn-sm btn-outline-success">💾</button>
                            </form>
                        </td>
                        <td class="text-end">
                            <!-- Xóa -->
                            <form action="/Admin/QuanLyLoai/Xoa?id=<?= $l['MaLoai'] ?>" method="post" class="d-inline">
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/adminLayout.php');
?>