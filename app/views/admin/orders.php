<?php
$pageTitle = "Админ – Поръчки";
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Всички поръчки</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Клиент</th>
        <th>Продукт</th>
        <th>Статус</th>
        <th>Дата</th>
        <th>Действия</th>
    </tr>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['user_name']) ?></td>
            <td><?= htmlspecialchars($order['product_name'] ?? '-') ?></td>
            <td><?= $order['status'] ?></td>
            <td><?= $order['created_at'] ?></td>
            <td>
                <a href="view-order.php?id=<?= $order['id'] ?>">👁️</a>
                <?php if (User::isMasterAdmin($_SESSION['user_id'])): ?>
                    <a href="delete-order.php?id=<?= $order['id'] ?>" onclick="return confirm('Изтриване на поръчката?')">🗑️</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
