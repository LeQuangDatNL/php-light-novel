<?php ob_start(); ?>

<div class="container mt-5">
    <h1>Sửa Truyện</h1>
    <form action="/Admin/QuanLyTruyen/Update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $truyen['MaTruyen'] ?>">
        <input type="hidden" name="currentBia" value="<?= $truyen['Bia'] ?>">

        <div class="mb-3">
            <label>Tên truyện</label>
            <input type="text" name="tenTruyen" class="form-control" value="<?= htmlspecialchars($truyen['TenTruyen']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Tác giả</label>
            <input type="text" name="tacGia" class="form-control" value="<?= htmlspecialchars($truyen['TacGia']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="moTa" class="form-control" rows="4"><?= htmlspecialchars($truyen['MoTa']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Bìa hiện tại</label><br>
            <?php if(!empty($truyen['Bia'])): ?>
                <img src="<?= $truyen['Bia'] ?>" width="100" class="mb-2"><br>
            <?php endif; ?>
            <label>Thay bìa mới (nếu muốn)</label>
            <input type="file" name="bia" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="/Admin/QuanLyTruyen" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/adminLayout.php');
?>
