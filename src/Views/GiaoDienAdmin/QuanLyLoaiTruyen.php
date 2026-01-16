<?php ob_start(); ?>
<div class="container mt-4">
    <h2 class="mb-4">Quản lý loại truyện</h2>


    <form method="get" action="/Admin/QuanLyTruyen/ChiTietLoai/Them" class="mb-4">
        <input type="hidden" name="maTruyen" value="<?= $maTruyen ?>">
        <div class="card bg-light border-0 shadow-sm">
            <div class="card-body p-3">
                <label class="form-label fw-bold mb-2">Thêm thể loại mới cho truyện</label>
                <div class="d-flex gap-2">
                    <select name="maLoai" class="form-select rounded-pill shadow-sm" required>
                        <option value="" selected disabled>-- Chọn thể loại --</option>
                        <?php foreach ($listLoai as $loai): ?>
                            <option value="<?= $loai['MaLoai'] ?>">
                                <?= htmlspecialchars($loai['TenLoai']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm d-flex align-items-center">
                        <i class="bi bi-plus-circle-fill me-2"></i> Thêm
                    </button>
                </div>
                <div class="form-text mt-2 ms-2 text-muted">
                    Dữ liệu sẽ được thêm vào truyện có mã số: <strong><?= $maTruyen ?></strong>
                </div>
            </div>
        </div>
    </form>

    <a href="/Admin/QuanLyTruyen" class="btn btn-secondary mb-3">Quay lại</a>                        
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tên loại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($loai_truyen)): ?>
                <?php foreach ($loai_truyen as $loai): ?>
                    <tr>
                        <td><?= $loai['MaLoai'] ?></td>
                        <td><?= htmlspecialchars($loai['TenLoai']) ?></td>
                        <td>
                            <a href="/Admin/QuanLyTruyen/ChiTietLoai/Xoa?id=<?= $loai['MaLoai'] ?>&MaTruyen=<?= $maTruyen ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Bạn có chắc muốn xóa loại này?');">
                               Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Chưa có loại truyện nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
include(__DIR__ . '/../../../templates/adminLayout.php');
?>
