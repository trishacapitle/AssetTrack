<?php
include 'config/db_conn.php';
session_start(); // Start the session

// Function to get asset details before deletion
function getAssetDetails($conn, $asset_id) {
    $sql = "SELECT * FROM assetsmovements WHERE asset_id = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $asset_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row;
        }
    }

    return null;
}

if (isset($_POST['asset_id'])) {
    $asset_id = $_POST['asset_id'];

    // Get the asset details before deletion for logging
    $assetDetails = getAssetDetails($conn, $asset_id);

    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM assetsmovements WHERE asset_id = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $asset_id);

        if (mysqli_stmt_execute($stmt)) {
            // Log the successful deletion with asset details
            logHistory("Deletion Successfully for Asset ID: {$asset_id}", $assetDetails);

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
