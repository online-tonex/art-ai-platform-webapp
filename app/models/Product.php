<?php
require_once __DIR__ . '/../config/database.php';

class Product
{
    public static function getAll()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM products ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
