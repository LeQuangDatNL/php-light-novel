<?php ob_start(); ?>

<div class="container mt-5">
    <h1>Danh sách Chương: <?= $truyen['TenTruyen'] ?></h1>
    <a href="/Admin/QuanLyTruyen/ChiTietChuong/FormThem?id=<?= $truyen['MaTruyen'] ?>" class="btn btn-success mb-3">Thêm Chương</a>
    <a href="/Admin/QuanLyTruyen" class="btn btn-secondary mb-3">Quay lại</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Số chương</th>
                <th>Tên chương</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($listChuong)): ?>
                <?php foreach($listChuong as $chuong): ?>
                <tr>
                    <td><?= $chuong['SoChuong'] ?></td>
                    <td><?= $chuong['TenChuong'] ?></td>
                    <td>
                        <a href="/Admin/QuanLyTruyen/ChiTietChuong/FormSua?id=<?= $chuong['MaChuong'] ?>&matruyen=<?= $chuong['MaTruyen'] ?>" class="btn btn-sm btn-primary">Sửa</a>
                        <a href="/Admin/QuanLyTruyen/ChiTietChuong/Xoa?id=<?= $chuong['MaChuong'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa chương này?')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" class="text-center text-muted">Chưa có chương nào</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/adminLayout.php');
?>
