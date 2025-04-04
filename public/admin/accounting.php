<?php
session_start();
require_once __DIR__ . '/../../app/models/User.php';

if (!isset($_SESSION['user_id']) || !User::isMasterAdmin($_SESSION['user_id'])) {
    header("Location: ../dashboard.php");
    exit;
}

$report = '';
if (isset($_GET['period'])) {
    $period = $_GET['period'];
    $report = "Генериран отчет за $period (примерни данни)";
}

require_once __DIR__ . '/../../app/views/admin/accounting.php';
