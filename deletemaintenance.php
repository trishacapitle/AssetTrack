<?php
include 'config/db_conn.php';
session_start(); // Start the session

if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM maintenancetasks WHERE task_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $task_id);

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
