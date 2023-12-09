<?php
include "auth.php";
include "getuserrole.php";
$isUserAdmin = isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1;
$isUserTechnician = isset($_SESSION['role_id']) && $_SESSION['role_id'] === 2;
$isUserGuest = isset($_SESSION['role_id']) && $_SESSION['role_id'] === 3;
// The rest of your page content goes here
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SETTINGS</title>
    <link rel="stylesheet" type="text/css" href="css/settingss.css">
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    <!-- Boxicons CDN Link -->
      <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-y3sA7t3siIc8XqFkwS8UVAn+8z4l98USYYeRv+1RyZ8t2hLOq0FzRTMG+8FIIJBY" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">

     <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
<!-- Bootstrap JavaScript and dependencies (Popper.js and jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-iIB+UaMS3fZa9cmwx6LOq5yiT8SY1xpzL/nUA7fFOj0qBRK8SxmRlJ12F6b3kgjW" crossorigin="anonymous"></script>

     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- You can add a close button here if needed -->
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <p>Are you sure you want to log out?</p>
            </div>
            <div class="modal-footer">
                <a href="logout.php" class="btn btn-primary">Yes, Log Out</a>
                <button type="button" class="btn btn-secondary" onclick="closeLogoutModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this record?</p>
            </div>
            <div class="modal-footer">
                   <a href="reports.php" class="btn btn-secondary <?php echo $page == 'reports.php' ? 'active' : ''; ?>" id="Cancel-buttons">Cancel</a>

                <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit User Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
            </div>
            <form action="useredit.php" method="POST">
                <div class="modal-body">
                    <!-- Add an input field to store the user ID for updating -->
                    <input type="hidden" name="id" id="id">
                      
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter new name">
                    </div>
                    <div class="mb-3">
                        <label for="user_name" class="form-label">Username</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter new username">
                    </div>
                    <div class="mb-3">
                        <label for="user_name" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Enter new password">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter new email">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role_id">
                            <!-- Change 'status' to 'role' for consistency -->
                            <option value="" disabled>Select an option</option>
                            <option value="1">Admin</option>
                            <option value="2">Technician</option>
                            <option value="3">Guest User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_data" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#manageuser">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Add view Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Details</h5>

            </div>
            <div class="modal-body">
                <div class="user_viewing">
                    <!-- Your modal body content goes here -->
                </div>
            </div>
          <div class="modal-footer">
    <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
</div>
        </div>
    </div>
</div>
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="success-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                </button>
            </div>
            <div class="modal-body">
              <p id="success-message"></p>
            </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="okModal()">Ok</button>

            </div>
        </div>
    </div>
</div>
    

<!-- Error Modal -->
<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="error-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="error-modal-label">Error</h5>
                </button>
            </div>
            <div class="modal-body">
                <p id="error-message"></p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            </div>
            <form action="userupdate.php" method="POST" id="addUserForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user" class="form-label">User ID</label>
                        <select class="form-control" id="user" name="user">
                            <option value="" selected disabled>Select User ID</option>
                            <?php
                            for ($i = 1; $i <= 10000; $i++) { // Change the range as needed
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter new name">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter new username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Enter new password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword1" name="confirmPassword1" placeholder="Re-enter new password" required>
                        <small id="passwordHelp1" class="form-text error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter new email">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role"> <!-- Change 'status' to 'role' for consistency -->
                            <option value="" disabled>Select an option</option>
                            <option value="1">Admin</option>
                            <option value="2">Technician</option>
                            <option value="3">Guest User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" name="updatedata" class="btn btn-primary" id="saveChangesBtn">Done</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#manageuser">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Manage Users Modal -->
<div class="modal fade" id="manageuser" tabindex="-1" aria-labelledby="settings" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="settings">Manage Users</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="text-left" style="margin-left: 20px; margin-top: 10px">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addmodal">
                    Add User
                </button>
            </div>
            <div class="modal-body">
<!-- Table for displaying users -->
<table class="table" id="userDataTable">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="usersTableBody">
    <?php
require_once 'config/db_conn.php';
require_once 'config/functions.php';

$result = dispaly_data(); // Assuming display_data() is correct
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $UserID = $row['id'];
        $Name = $row['name'];
        $Username = $row['user_name'];
        // Display a fixed string for the password
        $Password = '********';
        $Email = $row['email'];
        $RoleID = $row['role_id'];

        // Fetch role_name from roles table based on role_id
        $roleSql = "SELECT role_name FROM roles WHERE role_id = ?";
        $stmtRole = $conn->prepare($roleSql);
        $stmtRole->bind_param("i", $RoleID);
        $stmtRole->execute();
        $stmtRole->bind_result($RoleName);
        $stmtRole->fetch();
        $stmtRole->close();

        echo '<tr>';
        echo '<td class="user_id">' . $UserID . '</td>';
        echo '<td>' . $Name . '</td>';
        echo '<td>' . $Username . '</td>';
        echo '<td>' . $Password . '</td>';
        echo '<td>' . $Email . '</td>';
        echo '<td>' . $RoleName . '</td>'; // Display role_name instead of role_id
        echo '<td>';
        echo '<button class="view-btn" data-asset-id="' . $UserID . '" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="fa fa-eye"></i></button>
              <button class="edit-btn" data-asset-id="' . $UserID . '"data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i></button>
              <button class="delete-btn" data-asset-id="' . $UserID . '"data-bs-toggle="modal" data-bs-target="#manageuser"><i class="fa fa-trash"></i></button>';
        echo '</td>';
        echo '</tr>';
    }
}
?>

    </tbody>
</table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changepw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            </div>
            <form action="update_password.php" method="POST" id="changepwForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User ID</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            <?php
                            for ($i = 1; $i <= 10000; $i++) {
                                // Check if the current iteration is the logged-in user
                                $selected = ($_SESSION['user_id'] == $i) ? 'selected' : '';
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="oldPassword" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter old password" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Re-enter new password" required>
                        <small id="passwordHelp2" class="form-text error"></small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_password" class="btn btn-primary" id="saveChangesBtn">Save Password</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="actlogModal" tabindex="-1" aria-labelledby="actlogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actlogModalLabel">History Logs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>UserName</th>
                            <th>Timestamp</th>
                            <th>Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include the database connection
                        include "config/db_conn.php";

                        // Check for a successful connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Perform the query
                        $query = "SELECT * FROM login_audit ORDER BY timestamp DESC";
                        $result = mysqli_query($conn, $query);

                        // Check for a successful query
                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        // Fetch and display the data
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['user_name'] . "</td>";
                            echo "<td>" . $row['timestamp'] . "</td>";
                            echo "<td>" . ($row['success'] ? 'Logged in the System' : 'Logged Out') . "</td>";
                            echo "</tr>";
                        }

                        // Close the database connection
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="sidebar">
  <div class="logo-details">
    <div>
        <div class="logo_name">AssetTrack<br><span class="role"><?= getUserRole(); ?></span></div>

    </div>
    <i class='bx bx-menu' id="btn"></i>
</div>
    <ul class="nav-list">
      <li>
      <a href="dashboard.php" class="<?php echo $page == 'dashboard.php' ? 'active' : ''; ?>">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li>
       <a href="Hardwareassets.php" class="<?php echo $page == 'Hardwareassets.php' ? 'active' : ''; ?>">
         <i class='bx bx-building' ></i>
         <span class="links_name">Assets</span>

       </a>
         <ul class="submenu">
    <li>
      <a href="assetlogs.php" class="<?php echo $page == 'assetlogs.php' ? 'active' : ''; ?>">
        <span class="links_name">Asset Logs</span>
             <span class="tooltip">Assets</span>
        
      </a>
    </li>
    <li>
      <a href="assetmovement.php" class="<?php echo $page == 'assetmovement.php' ? 'active' : ''; ?>">
        <span class="links_name">Asset Movement</span>
         
      </a>
    </li>
  </ul>
  </li>
   

     <li>
       <a href="maintenance.php" class="<?php echo $page == 'maintenance.php' ? 'active' : ''; ?>">
         <i class='bx bx-wrench' ></i>
         <span class="links_name">Maintenance</span>
       </a>
       <span class="tooltip">Maintenance</span>
     </li>
      <li>

    <a href="" class="<?php echo $page == '' ? 'active' : ''; ?>">
      <i class='bx bx-transfer'></i>
      <span class="links_name">Check In/Check Out</span>

 
    </a>


  <!-- Submenu -->
  <ul class="submenu">
    <li>
      <a href="checkinout.php" class="<?php echo $page == 'checkinout.php' ? 'active' : ''; ?>">
        <span class="links_name">Check In</span>
         <span class="tooltip">Check In/Check Out</span>
        
      </a>
    </li>
    <li>
      <a href="checkout.php" class="<?php echo $page == 'checkout.php' ? 'active' : ''; ?>">
        <span class="links_name">Check Out</span>
         
      </a>
    </li>
  </ul>
  </li>
     <li>
       <a href="reports.php" class="<?php echo $page == 'reports.php' ? 'active' : ''; ?>">
         <i class='bx bx-file' ></i>
         <span class="links_name">Reports</span>
       </a>
       <span class="tooltip">Reports</span>
     </li>
     <li>
       <a href="backnres.php" class="<?php echo $page == 'backnres.php' ? 'active' : ''; ?>">
         <i class='bx bx-cloud-upload' ></i>
         <span class="links_name">Backup & Restore</span>
       </a>
       <span class="tooltip">Backup & Restore</span>
     </li>
     <li>
       <a href="settings.php" class="<?php echo $page == 'settings.php' ? 'active' : ''; ?>">
         <i class='bx bx-cog' ></i>
         <span class="links_name">Settings</span>
       </a>
       <span class="tooltip">Settings</span>
     </li>  
     <li>
       <a href="quickstart.php" class="<?php echo $page == 'quickstart.php' ? 'active' : ''; ?>">
         <i class='bx bx-help-circle' ></i>
         <span class="links_name">Help & Support</span>
       </a>
       <span class="tooltip">Help & Support</span>
     </li>
     <li class="profile">
         <div class="profile-details">
        <a href="dashboard.php">
      <img src="image/logo1.png" class="<?= $page == 'dashboard.php' ? 'active' : ''; ?>" alt="logo1Img">
    </a>
         </div>
       <a href="#" class="<?php echo $page == 'logout.php' ? 'active' : ''; ?>" onclick="openLogoutModal()">
    <i class='bx bx-log-out' id="log_out"></i>
  </a>
     </li>
    </ul>
  </div>

<section class="home-section">
<header class="header">
  <div class="header-left">
  <main class="title-container">
  <div class="main-title">
  <p class="font-weight-bold">SETTINGS</p>
  </div> 
</header>
<div class="row">
<div class="main-cards">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Manage Users (Admin)</h5>
            <p class="card-text">Add new user accounts to the system. Edit your name, username, email, and role.</p>
            <?php
            if($isUserAdmin){
                echo'
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#manageuser">
                Manage
            </button>';
            }
            ?>
        </div>
    </div>
</div>
<div class="main-cards">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Log In Activity(Admin)</h5>
            <p class="card-text">View lists of log in activities on the system.</p>
            <?php
            if($isUserAdmin){
                echo'
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actlogModal">
                View Logs
            </button>';
        }
        ?>
        </div>
    </div>
</div>
  <div class="main-cards">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Change Account Password</h5>
            <p class="card-text">Change your account password for improved security.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changepw">
                Change
            </button>
        </div>
    </div>
</div>




<!-- Bootstrap Modal -->


    </div>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.material.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
        $(document).ready(function() {
            $('#userDataTable').DataTable({
                autoWidth: false,
                columnDefs: [
                    {
                        targets: ['_all'],
                        className: 'mdc-data-table__cell',
                    },
                ],
            });
        });
  
    </script>
<script>
    // Function to open the logout modal
    function openLogoutModal() {
        $('#logoutModal').modal('show');
    }

    // Function to close the logout modal
    function closeLogoutModal() {
        $('#logoutModal').modal('hide');
    }
</script>
<script>
    function closeModal() {
        // Assuming you're using Bootstrap, you can use jQuery to close the modal
        // If you're not using jQuery, you may need to use a different method to close the modal
        $('#viewModal').modal('hide');
    }
</script>
<script>
  $(document).ready(function() {
    $(document).on('click', '.view-btn', function(e) {
      e.preventDefault(); 

      // Get the user_id from the data attribute of the closest table row
      var user_id = $(this).closest('tr').find('.user_id').text().trim();

      // Check if user_id is not empty
      if (user_id !== "") {
        // Send an AJAX request to view.php
        $.ajax({
          type: 'POST',
          url: 'userview.php',
          data: {
            'checking_viewbtn': true,
            'user_id': user_id,
          },
          success: function(response) {
            // Update the content of the asset_viewing div with the response
            $('.user_viewing').html(response);

            // Show the viewModal
            $('#viewModal').modal('show');
          },
          error: function(error) {
            // Handle any errors here
            console.error('Error:', error);
          }
        });
      } else {
        console.error('User ID is empty.');
      }
    });
  });
</script>

<!-- Add this script at the end of your HTML, just before the </body> tag -->
<script>
    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function () {
        // Find the modal element by its ID
        var myModal = new bootstrap.Modal(document.getElementById('manageuser'));

        // Get the button that opens the modal
        var openModalBtn = document.getElementById('openModalBtn');

        // Get the button that closes the modal
        var closeModalBtn = document.getElementById('closeModalBtn');

        // Add a click event listener to open the modal
        openModalBtn.addEventListener('click', function () {
            myModal.show();
        });

        // Add a click event listener to close the modal
        closeModalBtn.addEventListener('click', function () {
            myModal.hide();
        });
    });
</script>





<script>
    $(document).ready(function() {
        // Add a click event handler for the "Cancel" button
        $('#cancel-button').click(function(e) {
            e.preventDefault(); // Prevent the default link behavior
            $('#editmodal').modal('hide'); // Close the modal
        });

        var currentPage; // Variable to store the current page number

        // Add a click event handler for the "Edit" button
        $(document).on('click', '.edit-btn', function() {
            // Store the current page number
            currentPage = $('#userDataTable').DataTable().page.info().page;

            $('#editmodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);

            // Populate the form fields with the data
            $('#id').val(data[0]);
            $('#name').val(data[1]);
            $('#user_name').val(data[2]);
            $('#password').val(data[3]);
            $('#email').val(data[4]);
            $('#role_id').val(data[5]);
        });

        // Event handler for when the edit modal is closed
        $('#editmodal').on('hidden.bs.modal', function() {
            // Reinitialize DataTables for the dynamically loaded content
            if ($.fn.DataTable.isDataTable('#userDataTable')) {
                $('#userDataTable').DataTable().destroy();
            }

            $('#userDataTable').DataTable().page(currentPage).draw('page'); // Go back to the stored page
        });

        // Add a click event handler for the "Cancel" button
        $('#Cancel-buttons').click(function(e) {
            e.preventDefault(); // Prevent the default link behavior
            $('#deletemodal').modal('hide'); // Close the modal
        });

        $(document).on('click', '.delete-btn', function() {
            $('#deletemodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            // Get the value of asset_id for delete
            var idForDelete = data[0];

            $('#confirm-delete').off('click').on('click', function() {
                $.ajax({
                    type: 'POST',
                    url: 'deleteuser.php',
                    data: { id: idForDelete },
                    success: function(response) {
                        // Handle the success response here
                        $('#deletemodal').modal('hide');
                        var responseData = JSON.parse(response); // Parse JSON response

                        if (responseData.status === 'success') {
                            // If the deletion was successful, show success modal
                            $('#success-message').text('Record deleted successfully');
                            $('#success-modal').modal('show');
                            $tr.remove(); // Remove the row from the table
                        } else {
                            // If the deletion failed, show error modal
                            $('#error-message').text('Failed to delete record');
                            $('#error-modal').modal('show');
                        }
                    },
                    error: function() {
                        // Handle AJAX request error
                        $('#deletemodal').modal('hide');
                        $('#error-message').text('An error occurred while processing the request.');
                        $('#error-modal').modal('show');
                    }
                });
            });
        });
    });
</script>
<script>
    function okModal() {
        // Assuming you're using Bootstrap, you can use jQuery to close the modal
        // If you're not using jQuery, you may need to use a different method to close the modal
        $('#success-modal').modal('hide');
    }
</script>

<!-- Include this script in your settings.php file -->
<!-- Include this script in your HTML file, after including jQuery and Bootstrap scripts -->

<script>
    $(document).ready(function () {
        // Add a change event handler for the password confirmation field
        $('#confirmNewPassword').on('input', function () {
            validatePasswordMatch();
        });

        // Function to validate password match
        function validatePasswordMatch() {
            var newPassword = $('#newPassword').val();
            var confirmNewPassword = $('#confirmNewPassword').val();

            // Check if the passwords match
            if (newPassword === confirmNewPassword) {
                $('#passwordHelp2').html('Passwords match').css('color', 'green');
            } else {
                $('#passwordHelp2').html('Passwords do not match').css('color', 'red');
            }
        }

        // Form submission event handler
        $('#changepwForm').submit(function (event) {
            // Validate passwords before submitting the form
            validatePasswordMatch();

            // Check if passwords match before proceeding with form submission
            var newPassword = $('#newPassword').val();
            var confirmNewPassword = $('#confirmNewPassword').val();

            if (newPassword !== confirmNewPassword) {
                // Prevent the form submission if passwords don't match
                event.preventDefault();
            }
        });
    });
</script>

<script>
$(document).ready(function() {
    // Add a change event handler for the password confirmation field
    $('#confirmPassword1').on('input', function() {
        validatePasswordMatch();
    });

    // Function to validate password match
    function validatePasswordMatch() {
        var password = $('#password1').val();
        var confirmPassword = $('#confirmPassword1').val();

        // Check if the passwords match
        if (password === confirmPassword) {
            $('#passwordHelp1').html('Passwords match').css('color', 'green');
        } else {
            $('#passwordHelp1').html('Passwords do not match').css('color', 'red');
        }
    }

    // Form submission event handler
    $('#addUserForm').submit(function(event) {
        // Validate passwords before submitting the form
        validatePasswordMatch();

        // Check if passwords match before proceeding with form submission
        var password = $('#password1').val();
        var confirmPassword = $('#confirmPassword1').val();

        if (password !== confirmPassword) {
            // Prevent the form submission if passwords don't match
            event.preventDefault();
        }
    });
});
</script>


  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });


  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }
  </script>




<?php
if(isset($_SESSION['status']) && $_SESSION['status'] != '')
{
    ?>
<script>
swal({
  title: "<?php echo $_SESSION['status']; ?>",
  //text: "Data Inserted!",
  icon: "<?php echo $_SESSION['status_code']; ?>",
  button: "Ok!",
});
</script>
<?php
unset($_SESSION['status']); // Corrected syntax
}
?>

</body>
</html>


                           <?php
    
