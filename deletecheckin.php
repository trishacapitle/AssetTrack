<?php
include 'config/db_conn.php';
session_start(); // Start the session

if (isset($_POST['checkinout_id'])) {
    $checkinout_id = $_POST['checkinout_id'];

    // Get the asset details before deletion for logging
    $assetDetails = getAssetDetails($conn, $checkinout_id);

    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM checkinout WHERE checkinout_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $checkinout_id);

        if (mysqli_stmt_execute($stmt)) {
            // Log the successful deletion with asset details
            logHistory("Deletion Successfully for Checkinout ID: {$checkinout_id}", $assetDetails);

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

// Function to get asset details before deletion
function getAssetDetails($conn, $checkinout_id) {
    $sql = "SELECT * FROM checkinout WHERE checkinout_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $checkinout_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row;
        }
    }

    return null;
}

// Function to log history
function logHistory($actionmade, $assetDetails) {
    $logFile = 'history.log';
    $logactionmade = "[" . date('Y-m-d H:i:s') . "] " . $actionmade . PHP_EOL;

    // Add asset details to the log
    if ($assetDetails) {
        $logactionmade .= "Asset Details: " . var_export($assetDetails, true) . PHP_EOL;
    }

    file_put_contents($logFile, $logactionmade, FILE_APPEND | LOCK_EX);
}
?>
