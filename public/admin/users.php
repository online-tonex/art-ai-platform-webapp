<?php
session_start();
require_once __DIR__ . '/../../app/models/User.php';

if (!isset($_SESSION['user_id']) || !User::isMasterAdmin($_SESSION['user_id'])) {
    header("Location: ../dashboard.php");
    exit;
}

$users = User::getAll();
require_once __DIR__ . '/../../app/views/admin/users.php';
