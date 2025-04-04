<?php
require_once __DIR__ . '/../config/database.php';

class Style
{
    public static function getAll()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM styles ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
