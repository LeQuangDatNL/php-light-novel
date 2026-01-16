<?php 
ob_start();
?>
<h2 class="mb-4">Xếp hạng truyện theo đánh giá sao</h2>
<div class="row g-2">
<?php foreach ($listTruyen as $truyen): ?>
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="row g-0 align-items-center">

                <!-- ẢNH -->
                <div class="col-auto">
                    <img src="<?= $truyen['Bia'] ?>"
                         alt="<?= $truyen['TenTruyen'] ?>"
                         style="width: 80px; height: 110px; object-fit: cover;"
                         class="rounded-start">
                </div>

                <!-- NỘI DUNG -->
                <div class="col">
                    <div class="card-body py-2 px-3">
                        <h6 class="card-title mb-1 text-truncate">
                            <?= $truyen['TenTruyen'] ?>
                        </h6>

                        <!-- SAO -->
                        <div class="text-warning small">
                            <?php
                                $sao = round($truyen['TrungBinhSao'], 1);
                                for ($i = 1; $i <= 5; $i++) {
                                    echo $i <= floor($sao) ? '★' : '☆';
                                }
                            ?>
                            <span class="text-muted ms-1">
                                (<?= $sao ?>)
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php 
$content = ob_get_clean(); 
include (__DIR__ . '/../../../templates/layout.php'); 
?>
