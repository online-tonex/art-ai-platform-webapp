<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Общ преглед</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <h2>Общ преглед</h2>
    <ul>
        <li>Общо поръчки: <?= $stats['total_orders'] ?></li>
        <li>Общ приход: <?= number_format($stats['total_revenue'], 2) ?> лв.</li>
        <li>Незавършени поръчки: <?= $stats['pending_orders'] ?></li>
    </ul>
</body>
</html>
