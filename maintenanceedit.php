<?php
session_start(); // Start the session

include 'config/db_conn.php';

// Define an array to store validation errors
$errors = array();

// Sanitize and validate user inputs
$TaskID = isset($_POST['task_id']) ? mysqli_real_escape_string($conn, $_POST['task_id']) : '';
$AssetID = isset($_POST['asset_id']) ? mysqli_real_escape_string($conn, $_POST['asset_id']) : '';
$TaskType = isset($_POST['task_type']) ? mysqli_real_escape_string($conn, $_POST['task_type']) : '';
$TaskDescription = isset($_POST['task_description']) ? mysqli_real_escape_string($conn, $_POST['task_description']) : '';
$TaskDate = isset($_POST['task_date']) ? mysqli_real_escape_string($conn, $_POST['task_date']) : '';

// Update query
$sql = "UPDATE maintenancetasks
        SET 
        task_type = '$TaskType',
        task_description = '$TaskDescription',
        task_date= '$TaskDate'
        WHERE task_id = '$TaskID' AND asset_id = '$AssetID'";

// Execute query
$result = mysqli_query($conn, $sql);

// Check result and redirect
if ($result) {
    $_SESSION['status'] = "Data successfully updated.";
    $_SESSION['status_code'] = "success";
    header('Location: maintenance.php');
    exit();
} else {
    $_SESSION['status'] = "Error updating data: " . mysqli_error($conn);
    $_SESSION['status_code'] = "error";
    header('Location: maintenance.php');
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
