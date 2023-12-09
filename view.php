<?php
include 'config/db_conn.php';
session_start(); // Start the session

if (isset($_POST['checking_viewbtn'])) {
    $asset_id = $_POST['asset_id'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM hardwareassets WHERE asset_id = ?";
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
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <tr>
                <td class="label">Asset ID:</td>
                <td>' . $row['asset_id'] . '</td>
            </tr>
            <tr>
                <td class="label">Asset Type:</td>
                <td>' . $row['asset_type'] . '</td>
            </tr>
            <tr>
                <td class="label">Maker:</td>
                <td>' . $row['maker'] . '</td>
            </tr>
            <tr>
                <td class="label">Model:</td>
                <td>' . $row['model'] . '</td>
            </tr>
            <tr>
                <td class="label">Serial Number:</td>
                <td>' . $row['serial_number'] . '</td>
            </tr>
            <tr>
                <td class="label">Purchase Date:</td>
                <td>' . $row['purchase_date'] . '</td>
            </tr>
           
            <tr>
                <td class="label">Assigned Location:</td>
                <td>' . $row['assigned_location'] . '</td>
            </tr>
            <tr>
                <td class="label">Status:</td>
                <td>' . $row['status'] . '</td>
            </tr>
            <tr>
                <td class="label">Unit ID:</td>
                <td>' . $row['unit'] . '</td>
            </tr>';
        }
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
