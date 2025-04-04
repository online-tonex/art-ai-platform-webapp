<?php
require_once __DIR__ . '/../app/middleware/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/Order.php';
require_once __DIR__ . '/../app/models/Message.php';

$order_id = (int) ($_GET['id'] ?? 0);
$orderModel = new Order($pdo);
$messageModel = new Message($pdo);

$order = $orderModel->getSingle($order_id);

if (!$order || ($_SESSION['role'] === 'client' && $order['user_id'] !== $_SESSION['user_id'])) {
    die('Нямате достъп до тази поръчка.');
}

$messages = $messageModel->getAll($order_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $msg = trim($_POST['message']);
    if (!empty($msg)) {
        $messageModel->send($order_id, $_SESSION['user_id'], $msg);
        header("Location: order.php?id=$order_id");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    $newStatus = $_POST['status'];
    $orderModel->updateStatus($order_id, $newStatus);
    header("Location: order.php?id=$order_id");
    exit;
}

require_once __DIR__ . '/../app/views/dashboard/order.php';
