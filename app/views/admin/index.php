<?php
$pageTitle = "Админ панел";
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Добре дошли в админ панела</h2>
<nav>
    <ul>
        <li><a href="orders.php">📦 Всички поръчки</a></li>
        <li><a href="users.php">👥 Потребители</a></li>
        <li><a href="accounting.php">📊 Счетоводство</a></li>
    </ul>
</nav>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
