<?php
include 'config/db_conn.php';
session_start();

$UserID = mysqli_real_escape_string($conn, $_POST['id']);
$Name = mysqli_real_escape_string($conn, $_POST['name']);
$Username = mysqli_real_escape_string($conn, $_POST['user_name']);
$Email = mysqli_real_escape_string($conn, $_POST['email']);
$RoleID = mysqli_real_escape_string($conn, $_POST['role_id']);
$rawPassword = mysqli_real_escape_string($conn, $_POST['password']);

// Hash the password
$hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);


// Update query
$sql = "UPDATE users
        SET 
           name = '$Name',
           user_name = '$Username',
           password = '$hashedPassword',
           email = '$Email',
           role_id = '$RoleID'
            
        WHERE id = '$UserID'";

// Execute query
$result = mysqli_query($conn, $sql);

// Check result and redirect
if ($result) {
    $_SESSION['status'] = "Data successfully updated.";
    $_SESSION['status_code'] = "success";
    header('Location: settings.php');
    exit();
} else {
    $_SESSION['status'] = "Error updating data: " . mysqli_error($conn);
    $_SESSION['status_code'] = "error";
    header('Location: settings.php');
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
