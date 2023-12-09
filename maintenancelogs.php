<?php
$page = ''; // Default value, change accordingly based on your logic
include "auth.php";
include "getuserrole.php";
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>ASSET LOGS</title>
    <link rel="stylesheet" type="text/css" href="css/historys.css">
        <link rel="stylesheet" type="text/css" href="css/sidebars1.css">
    <!-- Boxicons CDN Link -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.material.min.css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

 

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
    <h2>Asset Logs</h2>

    <!-- Search and Clear All Form -->
   



    <table>
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>History ID</th>
                <th>Asset ID</th>
                <th>Description</th>
                <th>Action Made</th>
            </tr>
        </thead>
        <tbody>

    <?php
    // Read history log file if it exists
    $logFile = 'maintenance.log';

    if (file_exists($logFile)) {
        $logContent = file_get_contents($logFile);

        // Split log content into array by newline
        $logLines = explode(PHP_EOL, $logContent);

        // Filter logs based on asset ID search query
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $filteredLogs = [];

        foreach ($logLines as $logLine) {
            // Split each log entry into timestamp and message
            $logEntryParts = explode("] ", $logLine, 2);

            // Check if both timestamp and message exist
            if (count($logEntryParts) == 2) {
                list($timestamp, $actionmade) = $logEntryParts;
                $timestamp = trim($timestamp, "[]");

                // Extract asset ID from the message if it exists
                preg_match("/Asset ID: (\w+)/", $actionmade, $matches);
                $assetID = isset($matches[1]) ? $matches[1] : '';

                // Check if the asset ID matches the search query
                if (stripos($assetID, $searchQuery) !== false) {
                    $filteredLogs[] = compact('timestamp', 'assetID', 'actionmade');
                }
            }
        }

        // Display logs in reverse order (most recent first)
        foreach (array_reverse($filteredLogs) as $log) {
            echo "<tr>";
            echo "<td>{$log['timestamp']}</td>";
            echo "<td>{$log['assetID']}</td>";
            echo "<td>{$log['actionmade']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No history logs found</td></tr>";
    }
    ?>
<style>


    .clearcontainer form {
        display: none;
  
    }

    .clearcontainer input[type="submit"] {
        padding: 5px 10px; /* Adjust the padding as needed */
        font-size: 12px; /* Adjust the font size as needed */
        background-color: red;
    }
</style>


<form method="get" action="">
    <label for="search">Search Asset ID:</label>
    <input type="text" name="search" id="search" value="<?= htmlentities($searchQuery) ?>">
    <input type="submit" value="Search">
</form>
 <div class="clearcontainer">
    <form method="post" action="clear_history.php">
        <input type="submit" name="clear_history" value="Clear All">
    </form>
</div>

        </tbody>
    </table>
</section>

  
 
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.material.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

     <script>
    function closeModal() {
        // Assuming you're using Bootstrap, you can use jQuery to close the modal
        // If you're not using jQuery, you may need to use a different method to close the modal
        $('#viewModal').modal('hide');
    }
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



</body>
</html>
