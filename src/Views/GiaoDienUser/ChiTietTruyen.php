<?php ob_start(); ?>

<style>
:root { 
    --main-blue: #0056b3; 
    --light-bg: #f8f9fa; 
    --card-white: #ffffff; 
    --text-main: #2d3436;
}
body { background-color: var(--light-bg); color: var(--text-main); font-family: 'Inter', sans-serif; }

/* Header Section */
.comic-header { 
    background: white; 
    padding: 40px 0; 
    border-bottom: 1px solid #e9ecef;
    margin-bottom: 30px;
}
.cover-img { 
    width: 100%; 
    border-radius: 8px; 
    box-shadow: 0 10px 20px rgba(0,0,0,0.08); 
    border: 1px solid #dee2e6; 
}

/* Tags & Badges */
.tag-custom { 
    background: #f1f2f6; 
    border: 1px solid #dfe4ea; 
    color: #57606f; 
    font-size: 0.75rem; 
    padding: 4px 15px; 
    border-radius: 20px; 
    transition: 0.3s; 
    text-decoration: none;
}
.tag-custom:hover { border-color: var(--main-blue); color: var(--main-blue); background: #eef2ff; }


.btn-read-now { 
    background: var(--main-blue); 
    color: #fff; 
    padding: 12px 40px; 
    border-radius: 50px; 
    font-weight: bold; 
    border: none; 
    transition: 0.3s;
    box-shadow: 0 4px 15px rgba(0,86,179,0.3);
}
.btn-read-now:hover { background: #004494; transform: translateY(-2px); color: white; }

.chapter-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
.chapter-row { background: var(--card-white); border: 1px solid #edf2f7; transition: 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
.chapter-row:hover { border-color: var(--main-blue); background: #fdfdfd; }
.chapter-row td { padding: 15px; vertical-align: middle; border-top: 1px solid #edf2f7; border-bottom: 1px solid #edf2f7; }
.chapter-row td:first-child { border-left: 1px solid #edf2f7; border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
.chapter-row td:last-child { border-right: 1px solid #edf2f7; border-top-right-radius: 10px; border-bottom-right-radius: 10px; }
.chapter-link { text-decoration: none; color: #2d3436; font-weight: 600; }

.info-box { background: #fbc5311a; border-radius: 10px; padding: 20px; }

/* Star Rating */
.star-rating { display: flex; align-items: center; gap: 5px; font-size: 1.8rem; }
.star-rating .star { transition: 0.2s; }
.star-rating .star.disabled { cursor: not-allowed; }
</style>

<div class="comic-header">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-4">
                <img src="<?= $truyen['Bia'] ?>" class="cover-img" alt="<?= $truyen['TenTruyen'] ?>">
                <div class="text-muted mt-3 small text-center">
                    <i class="bi bi-exclamation-circle"></i> 
                </div>
            </div>

            <div class="col-md-9">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a href="/DanhSachTruyen">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><?= $truyen['TenTruyen'] ?></li>
                    </ol>
                </nav>

                <h1 class="fw-bold mb-2" style="color: #2d3436;"><?= $truyen['TenTruyen'] ?></h1>
                
                <div class="mb-4">
                    <div class="d-flex flex-wrap gap-2">
                        <?php 
                        if(!empty($truyen['LoaiTruyen'])):
                            $tags = explode(',', $truyen['LoaiTruyen']);
                            foreach($tags as $tag): ?>
                                <a href="#" class="tag-custom">#<?= trim($tag) ?></a>
                            <?php endforeach; 
                        endif; ?>
                    </div>
                </div>

                <div class="row mb-4 g-3">
                    <div class="col-6 col-md-3">
                        <div class="p-2 border-start border-3 border-primary">
                            <small class="text-muted d-block">Tác giả</small>
                            <span class="fw-bold"><?= $truyen['TacGia'] ?></span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold text-uppercase color-primary">Tóm tắt nội dung</h6>
                    <p class="text-muted" style="font-size: 0.95rem; line-height: 1.7;">
                        <?= nl2br($truyen['MoTa'] ?? 'Đang cập nhật nội dung...') ?>
                    </p>
                </div>

                <!-- Star Rating Form -->
                <div class="mb-4">
                    <h6 class="fw-bold text-uppercase color-primary">Đánh giá truyện</h6>
                    <form method="POST" action="/Truyen/XuLyDanhGia">
                        <div class="star-rating d-flex align-items-center">
                            <?php
                            $maxSao = 5;
                            for ($i = 1; $i <= $maxSao; $i++):
                                // Kiểm tra có nên highlight sao
                                $highlight = ($userRated && ($currentUserRating ?? 0) >= $i) || (!$userRated && round($trungBinhSao) >= $i);
                            ?>
                                <button type="submit" name="sao" value="<?= $i ?>" 
                                        class="star btn p-0 <?= $userRated ? 'disabled' : '' ?>"
                                        style="background:none; border:none; color: <?= $highlight ? '#FFD700' : '#ccc' ?>; 
                                            font-size:1.8rem; cursor:<?= $userRated ? 'not-allowed' : 'pointer' ?>;">
                                    &#9733;
                                </button>
                            <?php endfor; ?>
                            <span class="ms-3 small text-muted" id="avgRating">
                                <?= number_format($trungBinhSao, 1) ?> / 5 (<?= $soNguoiDanhGia ?> đánh giá)
                            </span>
                        </div>
                        <input type="hidden" name="maTruyen" value="<?= $truyen['MaTruyen'] ?>">
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Chapters -->
<div class="container mt-4 pb-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="bg-white p-4 rounded-3 shadow-sm">
                <h4 class="fw-bold mb-4 d-flex align-items-center">
                    <i class="bi bi-list-ul me-2 text-primary"></i> DANH SÁCH CHƯƠNG
                </h4>

                <div class="table-responsive">
                    <table class="chapter-table">
                        <tbody>
                            <?php if(!empty($listChuong)): ?>
                                <?php foreach($listChuong as $chuong): ?>
                                <tr class="chapter-row" onclick="window.location='/DanhSachTruyen/ChiTietTruyen/ChuongChiTiet?id=<?= $chuong['MaChuong'] ?>'" style="cursor:pointer;">
                                    <td>
                                        Chương <?= $chuong['SoChuong'] ?>
                                    </td>
                                    <td class="text-muted small text-end">
                                        <i class="bi bi-clock me-1"></i> <?= $chuong['TenChuong'] ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td class="text-center text-muted py-5">Nội dung đang được cập nhật...</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
                                
        
    </div>
</div>

<?php 
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/layout.php'); 
?>
