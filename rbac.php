<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function checkAccess($requiredRoles = []) {
    if (!isset($_SESSION['role'])) {
        http_response_code(403);
        die("Access denied. Not logged in.");
    }

    if (!in_array($_SESSION['role'], $requiredRoles)) {
        http_response_code(403);
        die("Access denied. Insufficient permissions.");
    }
}

?>