<?php
session_start(); // Start the session

include 'config/db_conn.php';

// Define an array to store validation errors
$errors = array();

// Sanitize and validate user inputs
$CheckinoutID = isset($_POST['checkinout_id']) ? mysqli_real_escape_string($conn, $_POST['checkinout_id']) : '';
$AssetID = isset($_POST['asset_id']) ? mysqli_real_escape_string($conn, $_POST['asset_id']) : '';
$UserID = isset($_POST['user_id']) ? mysqli_real_escape_string($conn, $_POST['user_id']) : '';
$CheckinDate = isset($_POST['checkin_date']) ? mysqli_real_escape_string($conn, $_POST['checkin_date']) : '';
$CheckoutDate = isset($_POST['checkout_date']) ? mysqli_real_escape_string($conn, $_POST['checkout_date']) : '';
$ExpectedReturnDate = isset($_POST['expected_return_date']) ? mysqli_real_escape_string($conn, $_POST['expected_return_date']) : '';

// Validate required fields (customize as needed)
if (empty($CheckinoutID)) {
    $errors[] = "Checkinout ID is required.";
}
if (empty($AssetID)) {
    $errors[] = "Asset ID is required.";
}
if (empty($UserID)) {
    $errors[] = "User ID is required.";
}
if (empty($CheckinDate)) {
    $errors[] = "Checkin Date is required.";
}
if (empty($CheckoutDate)) {
    $errors[] = "Checkout Date is required.";
}
if (empty($ExpectedReturnDate)) {
    $errors[] = "Return Date is required.";
}

if (empty($errors)) {
    // Assuming the table name is 'checkinout'
    $sql = "INSERT INTO `checkinout` (checkinout_id, asset_id, user_id, checkin_date, checkout_date, expected_return_date)
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $CheckinoutID, $AssetID, $UserID, $CheckinDate, $CheckoutDate, $ExpectedReturnDate);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['status'] = "Data Inserted Successfully";
            $_SESSION['status_code'] = "success";
            mysqli_stmt_close($stmt); // Close statement before redirection
            header('Location: checkinout.php');
            exit();
        } else {
            $_SESSION['status'] = "Error: " . mysqli_stmt_error($stmt);
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "Error: " . mysqli_error($conn);
        $_SESSION['status_code'] = "error";
    }
} else {
    // Handle validation errors
    $_SESSION['status'] = "Validation errors: " . implode(", ", $errors);
    $_SESSION['status_code'] = "error";
}

// Redirect regardless of success or error
header('Location: checkinout.php');
exit();
?>
