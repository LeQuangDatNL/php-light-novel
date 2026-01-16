<?php ob_start(); ?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Soạn thảo chương mới:</h4>
        </div>
        <div class="card-body">
            <form action="/Admin/QuanLyTruyen/ChiTietChuong/Them?id=<?= $maTruyen ?>" method="POST">
                <input type="hidden" name="maTruyen" value="<?= $maTruyen ?>">
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Số chương</label>
                        <input type="number" name="soChuong" class="form-control" placeholder="Ví dụ: 1" required>
                    </div>
                    <div class="col-md-9 mb-3">
                        <label class="form-label fw-bold">Tên chương</label>
                        <input type="text" name="tenChuong" class="form-control" placeholder="Tên chương (không bắt buộc phải có số chương)" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nội dung chương</label>
                    <div id="toolbar-container"></div>
                    <textarea name="noiDung" id="editor" class="form-control" rows="15"></textarea>
                    <div class="form-text mt-2 d-flex justify-content-between">
                        <span>Gợi ý: Nhấn Ctrl + S để lưu bản nháp.</span>
                        <span id="word-count">Số từ: 0</span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <a href="/Admin/QuanLyTruyen/ChiTietChuong?id=<?= $maTruyen ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại danh sách
                    </a>
                    <button type="submit" class="btn btn-success btn-lg px-5">
                        <i class="bi bi-save"></i> Đăng chương này
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            placeholder: 'Bắt đầu câu chuyện của bạn tại đây...',
            toolbar: ['bold', 'italic', 'underline', 'strikethrough', '|', 'undo', 'redo', '|', 'bulletedList', 'numberedList']
        })
        .then(editor => {
            // Tính năng đếm chữ đơn giản
            editor.model.document.on('change:data', () => {
                const text = editor.getData().replace(/<[^>]*>/g, '');
                const wordCount = text.trim().split(/\s+/).length;
                document.getElementById('word-count').innerText = `Số từ: ${text.length > 0 ? wordCount : 0}`;
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>

<style>

    .ck-editor__editable_inline {
        min-height: 400px;
        font-family: 'Times New Roman', serif; 
        font-size: 1.1rem;
        line-height: 1.6;
    }
    .card { border-radius: 12px; }
</style>

<?php 
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/adminLayout.php'); 
?>