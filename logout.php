<?php
session_start();
include "config/db_conn.php";

// Get user information from the session
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;

// Check if user_name is not set, redirect to index.php
if (!$user_name) {
    header("Location: index.php");
    exit();
}

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Insert logout attempt into the audit trail
$event_type = 'Logout';
$logoutSql = "INSERT INTO login_audit (user_name, success) VALUES ('$user_name', '$event_type')";

if (!mysqli_query($conn, $logoutSql)) {
    echo "Error: " . mysqli_error($conn);
    exit();
}

header("Location: index.php");
exit();
?>
