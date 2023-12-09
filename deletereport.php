<?php
include 'config/db_conn.php';
session_start(); 

if (isset($_POST['report_id'])) {
    $report_id = $_POST['report_id'];

    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM reports WHERE report_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $report_id);

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
