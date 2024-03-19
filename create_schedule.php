<?php
require('config/db_connection.php');
include('security.php');
 // Start the session

// Check if the user is logged in
if (isset($_SESSION['Username'])) {
    $loggedInName = $_SESSION['Username'];

    // Make sure you have a valid database connection here

    // Create an SQL query to get the RoleID and UserID of the logged-in user
    $query = "SELECT * FROM users WHERE Username = '$loggedInName'";

    // Execute the query
    $result = $conn->query($query);
    
    if ($result) {
        $row = $result->fetch_assoc();

        // Close the result set
        $result->close();

        if ($row['RoleID'] == 3) {
            // User has RoleID 4 (instructor), so they have access
            // Continue with the page's content
            
            // Display the User ID of the instructor
            // echo "You are an instructor with User ID: " . $row['UserID'];
        } else {
            // User does not have RoleID 4, so they don't have access
            // You can redirect them to an error page or display an error message
            header("location: ../index.php");
            // Optionally, you can include a link to log out and return to the login page
        }
    } else {
        // Handle the case where the query fails
        echo "Error in fetching RoleID and UserID: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="assets/img/logo1.png">
    <!-- Style for icons and fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="assets/style/admin.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <title>Assistant - Dashboard</title>
</head>

<?php
include('session_out.php');
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="assistant.php">
                <div class="sidebar-brand-icon">
                    <i class="fas">
                        <img src="assets/img/logo1.png" alt="logo" width="50" height="50">
                    </i>
                </div>
                <div class="sidebar-brand-text mx-3" style="font-size: 13px">Online Class Scheduling System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="assistant.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                
            </div>

            <!-- Nav Item - File Maimntenance Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Create Schedule</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                </div>
            </li>

            <!-- Nav Item - View Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseView"
                    aria-expanded="true" aria-controls="collapseView">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>View Schedule</span>
                </a>
                <div id="collapseView" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Class</a>
                        <a class="collapse-item" href="#">Room</a>
                        <a class="collapse-item" href="#">Instructor</a>
                    </div>
                </div>
            </li>

                <!-- Nav Item - View Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInstructor"
                    aria-expanded="true" aria-controls="collapseInstructor">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>Instructor</span>
                </a>
                <div id="collapseInstructor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="preferred_subject.php">Preferred Subject</a>
                        <a class="collapse-item" href="time_availability.php">Time Availability</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Archive</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Preferred Subject</a>
                        <a class="collapse-item" href="#">Time Availability</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
 
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Topbar -->
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                            <!-- Sidebar Toggle (Topbar) -->
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>

                            

                            <!-- Topbar Navbar -->
                            <ul class="navbar-nav ml-auto">

                                <!-- Nav Item - Alerts -->
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bell fa-fw"></i>
                                        <!-- Counter - Alerts -->
                                        <span class="badge badge-danger badge-counter">3+</span>
                                    </a>
                                    <!-- Dropdown - Alerts -->
                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="alertsDropdown">
                                        <h6 class="dropdown-header">
                                            Alerts Center
                                        </h6>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">December 12, 2019</div>
                                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-success">
                                                    <i class="fas fa-donate text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">December 7, 2019</div>
                                                $290.29 has been deposited into your account!
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-warning">
                                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">December 2, 2019</div>
                                                Spending Alert: We've noticed unusually high spending for your account.
                                            </div>
                                        </a>
                                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </li>

                                
                                <div class="topbar-divider d-none d-sm-block"></div>

                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Assistant</span>
                                        <img class="img-profile rounded-circle"
                                            src="img/undraw_profile.svg">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="Profile/assistant_profile.php">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>  
                                    </div>
                                </li>

                            </ul>

                        </nav>
                        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Create Schedule</h1>
                                
                                <div>
                                    
                                    <!-- Print Button -->
                                    <button onclick="printTable()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-print fa-sm text-white-50"></i> Print
                                    </button>
                                    
                                    <!-- Excel Button -->
                                    <button onclick="exportToExcel()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-file-excel fa-sm text-white-50"></i> Export to Excel
                                    </button>
                                </div>
                            </div>
                            

                            <!-- Content Row -->
                            <div class="card-header py-3 d-flex justify-content-end">
                                <a href="#" class="d-none d-sm-inline-block btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addschedule" title="Add Schedule">
                                            <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Schedule"></i></span>
                                </a>
                            </div>
                            <div class="container mt-4">
                                <div class="row">

                                    <!-- Senior High School Card -->
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Senior High School</h5>

                                                <!-- Dropdown Button -->
                                                <div class="dropdown float-left">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Grade 11
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#" data-value="ABM">ABM</a>
                                                        <a class="dropdown-item" href="#" data-value="GAS">GAS</a>
                                                        <a class="dropdown-item" href="#" data-value="H.E">H.E</a>
                                                        <a class="dropdown-item" href="#" data-value="HUMSS">HUMSS</a>
                                                        <a class="dropdown-item" href="#" data-value="ICT">ICT</a>
                                                        <a class="dropdown-item" href="#" data-value="STEM">STEM</a>
                                                    </div>
                                                </div>

                                                <div class="dropdown float-right">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Grade 12
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">ABM</a>
                                                        <a class="dropdown-item" href="#">GAS</a>
                                                        <a class="dropdown-item" href="#">H.E</a>
                                                        <a class="dropdown-item" href="#">HUMSS</a>
                                                        <a class="dropdown-item" href="#">ICT</a>
                                                        <a class="dropdown-item" href="#">STEM</a>
                                                    </div>
                                                </div>

                                                 
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Primary Card -->
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Primary</h5>

                                                <!-- Dropdown Button -->
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select Option
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">10</a>
                                                        <a class="dropdown-item" href="#">9</a>
                                                        <a class="dropdown-item" href="#">8</a>
                                                        <a class="dropdown-item" href="#">7</a>                                                        
                                                    </div>
                                                </div>

                                                 
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Junior High School Card -->
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Junior High School</h5>

                                                <!-- Dropdown Button -->
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select Option
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">5</a>
                                                        <a class="dropdown-item" href="#">4</a>
                                                        <a class="dropdown-item" href="#">3</a>
                                                        <a class="dropdown-item" href="#">2</a>
                                                        <a class="dropdown-item" href="#">1</a>
                                                    </div>
                                                </div>

                                                 
                                            </div>
                                        </div>
                                    </div>


                                     

                                    

                                </div>
                            </div>
                 

               
                    

                            <div class="card shadow mb-4">
                                <!-- <div class="card-header py-3 d-flex justify-content-end">
                                    <a href="#" class="d-none d-sm-inline-block btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addschedule">
                                        <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Schedule"></i></span>
                                    </a>
                                </div> -->
                                <div class="card-body" id="tableContainer" style="display: none;">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        
                                            <thead>
                                                <tr>
                                                    <th>Academic Year</th>
                                                    <th>Year Level</th>
                                                    <th>Semester</th>
                                                    <th>Strand</th>
                                                    <th>Subject</th>
                                                    <th>Instructor</th>
                                                    <th>Date and Time</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Academic Year</th>
                                                    <th>Year Level</th>                                            
                                                    <th>Semester</th>
                                                    <th>Strand</th>
                                                    <th>Subject</th>
                                                    <th>Instructor</th>
                                                    <th>Date and Time</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </tfoot>
                                            <tbody id="historyBody">
                                                <?php
                                                    require('config/db_connection.php');
                                                    // $table = mysqli_query($conn, "SELECT * FROM history");
                                                    // while($row = mysqli_fetch_array($table)){ 
                                                    //     <tr>
                                                    //     <tr>
                                                    //     </td>
                                                            
                                                    //     </tr>
                                                    
                                                    // <
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- end of container fluid -->
                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; BATANG COMTEQ 2023</span>
                            </div>
                        </div>
                    </footer>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Add Modal -->
<div class="modal fade" id="addschedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="CreateSchedule/add_schedule.php" method="POST"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="Year">Academic Year</label>
                        <div style="position: relative;">
                        <input type="text" class="form-control" disabled selected id="academic_year" name="Academic_Year" value="<?php echo date("Y") . "-" . (date("Y") + 1); ?>">
                        <span style="position: absolute; top: 8px; right: 8px;">This is default Academic Year</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select class="form-control" id="department" name="Department" onchange="lockSelection()" required>
                            <option disabled selected>Select Department</option>
                            <?php
                                $sqlDepartmentType = "SELECT * FROM departmenttypename";
                                $resultDepartmentTypeName = $conn->query($sqlDepartmentType);
                                if ($resultDepartmentTypeName->num_rows > 0) {
                                    while ($row = $resultDepartmentTypeName->fetch_assoc()) {
                                        echo '<option value="' . $row['DepartmentTypeNameID'] . '">' . $row['DepartmentTypeName'] . '</option>';
                                    }
                                }
                            ?>
                        </select> 
                    </div>
                    <div class="form-group">
                        <label for="yearlevel">Year Level</label>
                        <select class="form-control" id="yearlevel" name="Year_Level" required>
                            <option disabled selected>Select Year Level</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="Semester" required>
                            <option disabled selected>Select Semester</option>
                           
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="strand">Strand</label>
                        <select class="form-control" id="strand" name="Strand" required>
                            <option disabled selected>Select Strand</option>
                            <?php
                            $sqlStrand = "SELECT DISTINCT StrandCode FROM strands Where Active =1";
                            $resultStrand = $conn->query($sqlStrand);

                            if ($resultStrand->num_rows > 0) {
                                while ($row = $resultStrand->fetch_assoc()) {
                                    echo '<option value="' . $row['StrandCode'] . '">' . $row['StrandCode'] . '</option>';
                                }
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select class="form-control" id="subject" name="Subject" required>
                            <option disabled selected>Select Subject</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="instructor">Instructor</label>
                        <select class="form-control" id="instructor" name="Instructor" required>
                            <option disabled selected>Select Instructor</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="dateTime">Date and Time</label>
                        <select class="form-control multiple-select" name="Day[]" multiple  id="Day" required>
                            <option disabled selected>Select Day</option>
                        </select>                       
                    </div>
                    <div class="form-group">
                        <label for="Time_Start">Time Start:</label>
                        <input class="form-control" type="time" id="Time_Start" name="Time_Start" min="08:00" max="17:00" required>
                        <label for="Time_End">Time End:</label>
                        <input class="form-control" type="time" id="Time_End" name="Time_End" min="08:00" max="17:00" required>
                    </div>

                    <div class="form-group">
                        <label for="room">Room</label>
                        <select class="form-control" id="roomType" name="Room" required>
                            <option disabled selected>Select Room Type</option>
                            <?php
                                $sql = "SELECT rooms.RoomID, rooms.RoomNumber, roomtype.RoomTypeName
                                        FROM rooms
                                        INNER JOIN roomtype ON rooms.RoomTypeID = roomtype.RoomTypeID
                                        WHERE rooms.Active = 1";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['RoomID'] . '">' . $row['RoomNumber'] . ' - ' . $row['RoomTypeName'] . '</option>';
                                    }
                                }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="section">Section</label>
                        <select class="form-control" id="section" name="Section" required>
                            <option disabled selected>Select Section</option>
                            <?php
                                $sqlSection = "SELECT * FROM sections WHERE Active=1";
                                $resultSection = $conn->query($sqlSection);

                                if ($resultSection->num_rows > 0) {
                                    while ($row = $resultSection->fetch_assoc()) {
                                        echo '<option value="' . $row['SectionID'] . '">' . $row['SectionName'] .'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_btn" class="btn btn-primary">Save
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>                 
        </form>
    </div>
</div>



    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                    <form action="logout.php" method="POST">
                        <button type="submit"  name="logout_btn" class="btn btn-primary">Logout</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Tables -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/demo/datatables-demo.js"></script>
 

    <script>
        $(document).ready(function() {
            $('#department').change(function() {
                 
                var departmentID = $(this).val();

                // Make an AJAX request to fetch instructors for the selected department
                $.ajax({
                    url: 'GetData/get_department.php',
                    type: 'POST',
                    data: { departmentID: departmentID },
                    success: function(data) {
                        $('#instructor').html(data);
                       
                    }
                });

                $.ajax({
                    url: 'GetData/get_year.php',
                    type: 'POST',
                    data: { departmentID: departmentID },
                    success: function(data) {
                        $('#yearlevel').html(data);
                       
                    }
                });

                $.ajax({
                    url: 'GetData/get_sem.php',
                    type: 'POST',
                    data: { departmentID: departmentID },
                    success: function(data) {
                        $('#semester').html(data);
                       
                    }
                });
            
                // Make another AJAX request to fetch subjects for the selected department
                $.ajax({
                    url: 'GetData/get_subject.php',
                    type: 'POST',
                    data: { departmentID: departmentID },
                    success: function(data) {
                        $('#subject').html(data);
                    }
                });
            });

        });

       

    </script>
 
    <script>
        $(document).ready(function () {
            $('#strand').change(function () {
                var strandCode = $(this).val();
                console.log('Selected Strand Code:', strandCode); // Add this line for debugging

                $.ajax({
                    url: 'GetData/get_spec.php',
                    type: 'POST',
                    data: { strandCode: strandCode },
                    success: function (data) {
                        $('#specialization').html(data);
                    },
                    error: function () {
                        // Handle AJAX errors here
                    }
                });
            });
        });

    </script>

<script>
       $(document).ready(function () {
    $('#yearlevel').change(function () {
        var yearLevel = $(this).val(); // Correct the variable name

        $.ajax({
            url: 'GetData/get_year_subject.php',
            type: 'POST',
            data: { yearLevel: yearLevel },
            success: function (data) {
                $('#subject').html(data);
            },
            error: function () {
                // Handle AJAX errors here
            }
        });

        
    });
});


    </script>
<!-- getting instructor according to year -->
<!-- <script>
       $(document).ready(function () {
    $('#yearlevel').change(function () {
        var yearLevel = $(this).val(); // Correct the variable name

        $.ajax({
            url: 'GetData/get_year_instructor.php',
            type: 'POST',
            data: { yearLevel: yearLevel },
            success: function (data) {
                $('#instructor').html(data);
            },
            error: function () {
                // Handle AJAX errors here
            }
        });

        
    });
});


    </script> -->

<script>
$(document).ready(function () {
    $('#semester').change(function () {
        var semester = $(this).val();
        var yearLevel = $('#yearlevel').val(); // Get the selected year level

        $.ajax({
            url: 'GetData/get_semester_subject.php',
            type: 'POST',
            data: { semester: semester, yearLevel: yearLevel }, // Send both semester and year level
            success: function (data) {
                $('#subject').html(data);
            },
            error: function () {
                // Handle AJAX errors here
            }
        });
    });


});



    </script>

    <script>
        $(document).ready(function () {
            $('#strand').change(function () {
                var strand = $(this).val();

                $.ajax({
                    url: 'GetData/get_strand_specialization.php',
                    type: 'POST',
                    data: {strand: strand},
                    success: function (data) {
                        $('#subject').append(data);
                        // var subjectDropdown = $('#subject');
                        // subjectDropdown.find('option').remove(); // Clear existing options

                        // // Append the new options to the Subject dropdown
                        // subjectDropdown.append(data);

                        // You can also add a default option if needed
                        // subjectDropdown.prepend('<option disabled selected>Select Subject</option>');
                    },
                    error: function () {
                        // Handle AJAX errors here
                    }
                });
            });
        });
    </script>

    <!-- For Getting Instructor Preferred Subjects -->
    <script>
        $(document).ready(function () {
            $('#subject').change(function () {
                var subject = $(this).val();

                $.ajax({
                    url: 'GetData/get_instructor_preferred_subject.php',
                    type: 'POST',
                    data: {subject: subject},
                    success: function (data) {
                        $('#instructor').html(data);
                        // var subjectDropdown = $('#subject');
                        // subjectDropdown.find('option').remove(); // Clear existing options

                        // // Append the new options to the Subject dropdown
                        // subjectDropdown.append(data);

                        // You can also add a default option if needed
                        // subjectDropdown.prepend('<option disabled selected>Select Subject</option>');
                    },
                    error: function () {
                        // Handle AJAX errors here
                    }
                });
            });
        });

    </script>


    <!-- For Getting Instructor Time Availability -->
    <script>
        $(document).ready(function () {
            $('#instructor').change(function () {
                var instructor = $(this).val();

                $.ajax({
                    url: 'GetData/get_instructor_time_availability.php',
                    type: 'POST',
                    data: {instructor: instructor},
                    success: function (data) {
                        $('#Day').html(data);
                        // var subjectDropdown = $('#subject');
                        // subjectDropdown.find('option').remove(); // Clear existing options

                        // // Append the new options to the Subject dropdown
                        // subjectDropdown.append(data);

                        // You can also add a default option if needed
                        // subjectDropdown.prepend('<option disabled selected>Select Subject</option>');
                    },
                    error: function () {
                        // Handle AJAX errors here
                    }
                });
            });
        });

    </script>

    <!-- Getting time according to day -->
    <script>
        $(document).ready(function () {
            $('#Day').change(function () {
                var day = $(this).val();

                $.ajax({
                    url: 'GetData/get_day_time.php',
                    type: 'POST',
                    data: {day: day},
                    success: function (data) {
                        $('#Time_Start').html(data);
                        $('#Time_End').html(data);
                        // var subjectDropdown = $('#subject');
                        // subjectDropdown.find('option').remove(); // Clear existing options

                        // // Append the new options to the Subject dropdown
                        // subjectDropdown.append(data);

                        // You can also add a default option if needed
                        // subjectDropdown.prepend('<option disabled selected>Select Subject</option>');
                    },
                    error: function () {
                        // Handle AJAX errors here
                    }
                });
            });
        });

    </script>



    <!--Locking Selection  -->
    <script>
     // JavaScript to disable all select elements initially
     document.addEventListener("DOMContentLoaded", function() {
        var department = document.getElementById("department");
        var yearLevel = document.getElementById("yearlevel");
        var semester = document.getElementById("semester");
        var strand = document.getElementById("strand");
        var subject = document.getElementById("subject");
        var instructor = document.getElementById("instructor");
        var subject = document.getElementById("subject");
        var instructor = document.getElementById("instructor");
        var room = document.getElementById("roomType");
        var section = document.getElementById("section");
        var day = document.getElementById("Day");
        var time_start = document.getElementById("Time_Start");
        var time_end = document.getElementById("Time_End");

        department.disabled = false; // Enable the "Department" select
        yearLevel.disabled = true; // Disable the "Year Level" select
        semester.disabled = true; // Disable the "Semester" select
        strand.disabled = true; // Enable the "Department" select
        subject.disabled = true; // Disable the "Year Level" select
        instructor.disabled = true; // Disable the "Semester" select
        room.disabled = true; // Disable the "Year Level" select
        section.disabled = true; // Disable the "Semester" select
        day.disabled = true; // Disable the "Year Level" select
        time_start.disabled = true; // Disable the "Semester" select
        time_end.disabled = true; // Disable the "Semester" select
    });

    function lockSelection() {
        var department = document.getElementById("department");
        var yearLevel = document.getElementById("yearlevel");
        var semester = document.getElementById("semester");
        var strand = document.getElementById("strand");
        var subject = document.getElementById("subject");
        var instructor = document.getElementById("instructor");
        var subject = document.getElementById("subject");
        var instructor = document.getElementById("instructor");
        var room = document.getElementById("roomType");
        var section = document.getElementById("section");
        var day = document.getElementById("Day");
        var time_start = document.getElementById("Time_Start");
        var time_end = document.getElementById("Time_End");

        if (department.value === "1") {
            department.disabled = false; // Enable the "Department" select
            yearLevel.disabled = false; // Disable the "Year Level" select
            semester.disabled = false; // Disable the "Semester" select
            strand.disabled = false; // Enable the "Department" select
            subject.disabled = false; // Disable the "Year Level" select
            instructor.disabled = false; // Disable the "Semester" select
            room.disabled = false; // Disable the "Year Level" select
            section.disabled = false; // Disable the "Semester" select
            day.disabled = false; // Disable the "Year Level" select
            time_start.disabled = false; // Disable the "Semester" select
            time_end.disabled = false; // Disable the "Semester" select
        } else {
            department.disabled = false; // Enable the "Department" select
            yearLevel.disabled = false; // Disable the "Year Level" select
            semester.disabled = true; // Disable the "Semester" select
            strand.disabled = true; // Enable the "Department" select
            subject.disabled = false; // Disable the "Year Level" select
            instructor.disabled = false; // Disable the "Semester" select
            room.disabled = false; // Disable the "Year Level" select
            section.disabled = false; // Disable the "Semester" select
            day.disabled = false; // Disable the "Year Level" select
            time_start.disabled = false; // Disable the "Semester" select
            time_end.disabled = false; // Disable the "Semester" select
        }
    }
</script>


<!-- getting and changing time according to day, min and max -->
<script>
    $(document).ready(function () {
        // Change event for the select element containing day and time slots
        $('#Day').change(function () {
            // Get the selected option
            var selectedOption = $(this).find(':selected');

            // Set the min and max attributes for Time Start and Time End inputs
            $('#Time_Start').attr('min', selectedOption.data('min-time'));
            $('#Time_Start').attr('max', selectedOption.data('max-time'));
            $('#Time_End').attr('min', selectedOption.data('min-time'));
            $('#Time_End').attr('max', selectedOption.data('max-time'));
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
    $(".multiple-select").select2({
    //  maximumSelectionLength: 2
    });
</script>
    

<script>
    // Function to update table content based on the selected option
    function updateTableContent(strand) {
        // Show loading message or spinner while data is being fetched
        // $('#dataTable').html('<tbody><tr><td colspan="9">Loading...</td></tr></tbody>');
        $('#dataTable').html(`
            <thead>
                <tr>
                    <th>Academic Year</th>
                    <th>Year Level</th>
                    <th>Semester</th>
                    <th>Strand</th>
                    <th>Subject</th>
                    <th>Instructor</th>
                    <th>Date and Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Academic Year</th>
                    <th>Year Level</th>
                    <th>Semester</th>
                    <th>Strand</th>
                    <th>Subject</th>
                    <th>Instructor</th>
                    <th>Date and Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td colspan="9">Loading...</td>
                </tr>
            </tbody>
        `);

        // Use AJAX to send a request to the server
        $.ajax({
            type: 'GET',
            url: 'get_schedules.php', // Replace with the actual path to your PHP file
            data: { strand: strand },
            success: function (data) {
                // Update the table with the fetched data
                $('#dataTable').html(data);
            },
            error: function () {
                // Handle error, show an error message, or revert to the previous state
                // $('#dataTable').html('<tbody><tr><td colspan="9">Error fetching data</td></tr></tbody>');
                $('#dataTable').html(`
            <thead>
                <tr>
                    <th>Academic Year</th>
                    <th>Year Level</th>
                    <th>Semester</th>
                    <th>Strand</th>
                    <th>Subject</th>
                    <th>Instructor</th>
                    <th>Room</th>
                    <th>Date and Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Academic Year</th>
                    <th>Year Level</th>
                    <th>Semester</th>
                    <th>Strand</th>
                    <th>Subject</th>
                    <th>Instructor</th>
                    <th>Room</th>
                    <th>Date and Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td colspan="9">Loading...</td>
                </tr>
            </tbody>
        `);

            }
        });
    }

    // Update table content when a dropdown item is clicked
    $('.dropdown-item').on('click', function () {
        var selectedOption = $(this).data('value');
        $('#tableContainer').show();
        updateTableContent(selectedOption);
    });
</script>

</body>
</html>