<?php
$pageTitle = "Регистрация";
require_once __DIR__ . '/../partials/header.php';
?>

<div class="auth-container">
    <h2>Регистрация</h2>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Име" required><br>
        <input type="email" name="email" placeholder="Имейл" required><br>
        <input type="password" name="password" placeholder="Парола" required><br>
        <input type="password" name="confirm_password" placeholder="Повтори паролата" required><br>
        <button type="submit">Регистрирай се</button>
    </form>
    <p>Вече имаш акаунт? <a href="login.php">Влез тук</a></p>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
