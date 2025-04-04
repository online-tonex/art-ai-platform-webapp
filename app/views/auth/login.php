<?php
$pageTitle = "Вход";
require_once __DIR__ . '/../partials/header.php';
?>

<div class="auth-container">
    <h2>Вход</h2>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Имейл" required><br>
        <input type="password" name="password" placeholder="Парола" required><br>
        <button type="submit">Влез</button>
    </form>
    <p>Нямаш акаунт? <a href="register.php">Регистрация</a></p>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
