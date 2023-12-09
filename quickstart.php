<?php
include "auth.php";
include "getuserrole.php";
// The rest of your page content goes here
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QUICKSTART</title>
  <link rel="stylesheet" type="text/css" href="css/quickstart.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'> 
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
       <a href="checkinout.php" class="<?php echo $page == 'checkinout.php' ? 'active' : ''; ?>">
         <i class='bx bx-transfer' ></i>
         <span class="links_name">Check In/Check Out</span>
       </a>
       <span class="tooltip">Check In/Check Out</span>
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
       <p class="font-weight-bold">HELP & SUPPORT</p>
      </div>

  
    
      </header>
    </div>
      
        <!-- Main -->
      <main class="main-container">
      

        <div class="main-cards">

          
            
       <div class="card">
  <div class="card-inner">
    <ul>
<h4 style="font-weight: bold;">Setup:</h4>

      <li class="text-primary"> The initial setup process, including configuring database connections and user accounts</li>
  
    </ul>
  </div>
</div>

           

  <div class="card">
  <div class="card-inner">
    <ul>
      <h4 style="font-weight: bold;"> User Registration and Login: </h4>
      <li class="text-primary"> Users can create their accounts from the base admin account and log in to the system.</li>
      <li class="text-primary">Setting up user roles, especially for administrators.</li>
    </ul>
  </div>
</div>

<div class="card">
  <div class="card-inner">
    <ul>
      <h4 style="font-weight: bold;"> Adding Hardware Assets: </h4>
      <li class="text-primary"> Navigate to assets page via the sidebar navigation.</li>
      <li class="text-primary">Fill the required fields of asset details, such as make, model, serial number, etc.</li>
    </ul>
  </div>
</div>

<div class="card">
  <div class="card-inner">
    <ul>
      <h4 style="font-weight: bold;"> Tracking Asset Movements: </h4>
      <li class="text-primary"> Track asset movements when they are transferred between different locations or assigned to specific users.</li>
      <li class="text-primary">Users can update the asset location information.</li>
    </ul>
  </div>
</div>

<div class="card">
  <div class="card-inner">
    <ul>
      <h4 style="font-weight: bold;"> Generating Reports: </h4>
      <li class="text-primary"> Generate custom reports based on specific filters, such as location, asset type, or warranty status.</li>
      <li class="text-primary">Examples of different types of reports that can be generated.</li>
    </ul>
  </div>
</div>

<div class="card">
  <div class="card-inner">
    <ul>
      <h4 style="font-weight: bold;"> Check-In/Check-Out Process: </h4>
      <li class="text-primary">Use the check-in/check-out system to track temporary usage of assets by students or staff.</li>
    </ul>
  </div>
</div>

<div class="card">
  <div class="card-inner">
    <ul>
      <h4 style="font-weight: bold;"> Dashboard and Analytics: </h4>
      <li class="text-primary">An overview of the dashboard and how users can access real-time data and key performance indicators.</li>
      <li class="text-primary">Interprets the data and use analytics to make data-driven decisions.</li>
    </ul>
  </div>
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
</body>
</html>