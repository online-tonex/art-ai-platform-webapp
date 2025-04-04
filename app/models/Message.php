<?php
require_once __DIR__ . '/../config/database.php';

class Message
{
    public static function getByUser($userId)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM messages WHERE user_id = ? OR receiver_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId, $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function send($fromId, $toId, $content)
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO messages (user_id, receiver_id, content) VALUES (?, ?, ?)");
        return $stmt->execute([$fromId, $toId, $content]);
    }
}
