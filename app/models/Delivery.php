<?php
require_once __DIR__ . '/../config/database.php';

class Delivery
{
    public static function getAllMethods()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM delivery_methods ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM delivery_methods WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
