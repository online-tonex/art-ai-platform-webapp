<?php
session_start();
require_once __DIR__ . '/../../app/models/User.php';
require_once __DIR__ . '/../../app/models/Order.php';

if (!isset($_SESSION['user_id']) || User::find($_SESSION['user_id'])['role'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

$orders = Order::getAll();
require_once __DIR__ . '/../../app/views/admin/orders.php';
