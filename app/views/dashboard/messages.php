<?php
$pageTitle = "Съобщения";
require_once __DIR__ . '/../partials/header.php';
?>

<h2>Моите съобщения</h2>
<?php foreach ($messages as $msg): ?>
    <div class="message">
        <strong><?= $msg['user_id'] === $_SESSION['user_id'] ? 'Вие' : 'Друг' ?>:</strong>
        <p><?= htmlspecialchars($msg['content']) ?></p>
        <small><?= $msg['created_at'] ?></small>
    </div>
<?php endforeach; ?>

<form method="POST">
    <textarea name="content" required placeholder="Напиши съобщение..."></textarea>
    <button type="submit">Изпрати</button>
</form>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
