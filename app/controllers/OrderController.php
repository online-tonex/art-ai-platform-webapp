<?php

class OrderController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createOrder($user_id, $style_id, $product_id, $quantity, $image) {
        // Качване на файла
        $uploadDir = __DIR__ . '/../../assets/uploads/original/';
        $filename = time() . '_' . basename($image['name']);
        $target = $uploadDir . $filename;

        if (!move_uploaded_file($image['tmp_name'], $target)) {
            return ['success' => false, 'message' => 'Неуспешно качване на изображение.'];
        }

        // Вземане на цена
        $stmt = $this->pdo->prepare("SELECT price FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $price = $stmt->fetchColumn();
        $total = $price * $quantity;

        // Създаване на поръчка
        $stmt = $this->pdo->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
        $stmt->execute([$user_id, $total]);
        $order_id = $this->pdo->lastInsertId();

        // Продукт към поръчката
        $stmt = $this->pdo->prepare("INSERT INTO order_products (order_id, product_id, quantity, style_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $product_id, $quantity, $style_id]);

        // Запазване на оригиналното изображение
        $stmt = $this->pdo->prepare("INSERT INTO order_images (order_id, file_path, type, uploaded_by) VALUES (?, ?, 'original', ?)");
        $stmt->execute([$order_id, $filename, $user_id]);

        return ['success' => true, 'order_id' => $order_id];
    }
}
