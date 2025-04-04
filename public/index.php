<?php
session_start();

// Автоматично зареждане на зависимости
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/constants.php';

// Пренасочване според това дали потребителят е логнат
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
} else {
    header('Location: login.php');
}
exit;
