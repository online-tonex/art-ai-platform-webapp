<?php
require_once('../app/middleware/auth.php');
require_once('../config/database.php');

$user_id = $_SESSION['user_id'];

// Проверка за всички полета
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $style_id = $_POST['style_id'];
    $product_id = $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];

    // Качване на изображение
    $uploadDir = "../assets/uploads/original/";
    $filename = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $uploadDir . $filename;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // Изчисляване на цена
        $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $price = $stmt->fetchColumn();
        $total = $price * $quantity;

        // Създаване на поръчка
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
        $stmt->execute([$user_id, $total]);
        $order_id = $pdo->lastInsertId();

        // Добавяне на продукт към поръчката
        $stmt = $pdo->prepare("INSERT INTO order_products (order_id, product_id, quantity, style_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $product_id, $quantity, $style_id]);

        // Запазване на каченото изображение
        $stmt = $pdo->prepare("INSERT INTO order_images (order_id, file_path, type, uploaded_by) VALUES (?, ?, 'original', ?)");
        $stmt->execute([$order_id, $filename, $user_id]);

        header("Location: orders.php?success=1");
        exit;
    } else {
        echo "Грешка при качване на файла.";
    }
}
