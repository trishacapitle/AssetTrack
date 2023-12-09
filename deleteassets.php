<?php
include 'config/db_conn.php';
session_start(); // Start the session

if (isset($_POST['asset_id'])) {
    $assetId = $_POST['asset_id'];

    // Add this line for debugging
    logHistory("Received Asset ID for deletion: {$assetId}", null);

    // Get the asset details before deletion for logging
    $assetDetails = getAssetDetails($conn, $assetId);

    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM hardwareassets WHERE asset_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $assetId);

        if (mysqli_stmt_execute($stmt)) {
            // Log the successful deletion with asset details
            logHistory("Deletion Successful for Asset ID: {$assetId}", $assetDetails);
            $response = array('status' => 'success', 'message' => 'Record deleted successfully');
        } else {
            // Log the error
            logHistory("Failed to delete record for Asset ID: {$assetId}, Error: " . mysqli_error($conn), $assetDetails);
            $response = array('status' => 'error', 'message' => 'Failed to delete record');
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Log the error
        logHistory("Failed to prepare the SQL statement for Asset ID: {$assetId}", null);
        $response = array('status' => 'error', 'message' => 'Failed to prepare the SQL statement');
    }

    echo json_encode($response);
    exit();
}

// Function to get asset details before deletion
function getAssetDetails($conn, $assetId) {
    $sql = "SELECT * FROM hardwareassets WHERE asset_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $assetId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Log the retrieved asset details
            logHistory("Retrieved Asset Details for Asset ID: {$assetId}", $row);
            return $row;
        }
    }

    return null;
}

// Function to log history
function logHistory($actionMade, $assetDetails) {
    $logFile = 'history.log';
    $logActionMade = "[" . date('Y-m-d H:i:s') . "] " . $actionMade . PHP_EOL;

    // Add asset details to the log
    if ($assetDetails) {
        $logActionMade .= "Asset Details: " . var_export($assetDetails, true) . PHP_EOL;
    }

    file_put_contents($logFile, $logActionMade, FILE_APPEND | LOCK_EX);
}
?>
