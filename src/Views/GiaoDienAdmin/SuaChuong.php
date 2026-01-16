<?php ob_start(); ?>

<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Hiệu chỉnh: Chương <?= htmlspecialchars($chuong['SoChuong']) ?></h4>
        </div>
        <div class="card-body p-4">
            <form action="/Admin/QuanLyTruyen/ChiTietChuong/Sua?matruyen=<?= $matruyen ?>&id=<?= $chuong['MaChuong'] ?>" method="POST">
                
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <label class="form-label fw-bold">Số chương</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-hash"></i></span>
                            <input type="number" name="soChuong" class="form-control" value="<?= $chuong['SoChuong'] ?>" required>
                        </div>
                    </div>

                    <div class="col-md-9 mb-4">
                        <label class="form-label fw-bold">Tên chương</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-journal-text"></i></span>
                            <input type="text" name="tenChuong" class="form-control" value="<?= htmlspecialchars($chuong['TenChuong']) ?>" required>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Nội dung chương</label>
                    <textarea name="noiDung" id="editor" class="form-control"><?= $chuong['NoiDung'] ?></textarea>
                    <div class="form-text mt-2 d-flex justify-content-between align-items-center">
                        <small class="text-muted">Mẹo: Sử dụng các định dạng để làm nổi bật tâm trạng nhân vật.</small>
                        <span id="word-count" class="badge bg-secondary p-2">Số từ: 0</span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-4">
                    <a href="/Admin/QuanLyTruyen/ChiTietChuong?id=<?= $matruyen ?>" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                    <div class="gap-2">
                        <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                            <i class="bi bi-check-lg"></i> Lưu thay đổi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'bold', 'italic', 'underline', 'strikethrough', 
                    '|', 'bulletedList', 'numberedList', 
                    '|', 'undo', 'redo'
                ]
            },
            placeholder: 'Nội dung truyện không được để trống...'
        })
        .then(editor => {

            const updateWordCount = () => {
                const text = editor.getData().replace(/<[^>]*>/g, '').trim();
                const words = text ? text.split(/\s+/).length : 0;
                document.getElementById('word-count').innerText = `Số từ: ${words}`;
            };


            updateWordCount();


            editor.model.document.on('change:data', updateWordCount);
        })
        .catch(error => {
            console.error(error);
        });
</script>

<style>
    .ck-editor__editable_inline {
        min-height: 450px; 
        font-family: 'Palatino Linotype', 'Book Antiqua', Palatino, serif; 
        font-size: 1.15rem;
        line-height: 1.8;
        padding: 1rem 2rem !important;
    }
    .card { border-radius: 15px; overflow: hidden; }
    .input-group-text { border: none; }
    .form-control:focus { box-shadow: none; border-color: #0d6efd; }
</style>

<?php 
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/adminLayout.php'); 
?>