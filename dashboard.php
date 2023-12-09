
<?php
include "auth.php";
include "getuserrole.php";
// The rest of your page content goes here
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    
    <meta charset="UTF-8">
    <title>DASHBOARD</title>
    <link rel="stylesheet" type="text/css" href="css/sidebars1.css">
    <link rel="stylesheet" href="css/dashboarde.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.material.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
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
       <p class="font-weight-bold">DASHBOARD</p>
      </div>

  
    
      </header>
    </div>
     
        <!-- Main -->


 
      <main class="main-container">
     

        <div class="main-cards">

    <div class="card" id="assets-card">
    <div class="card-inner">
        <p class="">ASSETS</p>
        <span class="material-icons-outlined text-blue">inventory_2</span>
    </div>
    <span class="" id="assets-count">0</span>

</div><div class="card" id="checkinout-card">
    <div class="card-inner">
        <p class="">CHECK IN / CHECK OUT</p>
        <span class="material-icons-outlined text-orange">transfer_within_a_station</span>
    </div>
    <span class="" id="checkinout-count">0</span>
</div>

<div class="card" id="maintenance-card">
            <div class="card-inner">
              <p class="">MAINTENANCE</p>
              <span class="material-icons-outlined text-green">engineering</span>
            </div>
            <span class="" id="maintenance-count">0</span>
          </div>

<div class="card" id="reports-card">
    <div class="card-inner">
        <p class="">REPORTS</p>
        <span class="material-icons-outlined text-red">report</span>
    </div>
    <span class="" id="reports-count">0</span>
</div>
        </div>


   
      <!-- End Main -->
      
  <table id="task-table" class="table table-bordered">
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
        echo '<button class="view-btn" data-task-id="' . $TaskID . '"><i class="fa fa-eye"></i></button>';
        // Uncomment the line below if needed
        // echo '<button class="delete-btn" data-task-id="' . $TaskID . '"><i class="fa fa-trash"></i></button>';
        echo '</td>';

        echo '</tr>';
      }
    }
    ?>

          <div class ="data">
         <canvas id="myChart"></canvas>
         </div>
        
     <table id="dataid" class="table table-bordered">
     <thead>
                <tr>
                    <th scope="col">Checkinout ID</th>
                    <th scope="col">Asset ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Checkin Date</th>
                    <th scope="col">Checkout Date</th>
                    <th scope="col">Expected Return Date</th>
                       <th scope="col">Actions</th>
                </tr>
                </div>
            </thead>
            <tbody>

   
           
                           <?php
                            
                require_once 'config/db_conn.php';
                require_once 'config/functions.php';

                $data = array(); // An array to store the data for the chart

  $result = dispaly_data();
$sql = "SELECT * FROM checkinout";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $CheckinoutID = $row['checkinout_id'];
        $AssetID = $row['asset_id'];
        $UserID = $row['user_id'];
        $CheckinDate = $row['checkin_date'];
        $CheckoutDate = $row['checkout_date'];
        $ExpectedReturnDate = $row['expected_return_date'];
             
        $data[] = [
          'CheckinoutID' =>  $CheckinoutID ,
          'AssetID' => $AssetID,
          'UserID' => $UserID,
          'CheckinDate' => $CheckinDate,
          'CheckoutDate' => $CheckoutDate,
          'ExpectedReturnDate' => $ExpectedReturnDate
      ];


        
         echo '<tr>';
         echo '<td>' . $CheckinoutID. '</td>';
        echo '<td>' .   $AssetID . '</td>';
        echo '<td>' . $UserID . '</td>';
        echo '<td>' . $CheckinDate . '</td>';
        echo '<td>' . $CheckoutDate . '</td>';
        echo '<td>' .  $ExpectedReturnDate . '</td>';
        echo '<td>';
        echo '<button class="view-btn" data-asset-id="' . $AssetID . '"><i class="fa fa-eye"></i></button>
      <button class="edit-btn" data-asset-id="' . $AssetID . '"><i class="fa fa-pencil"></i></button>
      <button class="delete-btn" data-asset-id="' . $AssetID . '"><i class="fa fa-trash"></i></button>';
        echo '</td>';
        echo '</tr>';
    }
}
  
?>



     
<table id="reports-table" class="table table-bordered">
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
        <!-- Table data goes here -->
        <?php
        require_once 'config/db_conn.php';
        require_once 'config/functions.php';
        
        $result = dispaly_data();
        $sql = "SELECT * FROM reports"; // Corrected SQL query
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if the keys exist in the $row array before accessing them
                $report_id = isset($row['report_id']) ? $row['report_id'] : '';
                $report_name = isset($row['report_name']) ? $row['report_name'] : '';
                $report_path = isset($row['report_path']) ? $row['report_path'] : '';
                $generatedDate = isset($row['generated_date']) ? $row['generated_date'] : '';
        
                echo '<tr>';
                echo '<td>' . $report_id . '</td>';
                echo '<td>' . $report_name . '</td>';
                echo '<td>' . $report_path . '</td>';
                echo '<td>' . $generatedDate . '</td>';
                echo '<td>';
                echo '<button class="view-btn" data-report-id="' . $report_id . '"><i class="fa fa-eye"></i></button>';
                echo '<button class="edit-btn" data-report-id="' . $report_id . '"><i class="fa fa-pencil"></i></button>';
                echo '<button class="delete-btn" data-report-id="' . $report_id . '"><i class="fa fa-trash"></i></button>';
                echo '</td>';
                echo '</tr>';
            }
        }
        ?>
        


  
  <!-- Header -->
    <div class="chart-container">
    <canvas id="Chart"></canvas>
       </div>
       <div class="chartsa-container">
    <canvas id="UnitChart"></canvas>
       </div>
        <table id="datatableid" class="table table-bordered">
            <thead>
                <tr>
                  <th scope="col">Asset ID</th>
                    <th scope="col">Asset Type</th>
                    <th scope="col">Maker</th>
                    <th scope="col">Model</th>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Purchase Date</th>
                    <th scope="col">Assigned Location</th>
                    <th scope="col">Status</th>
                     <th scope="col">Unit ID</th>
                    <th scope="col">Actions</th>
                      
                </tr>
            </thead>
            <tbody>
        <?php
require_once 'config/db_conn.php';
require_once 'config/functions.php';

$assetChartData = array();
$result = dispaly_data(); // Assuming dispaly_data() is a function that sets up the database connection

$sql = "SELECT * FROM hardwareassets";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $AssetID = $row['asset_id'];
        $AssetType = $row['asset_type'];
        $Maker = $row['maker'];
        $Model = $row['model'];
        $SerialNumber = $row['serial_number'];
        $PurchaseDate = $row['purchase_date'];
        $AssignedLocation = $row['assigned_location'];
        $Status = $row['status'];
        $Unit = $row['unit'];

        $assetChartData[] = [
    'AssetID' => $AssetID,
    
    'AssignedLocation' => $AssignedLocation,
    'Status' => $Status,
    'unit' => $Unit
];


        echo '<tr>';
        echo '<td>' . $AssetID . '</td>';
        echo '<td>' . $AssetType . '</td>';
        echo '<td>' . $Maker . '</td>';
        echo '<td>' . $Model . '</td>';
        echo '<td>' . $SerialNumber . '</td>';
        echo '<td>' . $PurchaseDate . '</td>';
        echo '<td>' . $AssignedLocation . '</td>';
        echo '<td>' . $Status . '</td>';
        echo '<td>' . $Unit . '</td>';
        echo '<td>';
        echo '<button class="edit-btn" data-asset-id="' . $AssetID . '"><i class="fa fa-pencil"></i></button>
              <button class="delete-btn" data-asset-id="' . $AssetID . '"><i class="fa fa-trash"></i></button>';
        echo '</td>';
        echo '</tr>';
    }
}
?>


                
                
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.material.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    
        <script>
    // Function to open the logout modal
    function openLogoutModal() {
        $('#logoutModal').modal('show');
    }

    // Function to close the logout modal
    function closeLogoutModal() {
        $('#logoutModal').modal('hide');
    }

    $(document).ready(function() {
        // Initialize DataTable for ASSETS
        var assetsDataTable = $('#datatableid').DataTable({
            autoWidth: false,
            columnDefs: [
                {
                    targets: '_all',
                    className: 'mdc-data-table__cell',
                },
            ],
        });

        // Initialize DataTable for CHECK IN / CHECK OUT
        var checkInOutDataTable = $('#dataid').DataTable({
            autoWidth: false,
            columnDefs: [
                {
                    targets: '_all',
                    className: 'mdc-data-table__cell',
                },
            ],
        });

        // Initialize DataTable for MAINTENANCE
        var maintenanceDataTable = $('#task-table').DataTable({
            autoWidth: false,
            columnDefs: [
                {
                    targets: '_all',
                    className: 'mdc-data-table__cell',
                },
            ],
        });

        // Initialize DataTable for REPORTS
        var reportsDataTable = $('#reports-table').DataTable({
            autoWidth: false,
            columnDefs: [
                {
                    targets: '_all',
                    className: 'mdc-data-table__cell',
                },
            ],
        });

        // Function to update the count on the "ASSETS" card
        function updateAssetsCount() {
            var rowCount = assetsDataTable.rows().count();
            $('#assets-count').text(rowCount);
        }

        // Function to update the count on the "CHECK IN / CHECK OUT" card
        function updateCheckInOutCount() {
            var rowCount = checkInOutDataTable.rows().count();
            $('#checkinout-count').text(rowCount);
        }

        // Function to update the count on the "MAINTENANCE" card
        function updateMaintenanceCount() {
            var rowCount = maintenanceDataTable.rows().count();
            $('#maintenance-count').text(rowCount);
        }

        // Function to update the count on the "REPORTS" card
        function updateReportsCount() {
            var rowCount = reportsDataTable.rows().count();
            $('#reports-count').text(rowCount);
        }

        // Hide the tables initially
        $('#datatableid').hide();
        $('#dataid').hide();
        $('#task-table').hide();
        $('#reports-table').hide();

        // Add click events to toggle table visibility and update counts
        $('#assets-card').on('click', function() {
            $('#datatableid').toggle();
            updateAssetsCount();
        });

        // Add click events to toggle table visibility and update counts for "CHECK IN / CHECK OUT" card
        $('#checkinout-card').on('click', function() {
            $('#dataid').toggle();
            updateCheckInOutCount();
        });

        // Add click events to toggle table visibility and update counts for "MAINTENANCE" card
        $('#maintenance-card').on('click', function() {
            $('#task-table').toggle();
            updateMaintenanceCount();
        });

        // Add click events to toggle table visibility and update counts for "REPORTS" card
        $('#reports-card').on('click', function() {
            $('#reports-table').toggle();
            updateReportsCount();
        });

        // Initial count updates
        updateAssetsCount();
        updateCheckInOutCount();
        updateReportsCount();
        updateMaintenanceCount();
    });
    </script>

 <script>
        $(document).ready(function() {
            // Initialize DataTables for all three tables
            var dataidTable = $('#dataid').DataTable();
            var reportsTable = $('#reports-table').DataTable();
            var datatableidTable = $('#datatableid').DataTable();
            var taskTable  = $('#task-table').DataTable();

            // Hide the DataTables tables
            dataidTable.destroy(); // Destroy the DataTables instance for dataid
            reportsTable.destroy(); // Destroy the DataTables instance for reports-table
            datatableidTable.destroy(); // Destroy the DataTables instance for datatableid
            taskTable.destroy(); 

            $('#dataid, #reports-table,#task-table, #datatableid').hide(); // Hide the tables using CSS

            // You can show the tables again if needed
            // $('#dataid, #reports-table, #datatableid').show(); // Show the tables using CSS
            // dataidTable = $('#dataid').DataTable(); // Reinitialize DataTables for dataid
            // reportsTable = $('#reports-table').DataTable(); // Reinitialize DataTables for reports-table
            // datatableidTable = $('#datatableid').DataTable(); // Reinitialize DataTables for datatableid
        });
    </script>


 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
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
const data = <?php echo json_encode($data); ?>;
const checkinoutIds = data.map(item => item.CheckinoutID);
const assetIds = data.map(item => item.AssetID);
const userIds = data.map(item => item.UserID);
const checkinDates = data.map(item => item.CheckinDate);
const expectedReturnDates = data.map(item => item.ExpectedReturnDate);

const barColors = ["red", "green", "blue", "orange"];

// Count occurrences of checkin, checkout, and return dates by checkinout ID
const checkinCount = {};
const checkoutCount = {};
const returnDateCount = {};

data.forEach(item => {
    if (checkinCount[item.CheckinoutID]) {
        checkinCount[item.CheckinoutID]++;
    } else {
        checkinCount[item.CheckinoutID] = 1;
    }

    if (checkoutCount[item.CheckinoutID]) {
        checkoutCount[item.CheckinoutID]++;
    } else {
        checkoutCount[item.CheckinoutID] = 1;
    }

    if (item.ReturnDate) {
        if (returnDateCount[item.CheckinoutID]) {
            returnDateCount[item.CheckinoutID]++;
        } else {
            returnDateCount[item.CheckinoutID] = 1;
        }
    }
});

const combinedChart = new Chart("myChart", {
    type: "bar",
    data: {
        labels: checkinoutIds.map(id => `Checkinout ID ${id}`),
        datasets: [
            {
                label: 'Checkin Count',
                backgroundColor: barColors[0],
                data: checkinoutIds.map(id => checkinCount[id] || 0),
            },
            {
                label: 'Checkout Count',
                backgroundColor: barColors[1],
                data: checkinoutIds.map(id => checkoutCount[id] || 0),
            },
            {
                label: 'Return Date Count',
                backgroundColor: barColors[2],
                data: checkinoutIds.map(id => returnDateCount[id] || 0),
            }
        ]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: "Check in and Check out", // Your title here
                font: {
                    size: 16 // Adjust the font size as needed
                }
            },
            legend: {
                display: true,
                position: 'bottom'
            }
        },
        scales: {
            y: {
                display: true, // This line removes the Y-axis labels
            }
        },
        onClick: (event, activeElements) => {
            // Your click event handling
        }
    }
});
</script>
<script>
// Initialize an empty array to store asset data
var assetChartData = [];

<?php
// Assuming you have the PHP logic to fetch data from the database and populate $assetChartData
foreach ($assetChartData as $item) {
    echo "assetChartData.push(" . json_encode($item) . ");";
}
?>

// Define colors for each status
var statusColors = {
    "Unavailable": "#FF0000",   // Red
    "In Use": "#008000",         // Green
    "Under Maintenance": "#0000FF"  // Blue     
};

// Count assets for each status
var statusCounts = {};
assetChartData.forEach(item => {
    var status = item.Status;
    if (statusCounts.hasOwnProperty(status)) {
        statusCounts[status]++;
    } else {
        statusCounts[status] = 1;
    }
});

// Filter out statuses with no occurrences
var filteredData = assetChartData.filter(item => statusColors[item.Status]);

// Create a mapping of AssetID to a unique value
var assetIDToValue = {};
var uniqueValue = 1; // Initial unique value
filteredData.forEach(item => {
    if (!assetIDToValue.hasOwnProperty(item.AssetID)) {
        assetIDToValue[item.AssetID] = uniqueValue++;
    }
});

// Extract data for the pie chart
var datasets = [{
    data: Object.values(statusCounts),
    backgroundColor: Object.values(statusColors),
    hoverBackgroundColor: Object.values(statusColors),
    subData: filteredData.map(item => {
        return {
            AssetID: item.AssetID,
            AssignedLocation: item.AssignedLocation,
            Status: item.Status,
            Unit: item.unit
        };
    })
}];

    // Log data to console for debugging
    console.log("Labels:", Object.keys(statusColors));
    console.log("Data:", datasets);

    var ctx = document.getElementById('Chart').getContext('2d');
    
    // Log datasets to console for debugging
    console.log("Datasets:", datasets);

    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: Object.keys(statusColors),
            datasets: datasets,
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'ASSET STATUS',
                    font: {
                        size: 16,
                    },
                },
                legend: {
                    display: true,
                    position: 'left',
                },
            },
        },
        tooltips: {
            callbacks: {
                label: function (tooltipItem, data) {
                    var subData = data.datasets[tooltipItem.datasetIndex].subData[tooltipItem.index];
                    return `${subData.AssetID}: ${subData.AssignedLocation}`;
                }
            }
        },
        onClick: function (event, elements) {
            if (elements.length > 0) {
                var index = elements[0].index;
                var subData = myChart.data.datasets[0].subData[index];
                if (subData.Status === "Under Maintenance") {
                    alert(`AssetID: ${subData.AssetID}`);
                }
            }
        }
    });
</script>
<script>
// Create a mapping of AssignedLocation to a unique value based on counts
var assignedLocationToValue = {};
var uniqueValue = 1; // Initial unique value
filteredData.forEach(item => {
    if (item.AssignedLocation && !assignedLocationToValue.hasOwnProperty(item.AssignedLocation)) {
        assignedLocationToValue[item.AssignedLocation] = uniqueValue++;
    }
});

// Create a mapping of AssignedLocation to a random color
var locationColors = {};
Object.keys(assignedLocationToValue).forEach(location => {
    locationColors[location] = getRandomColor();
});

// Create datasets for each Assigned Location
// Create datasets for each Assigned Location
var datasets = [];
var locations = Object.keys(assignedLocationToValue);

locations.forEach(location => {
    var locationData = filteredData.filter(item => item.AssignedLocation === location);
    console.log('location:', location);
    console.log('locationData:', locationData);

    datasets.push({
        label: location, // Use only the location as the label
        data: [locationData.length], // Use the length of the locationData array as the total units
        backgroundColor: getRandomColor(), // Use a random color for each location
        hoverBackgroundColor: getRandomColor(),
        subData: locationData.map(item => {
            return {
                AssetID: item.AssetID,
                AssignedLocation: item.AssignedLocation,
                Status: item.Status,
                Unit: item.unit
            };
        })
    });
});

console.log('datasets:', datasets);

var ctx = document.getElementById('UnitChart').getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: locations.map(location => ''), // Use empty strings as labels to avoid duplication
        datasets: datasets,
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Unit total per Location',
                font: {
                    size: 16,
                },
            },
            legend: {
                display: true,
                position: 'bottom',
            },
        },
    },
    tooltips: {
        callbacks: {
            label: function (tooltipItem, data) {
                var subData = data.datasets[tooltipItem.datasetIndex].subData[0];
                return `${subData.Unit}: ${subData.AssignedLocation}`;
            }
        }
    },
    onClick: function (event, elements) {
        if (elements.length > 0) {
            var index = elements[0].index;
            var subData = myChart.data.datasets[index].subData[0];
            alert(`unit: ${subData.Unit}, location: ${subData.AssignedLocation}`);
        }
    }
});

// Function to generate a random color (you can customize this)
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

</script>


</body>
</html>










