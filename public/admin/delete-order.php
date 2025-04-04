<?php
session_start();
require_once __DIR__ . '/../../app/models/User.php';

if (!isset($_SESSION['user_id']) || !User::isMasterAdmin($_SESSION['user_id'])) {
    header("Location: orders.php");
    exit;
}

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: orders.php");
exit;
