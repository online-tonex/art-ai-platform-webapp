<?php
session_start();
require_once __DIR__ . '/../../app/models/User.php';

if (!isset($_SESSION['user_id']) || !User::isMasterAdmin($_SESSION['user_id'])) {
    header("Location: users.php");
    exit;
}

$id = $_GET['id'] ?? null;
$user = $id ? User::find($id) : null;

if (!$user) {
    die("Невалиден потребител.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $role  = $_POST['role'];

    $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, role=? WHERE id=?");
    $stmt->execute([$name, $email, $role, $id]);

    header("Location: users.php");
    exit;
}

$pageTitle = "Редакция на потребител";
require_once __DIR__ . '/../../app/views/partials/header.php';
?>

<h2>Редактирай потребител</h2>
<form method="POST">
    <label>Име: <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required></label><br>
    <label>Имейл: <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required></label><br>
    <label>Роля:
        <select name="role">
            <option value="client" <?= $user['role'] === 'client' ? 'selected' : '' ?>>Client</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="masteradmin" <?= $user['role'] === 'masteradmin' ? 'selected' : '' ?>>MasterAdmin</option>
        </select>
    </label><br>
    <button type="submit">Запази</button>
</form>

<?php require_once __DIR__ . '/../../app/views/partials/footer.php'; ?>
