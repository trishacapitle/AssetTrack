<?php
session_start();
include "config/db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname) || empty($pass)) {
        header("Location: index.php?error=Username and password are required");
        exit();
    }

    $sql = "SELECT id, user_name, name, password, role_id
            FROM users
            WHERE user_name = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $uname);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            // Query failed, print the error for debugging purposes
            echo "Error: " . mysqli_error($conn);
            exit();
        }

        if ($row = mysqli_fetch_assoc($result)) {
            // Verify the password
            if (password_verify($pass, $row['password'])) {
                // Password is correct
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role_id'] = $row['role_id'];
                header("Location: dashboard.php");
            } else {
                // Incorrect username or password
                header("Location: index.php?error=Incorrect username or password");
            }
        } else {
            // Incorrect username or password
            header("Location: index.php?error=Incorrect username or password");
        }

        mysqli_stmt_close($stmt);

        // Insert login attempt into the audit trail
        $auditSql = "INSERT INTO login_audit (user_name, success) VALUES (?, ?)";
        $stmtAudit = mysqli_prepare($conn, $auditSql);

        if ($stmtAudit) {
            $successValue = isset($row) ? 1 : 0; // 1 if login success, 0 if failed
            mysqli_stmt_bind_param($stmtAudit, "si", $uname, $successValue);
            mysqli_stmt_execute($stmtAudit);
            mysqli_stmt_close($stmtAudit);
        } else {
            // Error preparing statement for audit trail
            echo "Error preparing statement for audit trail: " . mysqli_error($conn);
        }

    } else {
        // Error preparing statement
        echo "Error preparing statement: " . mysqli_error($conn);
    }

} else {
    header("Location: index.php");
    exit();
}
?>
