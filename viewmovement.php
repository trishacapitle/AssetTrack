<?php
include 'config/db_conn.php';
session_start(); // Start the session

if (isset($_POST['checking_viewbtn'])) {
    $asset_id = $_POST['asset_id'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM assetsmovements WHERE asset_id = ? ORDER BY movement_date DESC LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $asset_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo '<style>
            .asset-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px; /* Add spacing between the table and other elements if needed */
                background-color: #f2f2f2; /* Add your desired background color */
            }

            .asset-table td {
                padding: 10px;
                border: 1px solid #ddd;
            }

            .label {
                font-weight: bold;
            }
        </style>';
        echo '<table class="asset-table">';
        $row = mysqli_fetch_assoc($result);
        echo '
            <tr>
                <td class="label">Asset ID:</td>
                <td>' . $row['asset_id'] . '</td>
            </tr>
            <tr>
                <td class="label">Previous Location:</td>
                <td>' . $row['previous_location'] . '</td>
            </tr>
            <tr>
                <td class="label">New Location:</td>
                <td>' . $row['new_location'] . '</td>
            </tr>
            <tr>
                <td class="label">Movement Date:</td>
                <td>' . $row['movement_date'] . '</td>
            </tr>';
        echo '</table>';

        // Log the successful viewing of asset details
        logHistory("Viewed Asset Details for Asset ID: {$asset_id}");
    } else {
        echo 'No records found.';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

// Function to log history
function logHistory($actionmade) {
    $logFile = 'history.log';
    $logactionmade = "[" . date('Y-m-d H:i:s') . "] " . $actionmade . PHP_EOL;
    file_put_contents($logFile, $logactionmade, FILE_APPEND | LOCK_EX);
}
?>
