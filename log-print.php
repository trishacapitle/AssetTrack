<?php
session_start();
include "config/db_conn.php";

// Gather data from the AJAX request
$fileName = mysqli_real_escape_string($conn, $_POST['fileName']);
$filePath = isset($_POST['filePath']) ? mysqli_real_escape_string($conn, $_POST['filePath']) : 'D:/Downloads'; // Set default value if not provided
$generatedDate = isset($_POST['generatedDate']) ? mysqli_real_escape_string($conn, $_POST['generatedDateTime']) : date('Y-m-d'); // Use the provided date or current date as default

// Insert the log into the reports table
$sql = "INSERT INTO reports (report_name, report_path, generated_date) VALUES ('$fileName', '$filePath', '$generatedDateTime')";

if ($conn->query($sql) === TRUE) {
    echo "Print operation logged successfully.";
} else {
    echo "Error logging print operation: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
