<?php
session_start(); 
include 'config/db_conn.php';

// Validate and sanitize input data
$report_id = mysqli_real_escape_string($conn, $_POST['report_id']);
$asset_id = mysqli_real_escape_string($conn, $_POST['asset_id']);
$report_item = mysqli_real_escape_string($conn, $_POST['report_item']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$generated_date = mysqli_real_escape_string($conn, $_POST['generated_date']);

// Use prepared statements to prevent SQL injection
$sql = "INSERT INTO `assetreports` (report_id, asset_id, report_item, location, generated_date)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssss", $report_id, $asset_id, $report_item, $location, $generated_date);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt); // Close the prepared statement

        // Redirect after successful insertion
        header('Location: reports.php');
        exit(); // Make sure to exit after sending the header
    } else {
        // Display the MySQL error
        die("Error: " . mysqli_stmt_error($stmt));
    }
} else {
    // Display the MySQL error
    die("Error: " . mysqli_error($conn));
}
?>
