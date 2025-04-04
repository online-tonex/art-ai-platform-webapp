<?php
$pageTitle = "Нова поръчка";
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Нова поръчка</h2>

<?php if (!empty($error)): ?>
    <p style="color: red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Качи изображение:</label>
    <input type="file" name="image" required><br><br>

    <label>Избери стил:</label><br>
    <?php foreach ($styles as $style): ?>
        <label style="display:inline-block; margin:10px;">
            <input type="radio" name="style_id" value="<?= $style['id'] ?>" required>
            <img src="/assets/img/<?= $style['thumbnail'] ?>" width="100"><br>
            <?= htmlspecialchars($style['name']) ?>
        </label>
    <?php endforeach; ?>

    <br><br>
    <label>Избери продукт:</label><br>
    <?php foreach ($products as $product): ?>
        <label>
            <input type="radio" name="product_id" value="<?= $product['id'] ?>" required>
            <?= htmlspecialchars($product['name']) ?> (<?= $product['price'] ?> лв.)
        </label><br>
    <?php endforeach; ?>

    <label>Брой:</label>
    <input type="number" name="quantity" value="1" min="1" required><br><br>

    <button type="submit">Подай поръчката</button>
</form>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
