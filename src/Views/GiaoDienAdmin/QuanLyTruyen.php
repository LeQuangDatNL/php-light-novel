<?php
ob_start();
?>

<div class="container mt-5">
    <h1 class="mb-4">Quản lý Truyện</h1>
    <a href="/Admin/QuanLyTruyen/Them" class="btn btn-success mb-3">Thêm Truyện Mới</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên truyện</th>
                <th>Tác giả</th>
                <th>Mô tả</th>
                <th>Bìa</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($truyen_list as $t): ?>
            <tr>
                <td><?= $t['MaTruyen'] ?></td>
                <td><?= $t['TenTruyen'] ?></td>
                <td><?= $t['TacGia'] ?></td>
                <td><?= substr($t['MoTa'], 0, 50) ?>...</td>
                <td>
                    <?php if(!empty($t['Bia'])): ?>
                        <img src="<?= $t['Bia'] ?>" width="60" alt="<?= $t['TenTruyen'] ?>">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/Admin/QuanLyTruyen/ChiTietLoai?id=<?= $t['MaTruyen'] ?>" class="btn btn-sm btn-success">Chi Tiết Loại</a>
                    <a href="/Admin/QuanLyTruyen/ChiTietChuong?id=<?= $t['MaTruyen'] ?>" class="btn btn-sm btn-success">Chi Tiết Chương</a>
                    <a href="/Admin/QuanLyTruyen/Sua?id=<?= $t['MaTruyen'] ?>" class="btn btn-sm btn-primary">Sửa</a>
                    <a href="/Admin/QuanLyTruyen/Xoa?id=<?= $t['MaTruyen'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/adminLayout.php');
?>
