<?php
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

// Използваме абсолютен път
$envPath = realpath(__DIR__ . '/../');
if (!$envPath) {
    die("❌ Не може да се намери пътят към .env");
}

$dotenv = Dotenv::createImmutable($envPath);
$dotenv->load();

// Диагностика
if (!getenv('DB_USER')) {
    echo "<pre>.env не е зареден. Съдържание на директорията:</pre>";
    var_dump(scandir($envPath));
    die("⚠️ .env файлът не е зареден или липсва!");
}
