<?php ob_start(); ?>

<div class="container mt-5">
    <h1>Thêm Truyện Mới</h1>
    <form action="/Admin/QuanLyTruyen/Them" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Tên truyện</label>
            <input type="text" name="tenTruyen" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tác giả</label>
            <input type="text" name="tacGia" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="moTa" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label>Bìa</label>
            <input type="file" name="bia" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Thêm Truyện</button>
        <a href="/Admin/QuanLyTruyen" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/adminLayout.php');
?>