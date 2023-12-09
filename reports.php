<?php
include "auth.php";
include "getuserrole.php";
$isUserAdmin = isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1;
$isUserTechnician = isset($_SESSION['role_id']) && $_SESSION['role_id'] === 2;
$isUserGuest = isset($_SESSION['role_id']) && $_SESSION['role_id'] === 3;
// The rest of your page content goes here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reports</title>
    <link rel="stylesheet" href="css/assetreports.css">
      <link rel="stylesheet" href="css/sidebar.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.material.min.css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<body>
<!-- Modal -->
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
  


<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Report</h5>
               
            </div>
            <form action="reportedit.php" method="POST">
                <div class="modal-body">
                <select class="form-control" id="report_id" name="report_id">
        <option value="" selected disabled>Select Report ID</option>
        <?php
        // Replace the range with your actual asset IDs or modify as needed
        for ($i = 1; $i <= 10000; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>
                    <div class="mb-3">
                        <label for="report_name" class="form-label">Report Name</label>
                        <input type="text" class="form-control" id="report_name" name="report_name" placeholder="Enter new report name">
                    </div>
                    <div class="mb-3">
                        <label for="report_path" class="form-label">Report Path</label>
                        <input type="text" class="form-control" id="report_path" name="report_path" placeholder="Enter new report path">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancel-button">Cancel</button>
                    <button type="submit" name="reportdata" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              

            </div>
            <div class="modal-body">
                <div class="report_viewing">
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
                   <a href="reports.php" class="btn btn-secondary <?php echo $page == 'reports.php' ? 'active' : ''; ?>" id="Cancel-buttons">Cancel</a>

                <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
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
       <p class="font-weight-bold">Reports</p>
      </div>
    
      </header>
    </div>
 
    <div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                <h3 class="card-title">Reports</h3>
            </div>
        </div>
    </div>

        <table id="datatableid" class="table table-bordered"> <!-- Center the table horizontally -->
            <thead>
                <tr>
                    <th scope="col">Report ID</th>
                    <th scope="col">Report Name</th>
                    <th scope="col">Report Path</th>
                    <th scope="col">Generated Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table rows will be added dynamically based on data -->
                <?php
                require_once 'config/db_conn.php';
                require_once 'config/functions.php';

                $result = dispaly_data();
                $sql = "SELECT * FROM reports";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $report_id = $row['report_id'];
                        $report_name = $row['report_name'];
                        $report_path = $row['report_path'];
                        $generatedDate = $row['generated_date'];

                        echo '<tr>';
                        echo '<td>' . $report_id . '</td>';
                        echo '<td>' . $report_name . '</td>';
                        echo '<td>' . $report_path . '</td>';
                        echo '<td>' . $generatedDate . '</td>';
                        echo '<td>';
                        if($isUserAdmin){
                          echo '<button class="view-btn" data-asset-id="' . $report_id . '"><i class="fa fa-eye"></i></button>
                          <button class="edit-btn" data-asset-id="' . $report_id . '"><i class="fa fa-pencil"></i></button>
                          <button class="delete-btn" data-asset-id="' . $report_id . '"><i class="fa fa-trash"></i></button>';
                            }
                        echo '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
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
    $(document).ready(function () {
        $('#datatableid').DataTable({
            autoWidth: false, // Set autoWidth to true
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
    function closeModal() {
        // Assuming you're using Bootstrap, you can use jQuery to close the modal
        // If you're not using jQuery, you may need to use a different method to close the modal
        $('#viewModal').modal('hide');
    }
</script>
<script>
$(document).ready(function() {
  var currentPage; // Variable to store the current page number

  // Add a click event handler for the "Cancel" button
  $(document).on('click', '.view-btn', function(e) {
    e.preventDefault(); // Prevent the default link behavior

    // Store the current page number
    currentPage = $('#datatableid').DataTable().page.info().page;

    // Get the asset_id from the closest table row
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();
    console.log(data);

    // Send an AJAX request to view.php
    $.ajax({
      type: 'POST',
      url: 'reportview.php',
      data: {
        'checking_viewbtn': true,
        'report_id': data[0], // Assuming the asset_id is in the first column
      },
      success: function(response) {
        // Update the content of the asset_viewing div with the response
        $('.report_viewing').html(response);

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
    if ($.fn.DataTable.isDataTable('#datatableid')) {
      $('#datatableid').DataTable().destroy();
    }

    $('#datatableid').DataTable().page(currentPage).draw('page'); // Go back to the stored page
    
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
  $(document).ready(function() {
    $("#openModalButton").click(function () {
        // Show the modal by targeting its ID
        $("#myModal").modal("show");
    });
});
        // Edit Modal
        $(document).on('click', '.edit-btn', function () {
            $('#editmodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#report_id').val(data[0]);
            $('#report_name').val(data[1]);
            $('#report_path').val(data[2]);
    
        });

        // Cancel Edit Modal
        $('#cancel-button').click(function (e) {
            e.preventDefault(); // Prevent the default link behavior
            $('#editmodal').modal('hide'); // Close the modal
        });

        // Delete Modal
        $(document).on('click', '.delete-btn', function () {
            $('#deletemodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            // Get the value of report_id for delete
            var reportIdForDelete = data[0];

            // Confirm Delete
            $('#confirm-delete').off('click').on('click', function () {
                $.ajax({
                    type: 'POST',
                    url: 'deletereport.php',
                    data: { report_id: reportIdForDelete },
                    success: function (response) {
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
                    error: function () {
                        // Handle AJAX request error
                        $('#deletemodal').modal('hide');
                        $('#error-message').text('An error occurred while processing the request.');
                        $('#error-modal').modal('show');
                    }
                });
            });
        });

        // Cancel Delete Modal
        $('#Cancel-buttons').click(function (e) {
            e.preventDefault(); // Prevent the default link behavior
            $('#deletemodal').modal('hide'); // Close the modal
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
<<?php
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



  
 
