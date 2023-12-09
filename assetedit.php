<?php
include 'config/db_conn.php';
session_start();

$asset_id = $_POST['asset_id'];
$asset_type = $_POST['asset_type'];
$maker = $_POST['maker'];
$model = $_POST['model'];
$serial_number = $_POST['serial_number'];
$purchase_date = $_POST['purchase_date'];
$assigned_location = $_POST['assigned_location'];
$status = $_POST['status'];
$unit = $_POST['unit'];

$sql = "UPDATE hardwareassets 
        SET 
        asset_type = ?,
        maker = ?,
        model = ?,
        serial_number = ?,
        purchase_date = ?,
        assigned_location = ?,
        status = ?,
        unit = ?
        WHERE asset_id = ?";

try {
    // Fetch previous location
    $sqlFetchPreviousLocation = "SELECT assigned_location FROM hardwareassets WHERE asset_id = ?";
    $stmtFetchPreviousLocation = $conn->prepare($sqlFetchPreviousLocation);
    $stmtFetchPreviousLocation->bind_param("i", $asset_id);
    $stmtFetchPreviousLocation->execute();
    $resultFetchPreviousLocation = $stmtFetchPreviousLocation->get_result();

    if ($resultFetchPreviousLocation) {
        $row = $resultFetchPreviousLocation->fetch_assoc();
        $previous_location = $row['assigned_location'];

        // Update the asset information
        updateAsset($conn, $sql, $asset_type, $maker, $model, $serial_number, $purchase_date,
            $assigned_location, $status, $unit, $asset_id, $previous_location);
    } else {
        throw new Exception("Error fetching previous location: " . $stmtFetchPreviousLocation->error);
    }
} catch (Exception $e) {
    // Handle exceptions
    $_SESSION['status'] = "Error: " . $e->getMessage();
    $_SESSION['status_code'] = "error";
    header('Location: Hardwareassets.php');
    exit();
}

// Function to update asset information
function updateAsset($conn, $sql, $asset_type, $maker, $model, $serial_number, $purchase_date,
                     $assigned_location, $status, $unit, $asset_id, $previous_location) {
    $stmtUpdateAsset = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if (!$stmtUpdateAsset) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }

    $stmtUpdateAsset->bind_param("ssssssssi", $asset_type, $maker, $model, $serial_number, $purchase_date,
        $assigned_location, $status, $unit, $asset_id);

    $resultUpdateAsset = $stmtUpdateAsset->execute();

    // Check for errors
    if ($resultUpdateAsset) {
        // Fetch the new location after the update
        $sqlFetchNewLocation = "SELECT assigned_location FROM hardwareassets WHERE asset_id = ?";
        $stmtFetchNewLocation = $conn->prepare($sqlFetchNewLocation);
        $stmtFetchNewLocation->bind_param("i", $asset_id);
        $stmtFetchNewLocation->execute();
        $resultFetchNewLocation = $stmtFetchNewLocation->get_result();

        if ($resultFetchNewLocation) {
            $rowNew = $resultFetchNewLocation->fetch_assoc();
            $new_location = $rowNew['assigned_location'];

            // Check if assigned_location is changed
            if ($assigned_location != $previous_location) {
                // Log the successful update with asset ID
                logHistory("Update Successfully for Asset ID: {$asset_id}");

                // Insert a new record into assetsmovements
                insertMovement($conn, $asset_id, $previous_location, $new_location);
            }

            // Set session variables and redirect
            $_SESSION['status'] = "Data successfully updated.";
            $_SESSION['status_code'] = "success";
            header('Location: Hardwareassets.php');
            exit();
        } else {
            throw new Exception("Error fetching new location: " . $stmtFetchNewLocation->error);
        }
    } else {
        throw new Exception("Error updating asset information: " . $stmtUpdateAsset->error);
    }
}

// Function to insert movement
function insertMovement($conn, $asset_id, $previous_location, $new_location) {
    $sqlInsertMovement = "INSERT INTO assetsmovements (asset_id, previous_location, new_location, movement_date) 
                          VALUES (?, ?, ?, CURRENT_TIMESTAMP)";
    $stmtInsertMovement = $conn->prepare($sqlInsertMovement);
    $stmtInsertMovement->bind_param("iss", $asset_id, $previous_location, $new_location);
    $resultInsertMovement = $stmtInsertMovement->execute();

    // Check for errors
    if (!$resultInsertMovement) {
        throw new Exception("Error inserting into assetsmovements: " . $stmtInsertMovement->error);
    }

    // Close the statement
    $stmtInsertMovement->close();
}

// Function to log history
function logHistory($actionmade) {
    $logFile = 'history.log';
    $logactionmade = "[" . date('Y-m-d H:i:s') . "] " . $actionmade . PHP_EOL;
    file_put_contents($logFile, $logactionmade, FILE_APPEND | LOCK_EX);
}
?>
