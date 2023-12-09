<?php
session_start();

include 'config/db_conn.php';

$oldPassword = mysqli_real_escape_string($conn, $_POST['oldPassword']);
$newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);

// Retrieve hashed old password from the database
$sql = "SELECT password FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $hashedOldPassword = $row['password'];

    // Verify the old password
    if (password_verify($oldPassword, $hashedOldPassword)) {
        // Hash the new password
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database for the selected user ID
        $sqlUpdate = "UPDATE users SET password='$newPasswordHash' WHERE id='$user_id'";
        $resultUpdate = mysqli_query($conn, $sqlUpdate);

        // Check result and redirect
        if ($resultUpdate) {
            $_SESSION['status'] = "Password successfully updated.";
            $_SESSION['status_code'] = "success";
            header('Location: settings.php');
            exit();
        } else {
            $_SESSION['status'] = "Error updating password: " . mysqli_error($conn);
            $_SESSION['status_code'] = "error";
            header('Location: settings.php');
            exit();
        }
    } else {
        // Old password verification failed
        $_SESSION['status'] = "Incorrect old password.";
        $_SESSION['status_code'] = "error";
        header('Location: settings.php');
        exit();
    }
} else {
    // User not found
    $_SESSION['status'] = "User not found.";
    $_SESSION['status_code'] = "error";
    header('Location: settings.php');
    exit();
}

// Close the database connection
mysqli_close($conn);

?>