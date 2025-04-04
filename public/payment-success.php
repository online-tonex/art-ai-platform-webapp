<?php
require_once('../app/middleware/auth.php');
require_once('../config/database.php');

$order_id = (int) ($_GET['order_id'] ?? 0);

$stmt = $pdo->prepare("UPDATE payments SET status = 'платено' WHERE order_id = ?");
$stmt->execute([$order_id]);

$stmt = $pdo->prepare("UPDATE orders SET status = 'в производство' WHERE id = ?");
$stmt->execute([$order_id]);

echo "Плащането е успешно. Поръчката премина в производство.";
?>
