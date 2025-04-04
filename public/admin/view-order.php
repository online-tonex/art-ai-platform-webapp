<?php
session_start();
require_once __DIR__ . '/../../app/models/Order.php';
require_once __DIR__ . '/../../app/models/User.php';

if (!isset($_SESSION['user_id']) || User::find($_SESSION['user_id'])['role'] !== 'admin') {
    header("Location: orders.php");
    exit;
}

$orderId = $_GET['id'] ?? null;
if (!$orderId) die("Липсва ID");

$stmt = $pdo->prepare("SELECT o.*, u.name as user_name FROM orders o JOIN users u ON o.user_id = u.id WHERE o.id = ?");
$stmt->execute([$orderId]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) die("Поръчката не е намерена.");

$pageTitle = "Преглед на поръчка #{$order['id']}";
require_once __DIR__ . '/../../app/views/partials/header.php';
?>

<h2>Поръчка #<?= $order['id'] ?></h2>
<p><strong>Клиент:</strong> <?= htmlspecialchars($order['user_name']) ?></p>
<p><strong>Продукт:</strong> <?= $order['product_name'] ?? '-' ?></p>
<p><strong>Статус:</strong> <?= $order['status'] ?></p>
<p><strong>Дата:</strong> <?= $order['created_at'] ?></p>
<?php if ($order['image_path']): ?>
    <p><strong>Качено изображение:</strong><br>
        <img src="<?= BASE_URL ?>/assets/uploads/original/<?= $order['image_path'] ?>" width="300">
    </p>
<?php endif; ?>

<?php require_once __DIR__ . '/../../app/views/partials/footer.php'; ?>
