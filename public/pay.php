<?php
require_once('../app/middleware/auth.php');
require_once('../config/database.php');
require_once('../vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_...'); // добави своя Stripe Secret Key

$order_id = (int) ($_GET['order_id'] ?? 0);

// Проверка
$stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
$stmt->execute([$order_id, $_SESSION['user_id']]);
$order = $stmt->fetch();

if (!$order || $order['status'] !== 'одобрена') {
    exit("Невалидна поръчка.");
}

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'bgn',
            'product_data' => [
                'name' => 'Поръчка #' . $order['id'],
            ],
            'unit_amount' => $order['total_price'] * 100,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'http://yourdomain.com/public/payment-success.php?order_id=' . $order_id,
    'cancel_url' => 'http://yourdomain.com/public/dashboard.php',
]);

header("Location: " . $session->url);
exit;
