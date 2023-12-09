<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>History Logs</h2>

    <table>
        <thead>
            <tr>
       
                <th>User Name</th>
                <th>Timestamp</th>
                <th>Success</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming you have a PHP script to fetch data from the login_audit table
            include "config/db_conn.php";

            $query = "SELECT * FROM login_audit ORDER BY timestamp DESC";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['timestamp'] . "</td>";
                echo "<td>" . ($row['success'] ? 'Logged in the System' : 'Logged Out') . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
