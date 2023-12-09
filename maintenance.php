<?php
include "auth.php";
include "getuserrole.php";
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>MAINTENANCE</title>
    <link rel="stylesheet" type="text/css" href="css/maintenancetask.css">
    <link rel="stylesheet" href="css/sidebars1.css">
    <link rel="stylesheet" href="css/modal.css">
    <!-- Boxicons CDN Link -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.material.min.css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
                   <a href="maintenance.php" class="btn btn-secondary <?php echo $page == 'maintenance.php' ? 'active' : ''; ?>" id="Cancel-buttons">Cancel</a>

                <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Success Modal -->
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
    
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Maintenance Task</h5>
                    
                    </button>
                </div>
                <form action="maintenanceedit.php" method="POST">

                <div class="modal-body">
               
                <div class="mb-3">
                        <label for="task_id" class="form-label">Task ID</label>
                        <select class="form-control" id="task_id" name="task_id">
    <option value="" selected disabled>Select Task ID</option>
    <?php
    for ($i = 1; $i <= 10000; $i++) { // Change the range as needed
        echo "<option value='$i'>$i</option>";
    }
    ?>
</select>

                    </div>
                    <div class="mb-3">
    <label for="asset_id" class="form-label">Asset ID</label>
    <select class="form-control" id="asset_id" name="asset_id">
        <option value="" selected disabled>Select Asset ID</option>
        <?php
        // Replace the range with your actual asset IDs or modify as needed
        for ($i = 1; $i <= 10000; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>
</div>

                    <div class="mb-3">
                        <label for="task_type" class="form-label">Task Type</label>
                            <select name="task_type">
                            <option value=""disabled>Select an option</option>
       <option value="Repair">Repair</option>
        <option value="Maintenance">Maintenance</option>
        <option value="Software Update">Software Update</option>
                   
    </select>
                    </div>
                 
               
                          <div class="mb-3">
                        <label for="task_description" class="form-label">Task Description</label>
              <input type="text" class="form-control" id="task_description" name="task_description" placeholder="Enter Description">
                </div>
                <div class="mb-3">
                        <label for="task_date" class="form-label">Task Date</label>
               <input type="date" class="form-control" id="task_date" name="task_date">
                </div>
                 </div>
                    
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancel-button">Cancel</button>
                    <button  type="submit"name="checkin" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
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
       <p class="font-weight-bold">Maintenance</p>
      </div>
      </header>
    </div>
     
    
    
    <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                                <h2 class="card-title">Maintenance Task</h2>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
             
            </div>

            <button id="print-button">
    <i class="material-icons">print</i> Print
</button>


            <table class="table table-bordered" id="maintenanceTasksTable">
  <thead>
    <tr>
    <th scope="col">Task ID</th>
    <th scope="col">Asset ID</th>
    <th scope="col">Task Type</th>
    <th scope="col">Task Description</th>
    <th scope="col">Task Date</th>
    <th scope="col">Actions</th>

    </tr>
  </thead>
  <tbody>
    <?php
    require_once 'config/db_conn.php';
    require_once 'config/functions.php';

    $result = dispaly_data(); // Corrected the function name
    $sql = "SELECT * FROM maintenancetasks";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $TaskID = $row['task_id'];
        $AssetID = $row['asset_id'];
        $TaskType = $row['task_type'];
        $TaskDescription = $row['task_description'];
        $TaskDate = $row['task_date'];

        // Assuming you have variables for new location and movement date
        echo '<tr>';
        echo '<td>' . $TaskID . '</td>';
        echo '<td>' . $AssetID . '</td>';
        echo '<td>' . $TaskType . '</td>';
        echo '<td>' . $TaskDescription . '</td>';
        echo '<td>' . $TaskDate . '</td>';
        // Place the buttons in a new cell
        echo '<td>';
        if($isUserAdmin && $isUserTechnician){
          echo '<button class="view-btn" data-asset-id="' . $AssetID . '"><i class="fa fa-eye"></i></button>
          <button class="edit-btn" data-asset-id="' . $AssetID . '"><i class="fa fa-pencil"></i></button>
          <button class="delete-btn" data-asset-id="' . $AssetID . '"><i class="fa fa-trash"></i></button>';
            }

        echo '</tr>';
      }
    }
    
    ?>
    
  </tbody>
</table>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.material.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>


<script>
    // Replace 'your_asset_id' with the actual variable or value you want to display as the asset ID
    document.getElementById('task_id').value = 'task';
</script>
<script>
document.getElementById("print-button").addEventListener("click", function () {
    // Step 1: Get file name from the user
    var fileName = prompt("Enter the file name:");

    // Step 2: Set default file path to "D:/Downloads" if the user doesn't provide one
    var filePath = prompt("Choose the file path:") || "D:/Downloads";

    // Create a copy of the table for printing
    var tableToPrint = document.getElementById("maintenanceTasksTable").cloneNode(true);

    // Remove the "Actions" column from the copied table
    var actionsColumn = tableToPrint.querySelectorAll("th:nth-child(10), td:nth-child(10)");

    actionsColumn.forEach(function (element) {
        element.remove();
    });

    // Remove the serial number and purchase date columns from the copied table
    var serialNumberColumn = tableToPrint.querySelectorAll("th:nth-child(5), td:nth-child(5)");
    var purchaseDateColumn = tableToPrint.querySelectorAll("th:nth-child(6), td:nth-child(6)");

    serialNumberColumn.forEach(function (element) {
        element.remove();
    });

    purchaseDateColumn.forEach(function (element) {
        element.remove();
    });

    // Create a new window for printing
    var printWindow = window.open("", "", "width=800, height=600");
    printWindow.document.open();

    // Add custom CSS for printing
    printWindow.document.write("<html><head><title>Print</title>");
    printWindow.document.write("<style>");
    printWindow.document.write("body { font-family: 'Arial', sans-serif; margin: 20px; }");
    printWindow.document.write("h1 { font-size: 24px; text-align: center; margin-bottom: 20px; }");
    printWindow.document.write("table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }");
    printWindow.document.write("th, td { border: 1px solid #000; padding: 8px; text-align: center; }");
    printWindow.document.write("</style>");
    printWindow.document.write("</head><body>");

    // Append the modified table to the new window
    printWindow.document.write("<h1>Maintenance Report</h1>");
    printWindow.document.write(tableToPrint.outerHTML);

    printWindow.document.write("</body></html>");
    printWindow.document.close();

    // Step 3: Generate a unique report ID (auto-incremented)

    // Step 4: Log the print operation to the reports table
    logPrintOperation(fileName, filePath, getCurrentDateTime());

    // Step 5: Download the file as PDF
    downloadFileAsPDF(tableToPrint.outerHTML, fileName);
});

// Function to log the print operation
function logPrintOperation(fileName, filePath, generatedDateTime) {
    // Use AJAX to send a request to the server to log the print operation
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "log-print.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Log successful
            console.log("Print operation logged successfully.");
        }
    };
    xhr.send("fileName=" + fileName + "&filePath=" + filePath + "&generatedDateTime=" + generatedDateTime);
}

// Function to download the file as PDF using html2pdf
function downloadFileAsPDF(content, fileName) {
    var element = document.createElement("div");
    element.innerHTML = content;

    html2pdf(element, {
        margin: 10,
        filename: fileName,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: [330.2, 215.9], orientation: 'landscape' } // Set orientation to 'landscape'
    }).then(function (pdf) {
        // Download the PDF
        pdf.save(fileName + ".pdf");
    });
}

// Function to get the current date and time in the format YYYY-MM-DD HH:MM:SS
function getCurrentDateTime() {
    var today = new Date();
    var year = today.getFullYear();
    var month = ("0" + (today.getMonth() + 1)).slice(-2);
    var day = ("0" + today.getDate()).slice(-2);
    var hours = ("0" + today.getHours()).slice(-2);
    var minutes = ("0" + today.getMinutes()).slice(-2);
    var seconds = ("0" + today.getSeconds()).slice(-2);

    return year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
}
</script>

<script>
$(document).ready(function() {
  var currentPage; // Variable to store the current page number

  // Add a click event handler for the "Cancel" button
  $(document).on('click', '.view-btn', function(e) {
    e.preventDefault(); // Prevent the default link behavior

    // Store the current page number
    currentPage = $('#maintenanceTasksTable').DataTable().page.info().page;

    // Get the asset_id from the closest table row
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();
    console.log(data);

    // Send an AJAX request to view.php
    $.ajax({
      type: 'POST',
      url: 'viewmaintenance.php',
      data: {
        'checking_viewbtn': true,
        'task_id': data[0], // Assuming the asset_id is in the first column
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
    if ($.fn.DataTable.isDataTable('#maintenanceTasksTable')) {
      $('#maintenanceTasksTable').DataTable().destroy();
    }

    $('#maintenanceTasksTable').DataTable().page(currentPage).draw('page'); // Go back to the stored page
  });
});

</script>
<script>
    $(document).ready(function() {
        $("#openModalButton").click(function () {
            // Show the modal by targeting its ID
            $("#myModal").modal("show");
        });
           $(document).ready(function() {
    // Add a click event handler for the "Cancel" button
    $('#cancel-button').click(function(e) {
        e.preventDefault(); // Prevent the default link behavior
        $('#editmodal').modal('hide'); // Close the modal
    });
});


        $(document).ready(function() {
  var currentPage; // Variable to store the current page number

  // Add a click event handler for the "Edit" button
  $(document).on('click', '.edit-btn', function() {
    // Store the current page number
    currentPage = $('#maintenanceTasksTable').DataTable().page.info().page;

    $('#editmodal').modal('show');
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    console.log(data);

    // Populate the form fields with the data
    $('#task_id').val(data[0]);
    $('#asset_id').val(data[1]);
    $('#task_type').val(data[2]);
    $('#task_description').val(data[3]);
    $('#task_date').val(data[4]);
  
  });

  // Event handler for when the edit modal is closed
  $('#editmodal').on('hidden.bs.modal', function () {
    // Reinitialize DataTables for the dynamically loaded content
    if ($.fn.DataTable.isDataTable('#maintenanceTasksTable"')) {
      $('#maintenanceTasksTable"').DataTable().destroy();
    }

    $('#maintenanceTasksTable"').DataTable().page(currentPage).draw('page'); // Go back to the stored page
  });
});
});
       $(document).ready(function() {
    // Add a click event handler for the "Cancel" button
    $('#Cancel-buttons').click(function(e) {
        e.preventDefault(); // Prevent the default link behavior
        $('#deletemodal').modal('hide'); // Close the modal
    });
});

$(document).ready(function() {
    $(document).on('click', '.delete-btn', function() {
        $('#deletemodal').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        // Get the value of asset_id for delete
        var taskIdForDelete = data[0];

        $('#confirm-delete').off('click').on('click', function() {
            $.ajax({
                type: 'POST',
                url: 'deletemaintenance.php',
                data: { task_id: taskIdForDelete },
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
<script>
  $(document).ready(function() {
    $('#maintenanceTasksTable').DataTable({
      autoWidth: false,
      columnDefs: [{
        targets: ['_all'],
        className: 'mdc-data-table__cell'
      }]
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