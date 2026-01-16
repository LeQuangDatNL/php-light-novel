<?php
ob_start();
?>

<div class="container my-5">
    <?php if ($chapter): ?>
        <h2 class="chapter-title text-center mb-5"><?= htmlspecialchars($chapter['TenChuong']) ?></h2>

        <div class="chapter-wrapper">
            <div class="chapter-content">
                <?= $chapter['NoiDung'] ?> 
            </div>
        </div>
    
    <?php else: ?>
        <p class="text-center">Chương không tồn tại.</p>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
include (__DIR__ . '/../../../templates/layout.php');
?>
