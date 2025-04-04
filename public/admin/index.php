<?php
session_start();
require_once __DIR__ . '/../../app/models/User.php';

if (!isset($_SESSION['user_id']) || !User::isMasterAdmin($_SESSION['user_id']) && User::find($_SESSION['user_id'])['role'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

require_once __DIR__ . '/../../app/views/admin/index.php';
