<?php
// userFunctions.php

$isUserAdmin = isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1;
$isUserTechnician = isset($_SESSION['role_id']) && $_SESSION['role_id'] === 2;
$isUserGuest = isset($_SESSION['role_id']) && $_SESSION['role_id'] === 3;

function getUserRole() {
    global $isUserAdmin, $isUserTechnician, $isUserGuest;

    // Determine the user's role based on your logic
    // For example, using the $isUserAdmin, $isUserTechnician, $isUserGuest variables
    if ($isUserAdmin) {
        return 'Admin';
    } elseif ($isUserTechnician) {
        return 'Technician';
    } elseif ($isUserGuest) {
        return 'Guest User';
    } else {
        return 'Unknown Role';
    }
}
?>
