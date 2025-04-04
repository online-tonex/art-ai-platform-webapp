<?php
$pageTitle = "Моята галерия";
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Качени изображения</h2>
<div class="gallery">
    <?php foreach ($images as $img): ?>
        <img src="<?= BASE_URL ?>/assets/uploads/original/<?= htmlspecialchars($img['image_path']) ?>" alt="Изображение">
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
