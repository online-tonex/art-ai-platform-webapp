<?php
$pageTitle = "Моят профил";
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Добре дошъл, <?= htmlspecialchars($user['name']) ?>!</h2>

<nav>
    <ul>
        <li><a href="orders.php">📦 Моите поръчки</a></li>
        <li><a href="gallery.php">🖼️ Галерия</a></li>
        <li><a href="messages.php">💬 Съобщения</a></li>
        <?php if ($user['role'] === 'admin' || $user['role'] === 'masteradmin'): ?>
            <li><a href="../admin/index.php">🛠️ Админ панел</a></li>
        <?php endif; ?>
    </ul>
</nav>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
