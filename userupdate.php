<?php
session_start();

include 'config/db_conn.php';

// Define an array to store validation errors
$errors = [];

// Sanitize and validate user inputs
$id = isset($_POST['user']) ? mysqli_real_escape_string($conn, $_POST['user']) : '';
$user_name = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
$password = isset($_POST['password1']) ? password_hash($_POST['password1'], PASSWORD_DEFAULT) : ''; // Hash the password
$name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
$role_id = isset($_POST['role']) ? mysqli_real_escape_string($conn, $_POST['role']) : '';

// Validate required fields
if (empty($id)) {
    $errors[] = "User ID is required.";
}
if (empty($user_name)) {
    $errors[] = "Username is required.";
}
if (empty($password)) {
    $errors[] = "Password is required.";
}
// Add validation for other required fields here

// Insert into 'users' table
if (empty($errors)) {
    $sql = "INSERT INTO `users` (id, user_name, password, name, email, role_id)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $id, $user_name, $password, $name, $email, $role_id);

        if (mysqli_stmt_execute($stmt)) {
            // Log the successful insertion with user ID
            logHistory("Data Inserted Successfully for User ID: $id");

            $_SESSION['status'] = "Data Inserted Successfully";
            $_SESSION['status_code'] = "success";
        } else {
            // Log the error
            logHistory("Error: " . mysqli_stmt_error($stmt));

            $_SESSION['status'] = "Error: " . mysqli_stmt_error($stmt);
            $_SESSION['status_code'] = "error";
        }

        mysqli_stmt_close($stmt);

        header('Location: settings.php');
        exit();
    } else {
        // Log the error
        logHistory("Error: " . mysqli_error($conn));

        $_SESSION['status'] = "Error: " . mysqli_error($conn);
        $_SESSION['status_code'] = "error";
        header('Location: settings.php');
        exit();
    }
} else {
    // Handle validation errors
    // Log validation errors
    logHistory("Validation errors: " . implode(", ", $errors));

    $_SESSION['status'] = "Validation errors: " . implode(", ", $errors);
    $_SESSION['status_code'] = "error";
    header('Location: settings.php');
    exit();
}

// Function to log history
function logHistory($actionmade)
{
    // Set the timezone to Manila time
    date_default_timezone_set('Asia/Manila');

    $logFile = 'user.log';
    $logactionmade = "[" . date('Y-m-d H:i:s') . "] " . $actionmade . PHP_EOL;
    file_put_contents($logFile, $logactionmade, FILE_APPEND | LOCK_EX);
}
?>
