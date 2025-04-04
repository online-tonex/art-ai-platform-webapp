<?php
require_once('../../app/middleware/auth.php');
require_once('../../app/middleware/role.php');
requireRole(['admin', 'masteradmin']);

require_once('../../config/database.php');

$stmt = $pdo->query("
    SELECT u.id, u.name, u.email, u.phone, COUNT(o.id) AS order_count
    FROM users u
    LEFT JOIN orders o ON u.id = o.user_id
    WHERE u.role = 'client'
    GROUP BY u.id
");
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Клиенти</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <h2>Клиенти</h2>
    <table>
        <thead>
            <tr>
                <th>Име</th>
                <th>Имейл</th>
                <th>Телефон</th>
                <th>Поръчки</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['name']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['phone']) ?></td>
                    <td><?= $c['order_count'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
