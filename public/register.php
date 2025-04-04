<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

$auth = new AuthController($pdo);

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $auth->register($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
    if ($result['success']) {
        header('Location: login.php');
        exit;
    } else {
        $error = $result['message'];
    }
}

require_once __DIR__ . '/../app/views/auth/register.php';
