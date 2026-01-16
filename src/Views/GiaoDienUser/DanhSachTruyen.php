<?php 
ob_start(); 
$searchKeyword = $_GET['search'] ?? ''; 
$categoryID = $_GET['category'] ?? '';
?>


<style>
    body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
    
    /* Form tìm kiếm */
    .search-section {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .comic-card {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: none;
        display: flex; 
        height: 220px; 
    }

    .comic-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .comic-img-wrapper {
        width: 40%;
        height: 100%;
        background-color: #dee2e6;
        flex-shrink: 0;
    }

    .comic-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .comic-info {
        width: 60%;
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .comic-title {
        font-size: 1rem;
        font-weight: 700;
        color: #212529;
        text-transform: uppercase;
        display: -webkit-box;
        -webkit-line-clamp: 1; /* Cắt ngắn để nhường chỗ cho thể loại */
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.2;
    }

    .comic-categories {
        font-size: 0.75rem;
        color: #0d6efd;
        font-weight: 600;
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .comic-author {
        color: #fd7e14;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .comic-desc {
        font-size: 0.8rem;
        color: #6c757d;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Giảm xuống 2 dòng để giao diện thoáng hơn */
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-top: 5px;
    }

    .btn-read {
        font-size: 0.8rem;
        padding: 5px 0;
    }
</style>
<div class="container py-5">
    <div class="search-section">
        <form action="" method="GET" class="row g-3">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control rounded-pill" placeholder="Nhập tên truyện cần tìm..." value="<?= htmlspecialchars($searchKeyword) ?>">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select rounded-pill">
                    <option value="">Tất cả thể loại</option>
                    <?php if (!empty($listLoai)): ?>
                        <?php foreach ($listLoai as $loai): ?>
                            <option value="<?= $loai['MaLoai'] ?>" <?= $categoryID == $loai['MaLoai'] ? 'selected' : '' ?>>
                                <?= $loai['TenLoai'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-dark w-100 rounded-pill">Tìm kiếm</button>
            </div>
        </form>
    </div>
    
    <div class="row g-4">
        <?php if (!empty($listTruyen)): ?>
            <?php foreach ($listTruyen as $truyen): ?>
                <div class="col-12 col-lg-4 col-md-6"> 
                    <div class="comic-card shadow-sm">
                        
                        <div class="comic-img-wrapper">
                            <?php 
                                $img = !empty($truyen['Bia']) ? $truyen['Bia'] : '';
                            ?>
                            <img src="<?= $img ?>" class="comic-img" alt="Bia">
                        </div>

                        <div class="comic-info">
                            <div>
                                <div class="comic-title" title="<?= $truyen['TenTruyen'] ?>">
                                    <?= $truyen['TenTruyen'] ?>
                                </div>

                                <div class="comic-categories" title="<?= $truyen['LoaiTruyen'] ?>">
                                    <i class="bi bi-tags-fill"></i> <?= !empty($truyen['LoaiTruyen']) ? $truyen['LoaiTruyen'] : 'Chưa có thể loại' ?>
                                </div>
                                
                                
                                
                                <div class="comic-author">
                                    <small><i class="bi bi-pencil-square"></i> <?= $truyen['TacGia'] ?></small>
                                </div>

                                <div class="comic-desc">
                                    <?= $truyen['MoTa'] ?>
                                </div>
                            </div>
                            
                            <div class="mt-2">
                                <a href="/DanhSachTruyen/ChiTietTruyen?id=<?= $truyen['MaTruyen'] ?>" class="btn btn-outline-dark btn-read w-100 rounded-pill">Đọc ngay</a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5 text-muted">
                <h5>Không tìm thấy truyện nào khớp với yêu cầu của bạn.</h5>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include(__DIR__ . '/../../../templates/layout.php'); 
?>