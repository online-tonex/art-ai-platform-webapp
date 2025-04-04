<?php
require_once __DIR__ . '/constants.php';

$host = DB_HOST;
$db   = DB_NAME;
$user = DB_USER;
$pass = DB_PASS;


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
