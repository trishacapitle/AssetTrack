<?php
session_start(); // Start the session

include 'config/db_conn.php';

// Define an array to store validation errors
$errors = [];


if (isset($_POST['id'])) {
    $UserID = $_POST['id'];

    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $UserID); // Change "s" to "i"

        if (mysqli_stmt_execute($stmt)) {
            $response = array('status' => 'success', 'message' => 'Record deleted successfully');
            echo json_encode($response);
            exit();
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to delete record');
            echo json_encode($response);
            exit();
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to prepare the SQL statement');
        echo json_encode($response);
        exit();
    }
}
?>
