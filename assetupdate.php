<?php
session_start(); // Start the session

include 'config/db_conn.php';

// Sanitize and validate user inputs
$asset_type = isset($_POST['asset_type']) ? mysqli_real_escape_string($conn, $_POST['asset_type']) : '';
$maker = isset($_POST['maker']) ? mysqli_real_escape_string($conn, $_POST['maker']) : '';
$model = isset($_POST['model']) ? mysqli_real_escape_string($conn, $_POST['model']) : '';
$serial_number = isset($_POST['serial_number']) ? mysqli_real_escape_string($conn, $_POST['serial_number']) : '';
$purchase_date = isset($_POST['purchase_date']) ? mysqli_real_escape_string($conn, $_POST['purchase_date']) : '';
$assigned_location = isset($_POST['assigned_location']) ? mysqli_real_escape_string($conn, $_POST['assigned_location']) : '';
$status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : '';
$unit = isset($_POST['unit']) ? mysqli_real_escape_string($conn, $_POST['unit']) : '';

// Validate required fields
$errors = [];

if (empty($unit)) {
    $errors[] = "Unit ID is required.";
}
if (empty($asset_type)) {
    $errors[] = "Asset Type is required.";
}

// Insert into 'hardwareassets' table
if (empty($errors)) {
    $sql = "INSERT INTO `hardwareassets` (asset_type, maker, model, serial_number, purchase_date, assigned_location, status, unit)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssss", $asset_type, $maker, $model, $serial_number, $purchase_date, $assigned_location, $status, $unit);


        if (mysqli_stmt_execute($stmt)) {
            logHistory("Data Inserted Successfully for Unit ID: $unit");
            $_SESSION['status'] = "Data Inserted Successfully";
            $_SESSION['status_code'] = "success";
            header('Location: Hardwareassets.php');
            exit();
        } else {
            $errorMessage = "Error: " . mysqli_error($conn);
            logHistory($errorMessage);
            $_SESSION['status'] = $errorMessage;
            $_SESSION['status_code'] = "error";
        }

        mysqli_stmt_close($stmt);
    } else {
        $errorMessage = "Error: " . mysqli_error($conn);
        logHistory($errorMessage);
        $_SESSION['status'] = $errorMessage;
        $_SESSION['status_code'] = "error";
    }
} else {
    $validationErrors = "Validation errors: " . implode(", ", $errors);
    logHistory($validationErrors);
    $_SESSION['status'] = $validationErrors;
    $_SESSION['status_code'] = "error";
}

header('Location: Hardwareassets.php');
exit();

// Function to log history
function logHistory($actionmade) {
    date_default_timezone_set('Asia/Manila');

    $logFile = 'history.log';
    $logactionmade = "[" . date('Y-m-d H:i:s') . "] " . $actionmade . PHP_EOL;
    file_put_contents($logFile, $logactionmade, FILE_APPEND | LOCK_EX);
}
?>
