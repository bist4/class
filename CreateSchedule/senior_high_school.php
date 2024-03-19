<?php
require('../config/db_connection.php');
include('../security.php');
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
    
    <link rel="icon" href="../assets/img/logo1.png">
     <!-- Style for icons and fonts -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <title>Senior High School</title> 

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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../assistant.php">
                <div class="sidebar-brand-icon">
                    <i class="fas">
                        <img src="../assets/img/logo1.png" alt="logo" width="50" height="50">
                    </i>
                </div>
                <div class="sidebar-brand-text mx-3" style="font-size: 13px">Online Class Scheduling System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../assistant.php">
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
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Create Schedule</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item active" href="senior_high_school.php">Senior High School</a>
                        <a class="collapse-item" href="junior_high_school.php">Junior High School</a>
                        <a class="collapse-item" href="primary.php">Primary</a>
                    </div>
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
                        <a class="collapse-item" href="#">Instructor</a>
                        <a class="collapse-item" href="#">Room</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInstructor"
                    aria-expanded="true" aria-controls="collapseInstructor">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Instructor</span>
                </a>
                <div id="collapseInstructor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../preferred_subject.php">Preferred Subject</a>
                        <a class="collapse-item" href="../time_availability.php">Time Availability</a>
                    </div>
                </div>
            </li>

             <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                         
                        <a class="collapse-item" href="../utilities/accounts.php">Accounts</a>
                        <a class="collapse-item" href="../utilities/archive.php">Archive</a>
                        <a class="collapse-item" href="../utilities/backup.php">Back Up</a>
                        <a class="collapse-item" href="../utilities/logs.php">Logs</a>
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
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

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
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../Profile/profile.php">
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

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Senior High School</h1>
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
                   
                    <!-- Add Senior High School Button (Visible only on screens below 574px) -->
                    <div class="d-sm-none d-md-none d-lg-none d-xl-none">
                        <div class="card-header py-3 d-flex justify-content-end">
                            <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addSeniorHighSchool">
                            <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Senior High School"></i></span>
                            </a>
                        </div>
                    </div>

                    <!-- Print Button (Visible only on screens below 574px) -->
                    <div class="d-sm-none d-md-none d-lg-none d-xl-none">
                        <div class="card-header py-3 d-flex justify-content-end">
                            <button class="btn btn-success btn-icon-split" id="printButton">
                            <span class="icon text-white-50"><i class="fas fa-print" data-toggle="tooltip" data-placement="top" title="Print"></i></span>
                            </button>
                        </div>
                    </div>

                    <!-- Excel Button (Visible only on screens below 574px) -->
                    <div class="d-sm-none d-md-none d-lg-none d-xl-none">
                        <div class="card-header py-3 d-flex justify-content-end">
                            <button class="btn btn-info btn-icon-split" id="excelButton">
                            <span class="icon text-white-50"><i class="fas fa-file-excel" data-toggle="tooltip" data-placement="top" title="Export to Excel"></i></span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                                <div class="d-flex justify-content-start">
                                    <?php
                                            if(isset($_SESSION['status']))
                                            {
                                                ?>
                                                    
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>Warning!</strong> <?php echo $_SESSION['status'];?>
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                                                                
                                                <?php
                                                unset($_SESSION['status']);
                                            }
                                        
                                        
                                        ?>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="d-none d-sm-inline-block btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addSeniorHighSchool">
                                        <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Senior High School"></i></span>
                                    </a>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Strand Code</th>
                                            <th>Strand Name</th>
                                            <th>Track Type</th>
                                            <th>Specialization</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Strand Code</th>
                                            <th>Strand Name</th>
                                            <th>Track Type</th>
                                            <th>Specialization</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            require('../config/db_connection.php');
                                            $table = mysqli_query($conn,  "SELECT strands.*, specializations.Specialization FROM strands 
                                            INNER JOIN specializations ON strands.SpecializationID = specializations.SpecializationID
                                            WHERE strands.Active = 1 ORDER BY strands.CreatedAt DESC");

                                            $count = 0;
                                            while ($row = mysqli_fetch_array($table)) {
                                                $count++;
                                                $highlightClass = ($count == 1) ? 'text-primary' : ''; 
                                            ?>
                                                <tr class="<?php echo $highlightClass; ?>">
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $row['StrandCode']; ?></td>
                                                    <td><?php echo $row['StrandName']; ?></td>
                                                    <td><?php echo $row['TrackTypeName']; ?></td>
                                                    <td><?php echo $row['Specialization']; ?></td>
                                                    <td>
                                                    <div class="d-flex justify-content-center">
                                                        <!-- <a href="#" class="btn btn-primary mx-2"><i class="fa fa-edit"></i></a> -->
                                                        <button class="btn btn-primary mx-2 btn-edit" data-toggle="modal" data-target="#editStrand"
                                                                data-strand-id="<?php echo $row['StrandID']; ?>"
                                                                data-strand-code="<?php echo $row['StrandCode']; ?>"
                                                                data-strand-name="<?php echo $row['StrandName']; ?>"
                                                                data-track-type="<?php echo $row['TrackTypeName']; ?>"
                                                                data-specialization="<?php echo $row['SpecializationID']; ?>">
                                                            <i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit Strand"></i>
                                                        </button>
                                                        <a href="#" class="btn btn-danger mx-2 btn-delete" data-strand-id="<?php echo $row['StrandID']; ?>">
                                                            <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Strand"></i>
                                                        </a>
                                                    </div>

                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        ?> 

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; BATANG COMTEQ</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
 
    <!-- Add Senior High School Modal -->
    <div class="modal fade" id="addSeniorHighSchool" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="CreateSchedule/add_schedule.php" method="POST"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Senior High School (<?php echo date("Y") . "-" . (date("Y") + 1); ?>)</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="yearlevel">Year Level</label>
                        <select class="form-control" id="yearlevel" name="Year_Level" required>
                            <option value="" disabled selected>Select Year Level</option>
                            <option value="11">Grade 11</option>
                            <option value="12">Grade 12</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="Semester" required>
                            <option value="" disabled selected>Select Semester</option>
                            <option value="1">First Semester</option>
                            <option value="2">Second Semester</option>
                           
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="strand">Strand</label>
                        <select class="form-control" id="strand" name="Strand" required>
                            <option value="" disabled selected>Select Strand</option>
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
                        <label for="dateTime">Day</label>
                        <select class="form-control" name="Day[]" id="Day" required>
                            <option value="" disabled selected>Select Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                        </select>                       
                    </div>
                    <div class="form-group">
                        <label for="Time_Start">Time Start:</label>
                        <input class="form-control" type="time" id="Time_Start" name="Time_Start" min="08:00" max="17:00" required>
                        <label for="Time_End">Time End:</label>
                        <input class="form-control" type="time" id="Time_End" name="Time_End" min="08:00" max="17:00" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select class="form-control" id="subject" name="Subject" required>
                            <option value="" disabled selected>Select Subject</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="instructor">Instructor</label>
                        <select class="form-control" id="instructor" name="Instructor" required>
                            <option value="" disabled selected>Select Instructor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="timeavailability">Instructor Time Availability</label>
                        <div id="timeavailability"></div>
                    </div>
                    <div class="form-group">
                        <label for="timetake">Instructor Time Not Available</label>
                    </div>

                    <div class="form-group">
                        <label for="room">Room</label>
                        <select class="form-control" id="roomType" name="Room" required>
                            <option value="" disabled selected>Select Room Type</option>
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
                            <option value="" disabled selected>Select Section</option>
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

    <!-- Hidden success alert element -->
    <div class="alert alert-success alert-dismissible fade show d-none" id="successAlert" role="alert">
        Successfully added!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="editSeniorHighSchool" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="DataUpdate/update_senior_high_chool.php" method="POST" onsubmit="return validateForm(this)">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Senior High School</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="departmentID" id="editStrandID" value="">
                        <div class="form-group">
                            <label for="editStrandCode">Strand Code</label>
                            <input type="text" class="form-control" id="editStrandCode" name="StrandCode"
                                placeholder="Enter Strand Code" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="editStrandName">Strand Name</label>
                            <input type="text" class="form-control" id="editStrandName" name="StrandName"
                                placeholder="Enter Strand Name" required>
                        </div>
                        <div class="form-group">
                            <label for="editTrackType">Track Type</label>
                            <select class="form-control" name="TrackTypeName" id="editTrackType" required>
                                <option value="Academic Track">Academic Track</option>
                                <option value="Technical-Vocational Livelihood">Technical-Vocational Livelihood</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editSpecialization">Specialization</label>
                            <select class="form-control" id="editSpecialization" name="Specialization" required>
                                <!-- Options will be populated via JavaScript -->
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_btn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- Delete Senior High School Modal -->
    <div class="modal fade" id="deleteStrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Senior High School</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this strand?</p>
                </div>
                <div class="modal-footer">
                    <form action="DataDelete/delete_strand.php" method="POST" id="deleteForm">
					    <input type="hidden" name="StrandID" id="deleteStrandID">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" id="confirmDeleteButton" data-id="">Delete</button>
                    </form>
                </div>
            </div>
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

                    <form action="../logout.php" method="POST">
                        <button type="submit"  name="logout_btn" class="btn btn-primary">Logout</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#yearlevel').change(function () {
            var yearLevel = $(this).val();

            $.ajax({
                url: 'SeniorHighSchool/get_year_subject.php',
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
<script>
$(document).ready(function () {
    $('#semester').change(function () {
        var semester = $(this).val();
        var yearLevel = $('#yearlevel').val(); // Get the selected year level

        $.ajax({
            url: 'SeniorHighSchool/get_semester_subject.php',
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
            $('#subject').change(function () {
                var subject = $(this).val();

                $.ajax({
                    url: 'SeniorHighSchool/get_instructor_preferred_subject.php',
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
                    url: 'SeniorHighSchool/get_instructor_time_availability.php',
                    type: 'POST',
                    data: {instructor: instructor},
                    success: function (data) {
                        $('#timeavailability').html(data);
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

    
    
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>
    <!-- For filtering of strands details -->
	<script src="../assets/js/filteringStrand.js"></script>

    
</body>

</html>