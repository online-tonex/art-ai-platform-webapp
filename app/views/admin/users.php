<?php
$pageTitle = "Админ – Потребители";
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../../models/User.php';
?>

<h2>Списък с потребители</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Име</th>
        <th>Имейл</th>
        <th>Роля</th>
        <th>Дата</th>
        <?php if (User::isMasterAdmin($_SESSION['user_id'])): ?>
            <th>Действия</th>
        <?php endif; ?>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $user['role'] ?></td>
            <td><?= $user['created_at'] ?></td>
            <?php if (User::isMasterAdmin($_SESSION['user_id'])): ?>
                <td>
                    <a href="edit-user.php?id=<?= $user['id'] ?>">✏️</a>
                    <a href="delete-user.php?id=<?= $user['id'] ?>" onclick="return confirm('Сигурен ли си?')">🗑️</a>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
