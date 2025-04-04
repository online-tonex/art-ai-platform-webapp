<?php
session_start();
require_once __DIR__ . '/../app/controllers/DashboardController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

DashboardController::orders($_SESSION['user_id']);
