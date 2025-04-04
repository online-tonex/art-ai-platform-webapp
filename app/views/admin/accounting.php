<?php
$pageTitle = "Админ – Счетоводство";
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Счетоводен отчет</h2>

<form method="GET">
    <label>Избери месец:
        <input type="month" name="period" required>
    </label>
    <button type="submit">Генерирай отчет</button>
</form>

<?php if (!empty($report)): ?>
    <hr>
    <h3>Отчет за <?= htmlspecialchars($_GET['period']) ?></h3>
    <pre><?= $report ?></pre>
<?php endif; ?>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
