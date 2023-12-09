<?php
include 'config/db_conn.php';
session_start();



$report_id = mysqli_real_escape_string($conn, $_POST['report_id']);
$report_name = mysqli_real_escape_string($conn, $_POST['report_name']);
$report_path = mysqli_real_escape_string($conn, $_POST['report_path']);


// Update query
$sql = "UPDATE reports
        SET 
           report_id = '$report_id',
           report_name = '$report_name',
           report_path= '$report_path'
            
        WHERE report_id = '$report_id'";

// Execute query
$result = mysqli_query($conn, $sql);

// Check result and redirect
if ($result) {
    $_SESSION['status'] = "Data successfully updated.";
    $_SESSION['status_code'] = "success";
    header('Location: reports.php');
    exit();
} else {
    $_SESSION['status'] = "Error updating data: " . mysqli_error($conn);
    $_SESSION['status_code'] = "error";
    header('Location: reports.php');
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
