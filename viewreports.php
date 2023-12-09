<?php
include 'config/db_conn.php';
session_start(); // Start the session

if (isset($_POST['checking_viewbtn'])) {
    $report_id = $_POST['report_id'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM assetreports WHERE report_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s",   $report_id);
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
        <td class="label">Report ID:</td>
        <td>' . $row['report_id'] . '</td>
    </tr>
            <tr>
                <td class="label">Asset ID:</td>
                <td>' . $row['asset_id'] . '</td>
            </tr>
            <tr>
                <td class="label">Report Item:</td>
                <td>' . $row['report_item'] . '</td>
            </tr>
            <tr>
                <td class="label">Location:</td>
                <td>' . $row['location'] . '</td>
            </tr>
            <tr>
            <td class="label">Status:</td>
            <td>' . $row['status'] . '</td>
  
         
            </tr>';
        echo '</table>';

    } else {
        echo 'No records found.';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>
