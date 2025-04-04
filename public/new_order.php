<?php
require_once __DIR__ . '/../app/middleware/auth.php';
require_once __DIR__ . '/../app/middleware/role.php';
requireRole(['client']);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/OrderController.php';
require_once __DIR__ . '/../app/models/Product.php';
require_once __DIR__ . '/../app/models/Style.php';

$products = (new Product($pdo))->all();
$styles = (new Style($pdo))->all();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order = new OrderController($pdo);
    $result = $order->createOrder(
        $_SESSION['user_id'],
        $_POST['style_id'],
        $_POST['product_id'],
        $_POST['quantity'],
        $_FILES['image']
    );

    if ($result['success']) {
        header("Location: orders.php?success=1");
        exit;
    } else {
        $error = $result['message'];
    }
}

require_once __DIR__ . '/../app/views/dashboard/new_order.php';
