<?php
require_once('../app/middleware/auth.php');
require_once('../config/database.php');

$order_id = (int) ($_POST['order_id'] ?? 0);
$status = $_POST['status'] ?? '';
$user_id = $_SESSION['user_id'];

// Проверка дали потребителят има достъп
$stmt = $pdo->prepare("SELECT user_id FROM orders WHERE id = ?");
$stmt->execute([$order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order || $order['user_id'] != $user_id) {
    echo "Нямате права за тази операция.";
    exit;
}

$allowed = ['одобрена', 'очаква одобрение', 'отменена'];
if (in_array($status, $allowed)) {
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $order_id]);
}

header("Location: order.php?id=$order_id");
exit;
