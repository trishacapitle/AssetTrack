<?php
include 'config/db_conn.php';
session_start(); // Start the session

if (isset($_POST['checking_viewbtn'])) {
    $id = $_POST['user_id'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $id);
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
                <td class="label">User ID:</td>
                <td>' . $row['id'] . '</td>
            </tr>
            <tr>
                <td class="label">Name:</td>
                <td>' . $row['name'] . '</td>
            </tr>
            <tr>
                <td class="label">Username:</td>
                <td>' . $row['user_name'] . '</td>
            </tr>
            <tr>
                <td class="label">Password:</td>
                <td>' . $row['password'] . '</td>
            </tr>
            <tr>
                <td class="label">Email:</td>
                <td>' . $row['email'] . '</td>
            </tr>
            <tr>
                <td class="label">Role ID:</td>
                <td>' . $row['role_id'] . '</td>
            </tr>';
        }
        echo '</table>';

        // Log the successful viewing of user details
        logHistory("Viewed User Details for User ID: {$id}");
    } else {
        echo 'No records found.';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

// Function to log history
function logHistory($actionmade) {
    $logFile = 'user.log';
    $logactionmade = "[" . date('Y-m-d H:i:s') . "] " . $actionmade . PHP_EOL;
    file_put_contents($logFile, $logactionmade, FILE_APPEND | LOCK_EX);
}
?>
