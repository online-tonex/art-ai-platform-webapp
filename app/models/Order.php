<?php
require_once __DIR__ . '/../config/database.php';

class Order
{
    public static function getByUser($userId)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAll()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT o.*, u.name as user_name FROM orders o
                             LEFT JOIN users u ON o.user_id = u.id
                             ORDER BY o.created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserImages($userId)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT image_path FROM orders WHERE user_id = ? AND image_path IS NOT NULL");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
