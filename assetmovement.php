<?php
include "auth.php";
include "getuserrole.php";
// The rest of your page content goes here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sidebars1.css">
    <link rel="stylesheet" href="css/assetmoves.css">
    <title>Assets Movements Table</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.material.min.css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- Add DataTables CSS and JS -->
  
 
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.material.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>


  <!-- Modal -->

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Asset Movement</h5>
                       
                   
                    </div>
                    <div class="modal-body">
                        <!-- Add your form for adding new entries here -->
                        <form id="addAssetMovementForm">
                            <div class="mb-3">
                                <label for="asset_id" class="form-label">Asset ID:</label>
                                <input type="text" class="form-control" id="assetId" name="asset_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="previous_location" class="form-label">Previous Location:</label>
                                <input type="text" class="form-control" id="previous_location" name="previous_location" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_location" class="form-label">New Location:</label>
                                <input type="text" class="form-control" id="new_location" name="new_location" required>
                            </div>
                            <div class="mb-3">
                                <label for="movement_date" class="form-label">Movement Date:</label>
                                <input type="date" class="form-control" id="movement_date" name="movement_date" required>
                            </div>
                         
      </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                   <button type="submit" name="updatedata" class="btn btn-primary">Save Data</button>
                </div>
            </form>
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
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              

            </div>
            <div class="modal-body">
                <div class="asset_viewing">
                    <!-- Your modal body content goes here -->
                </div>
            </div>
          <div class="modal-footer">
    <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
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
                   <a href="Hardwareassets.php" class="btn btn-secondary <?php echo $page == 'Hardwareassets.php' ? 'active' : ''; ?>" id="Cancel-buttons">Cancel</a>

                <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
            </div>
        </div>
    </div>
</div>
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
  
        <div class="main-title">
          <p class="font-weight-bold">ASSET MOVEMENT</p>
        </div>
      </main>
    </div>
     </header>

     
  
   
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                                <h2 class="card-title">Asset Movement</h2>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
             
            </div>
           <table class="asset-table" id="assetMovementsTable">
    <thead>
        <tr>
            <th>Asset ID</th>
            <th>Previous Location</th>
            <th>New Location</th>
            <th>Movement Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="assetMovementsBody">
<?php
require_once 'config/db_conn.php';
require_once 'config/functions.php';

$result = dispaly_data(); // Corrected the function name
$sql = "SELECT * FROM assetsmovements";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $AssetID = $row['asset_id'];
        $PreviousLocation = $row['previous_location'];
        $NewLocation = $row['new_location'];
        $MovementDate = $row['movement_date'];

        // Assuming you have variables for new location and movement date
        echo '<tr>';
        echo '<td>' . $AssetID . '</td>';
        echo '<td>' . $PreviousLocation . '</td>';
        echo '<td>' . $NewLocation . '</td>';
        echo '<td>' . $MovementDate . '</td>';
        
        // Place the buttons in a new cell
        echo '<td>';
        echo '<button class="view-btn" data-asset-id="' . $AssetID . '"><i class="fa fa-eye"></i></button>';
        ///echo  '<button class="delete-btn" data-asset-id="' . $AssetID . '"><i class="fa fa-trash"></i></button>';
        echo '</td>';

        echo '</tr>';
    }
}
?>


       
   
    </tbody>
</table>

      
   <script>
    $(document).ready(function() {
        // Initialize DataTables on the table
        $('#assetMovementsTable').DataTable();

        // Fetch asset movements and update the table
        fetchAssetMovements();

        // Optional: Show the modal when a button with ID 'openModalButton' is clicked
        $("#openModalButton").click(function() {
            // Show the modal by targeting its ID
            $("#myModal").modal("show");
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
  <script>
  $(document).ready(function() {
    $(document).on('click', '.delete-btn', function() {
        // Show the delete confirmation modal
        $('#deletemodal').modal('show');
        
        // Get the closest row to the clicked button
        $tr = $(this).closest('tr');
        
        // Get the values from the row (assuming the first column is the Asset ID)
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        // Get the value of asset_id for delete
        var assetIdForDelete = data[0];

        // Handle the click event on the confirm-delete button within the delete confirmation modal
        $('#confirm-delete').off('click').on('click', function() {
            $.ajax({
                type: 'POST',
                url: 'delete_assets.php',
                data: { asset_id: assetIdForDelete },
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
$(document).ready(function() {
  var currentPage; // Variable to store the current page number

  // Add a click event handler for the "Cancel" button
  $(document).on('click', '.view-btn', function(e) {
    e.preventDefault(); // Prevent the default link behavior

    // Store the current page number
    currentPage = $('#assetMovementsTable').DataTable().page.info().page;

    // Get the asset_id from the closest table row
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();
    console.log(data);

    // Send an AJAX request to view.php
    $.ajax({
      type: 'POST',
      url: 'viewmovement.php',
      data: {
        'checking_viewbtn': true,
        'asset_id': data[0], // Assuming the asset_id is in the first column
      },
      success: function(response) {
        // Update the content of the asset_viewing div with the response
        $('.asset_viewing').html(response);

        // Show the viewModal
        $('#viewModal').modal('show');
      },
      error: function(error) {
        // Handle any errors here
        console.error('Error:', error);
      }
    });
  });

  // Event handler for when the modal is closed
  $('#viewModal').on('hidden.bs.modal', function () {
    // Reinitialize DataTables for the dynamically loaded content
    if ($.fn.DataTable.isDataTable('#assetMovementsTable')) {
      $('#assetMovementsTable').DataTable().destroy();
    }

    $('#assetMovementsTable').DataTable().page(currentPage).draw('page'); // Go back to the stored page
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
    // Document ready function for general setup
    $(document).ready(function() {
        // Add a click event handler for the "Cancel" button
        $('#Cancel-buttons').click(function(e) {
            e.preventDefault(); // Prevent the default link behavior
            $('#deletemodal').modal('hide'); // Close the modal
        });
    });

    // closeModal function to close the viewModal
    function closeModal() {
        // Assuming you're using Bootstrap, you can use jQuery to close the modal
        // If you're not using jQuery, you may need to use a different method to close the modal
        $('#viewModal').modal('hide');
    }
</script>
<script>
    function okModal() {
        // Assuming you're using Bootstrap, you can use jQuery to close the modal
        // If you're not using jQuery, you may need to use a different method to close the modal
        $('#success-modal').modal('hide');
    }
</script>
</body>
</html>
