<?php
$pageTitle = "Поръчка #{$order['id']}";
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Поръчка #<?= $order['id'] ?></h2>
<p><strong>Статус:</strong> <?= $order['status'] ?></p>
<p><strong>Обща сума:</strong> <?= $order['total_price'] ?> лв.</p>

<h3>Чат</h3>
<div class="chat-box">
    <?php foreach ($messages as $m): ?>
        <p><strong><?= htmlspecialchars($m['name']) ?>:</strong> <?= htmlspecialchars($m['message']) ?> <small>(<?= $m['sent_at'] ?>)</small></p>
    <?php endforeach; ?>
</div>

<form method="POST">
    <textarea name="message" rows="3" required></textarea><br>
    <button type="submit">Изпрати съобщение</button>
</form>

<?php if ($_SESSION['role'] === 'client' && $order['status'] === 'очаква одобрение'): ?>
    <h4>Действие по поръчката</h4>
    <form method="POST">
        <select name="status">
            <option value="одобрена">Одобрявам</option>
            <option value="отменена">Отказвам</option>
            <option value="очаква одобрение" selected>Искам корекция</option>
        </select>
        <button type="submit">Изпрати</button>
    </form>
<?php endif; ?>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
