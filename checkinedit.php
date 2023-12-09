<?php
include 'config/db_conn.php';
session_start();

// Retrieve data from POST
$CheckinoutID = mysqli_real_escape_string($conn, $_POST['checkinout_id']);
$AssetID = mysqli_real_escape_string($conn, $_POST['asset_id']);
$UserID = mysqli_real_escape_string($conn, $_POST['user_id']);
$CheckinDate = mysqli_real_escape_string($conn, $_POST['checkin_date']);
$CheckoutDate = mysqli_real_escape_string($conn, $_POST['checkout_date']);
$ExpectedReturnDate= mysqli_real_escape_string($conn, $_POST['expected_return_date']);

// Update query
$sql = "UPDATE checkinout
        SET 
        checkinout_id = '$CheckinoutID' 
           user_id = '$UserID',
           checkin_date = '$CheckinDate',
           checkout_date = '$CheckoutDate',
           expected_return_date= '$ExpectedReturnDate'
        WHERE asset_id = '$AssetID'";

// Execute query
$result = mysqli_query($conn, $sql);

// Check result and redirect
if ($result) {
    $_SESSION['status'] = "Data successfully updated.";
    $_SESSION['status_code'] = "success";
    header('Location: checkinout.php');
    exit();
} else {
    $_SESSION['status'] = "Error updating data: " . mysqli_error($conn);
    $_SESSION['status_code'] = "error";
    header('Location: checkinout.php');
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
