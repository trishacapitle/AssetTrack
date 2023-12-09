<?php
// Assuming you have a database connection
session_start();
include 'config/db_conn.php';

// Fetch data from the "assets" table
$sql = "SELECT asset_id, asset_type, maker, model, serial_number, purchase_date, assigned_location, status, unit FROM hardwareassets";
$result = $conn->query($sql);

$assetChartData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add each row to the $assetChartData array
        $assetChartData[] = $row;
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
