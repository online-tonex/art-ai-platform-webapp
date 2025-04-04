<?php
$pageTitle = "Моите поръчки";
require_once __DIR__ . '/../partials/header.php';
?>

<h2>История на поръчките</h2>
<table>
    <tr><th>№</th><th>Продукт</th><th>Дата</th><th>Статус</th></tr>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['product'] ?? '-') ?></td>
            <td><?= $order['created_at'] ?></td>
            <td><?= $order['status'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
