<?php
function requireRole(array $allowedRoles) {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowedRoles)) {
        echo "Нямате достъп до тази секция.";
        exit;
    }
}
