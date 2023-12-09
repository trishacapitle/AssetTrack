<?php
// reportview.php
include 'config/db_conn.php';
session_start();

if (isset($_POST['checking_viewbtn'])) {
    $report_id = $_POST['report_id'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM reports WHERE report_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $report_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo '<style>
            .asset-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                background-color: #f2f2f2;
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
                <td class="label">Report ID:</td>
                <td>' . $row['report_id'] . '</td>
            </tr>
            <tr>
                <td class="label">Report Name:</td>
                <td>' . $row['report_name'] . '</td>
            </tr>
            <tr>
                <td class="label">Report Path:</td>
                <td>' . $row['report_path'] . '</td>
            </tr>
            <tr>
                <td class="label">Generated Date:</td>
                <td>' . $row['generated_date'] . '</td>
            </tr>';
        }
        echo '</table>';

        // Log the successful viewing of report details
        logHistory("Viewed Report Details for Report ID: {$report_id}");
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
