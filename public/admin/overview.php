<?php
require_once __DIR__ . '/../../app/middleware/auth.php';
require_once __DIR__ . '/../../app/middleware/role.php';
requireRole(['admin', 'masteradmin']);

require_once __DIR__ . '/../../config/database.php';

$stmt = $pdo->query("
    SELECT
        COUNT(*) AS total_orders,
        SUM(total_price) AS total_revenue,
        SUM(CASE WHEN status = 'очаква одобрение' THEN 1 ELSE 0 END) AS pending_orders
    FROM orders
");
$stats = $stmt->fetch();

require_once __DIR__ . '/../../app/views/admin/overview.php';
