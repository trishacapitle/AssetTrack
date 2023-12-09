<?php
session_start();
include "config/db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST['uname'];
    $password = $_POST['password'];

    // Perform authentication and fetch user information with role details
    $sql = "SELECT id, user_name, password, role_id
            FROM users
            WHERE user_name = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            // Query failed, print the error for debugging purposes
            echo "Error: " . mysqli_error($conn);
            exit();
        }

        if ($user_data = mysqli_fetch_assoc($result)) {
            // Verify the password
            if (password_verify($password, $user_data['password'])) {
                // Password is correct
                // Check if the role_id is valid
                $allowed_roles = [1, 2, 3];
                if (in_array($user_data['role_id'], $allowed_roles)) {
                    // Store user information in the session
                    $_SESSION['user_id'] = $user_data['id'];
                    $_SESSION['user_name'] = $user_data['user_name'];
                    $_SESSION['role_id'] = $user_data['role_id'];

                    // Redirect to the dashboard or home page
                    header("Location: dashboard.php");
                    exit();
                } else {
                    // Invalid role_id
                    header("Location: login.php?error=Invalid role");
                    exit();
                }
            } else {
                // Password is incorrect
                header("Location: login.php?error=Invalid credentials");
                exit();
            }
        } else {
            // User not found
            header("Location: login.php?error=Invalid credentials");
            exit();
        }
    } else {
        // Error preparing statement
        echo "Error preparing statement: " . mysqli_error($conn);
        exit();
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/loginess.css">
</head>
<body>
  
  <div class="clogos-container">
            <img src="image/clogos.png" alt=" Logo" class="prime">
        </div>
    
     

    <div class="asset-container">
        <h2>Asset Track</h2>
    </div>

    <div class="welcome-container">
        <h3>Welcome to ULCS Asset Inventory System!</h3>
         </div>
<br>
        <div class="logo-container">
            <img src="image/logo111.png" alt="Asset Track Logo" class="logo">
        </div>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <form method="post" action="login.php">
            <input type="text" name="uname" placeholder="User Name">
            <input type="password" name="password" placeholder="Password">
             <div class="button-container">
            <button type="submit" class="login-button">Login</button>
          </div>
        </form>
    </div>
</body>
</html>
