<?php
require('config/db_connection.php');
include('security.php');// Start the session

// Check if the user is logged in
if (isset($_SESSION['Username'])) {
    $loggedInName = $_SESSION['Username'];

    $query = "SELECT is_Lock_Account, UserTypeID FROM userinfo WHERE Username = '$loggedInName' AND UserTypeID = 2";
    // Execute the query
    $result = $conn->query($query);
    
    if ($result) {
        $row = $result->fetch_assoc();

        // Close the result set
        $result->close();

        if ($row['UserTypeID'] == 2) {
        } else {
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
if ($row['is_Lock_Account'] == 1) {
    // User account is locked
    header("Location: session_ended.php");
    exit();
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
    
    <title>Admin - Dashboard</title>


    <style>
        /* Hover effect styles */
        .hover-effect:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transition: box-shadow 0.3s ease;
        }

        /* Remove default link styles and make it cover the entire card */
        .card-link {
            display: block;
            text-decoration: none;
            color: inherit;
        }

        .zoom-effect {
            transition: transform 0.3s ease;
        }

        .zoom-effect:hover {
            transform: scale(1.05); /* Adjust the scale factor for your desired zoom level */
        }
    </style>
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="system_admin.php">
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
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                
            </div>

            <!-- Nav Item - File Maimntenance Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>File Maintenance</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="filemaintenance/file_strand.php">Strand</a>
                        <a class="collapse-item" href="filemaintenance/file_subject.php">Subject</a>
                        <!-- <a class="collapse-item" href="filemaintenance/file_instructor.php">Instructor</a> -->
                        <a class="collapse-item" href="filemaintenance/file_section.php">Class Section</a>
                        <a class="collapse-item" href="filemaintenance/file_room.php">Room</a>
                        <a class="collapse-item" href="filemaintenance/timeAvail.php">Instructor Availability</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - View Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseView"
                    aria-expanded="true" aria-controls="collapseView">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>View Records</span>
                </a>
                <div id="collapseView" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="records/view_strand.php">Strand</a>
                        <a class="collapse-item" href="records/view_subject.php">Subject</a>
                        <a class="collapse-item" href="records/view_instructor.php">Instructor</a>
                        <a class="collapse-item" href="records/view_section.php">Class Section</a>
                        <a class="collapse-item" href="records/view_room.php">Room</a>
                        <a class="collapse-item" href="records/view_timeAvail.php">Instructor Availability</a>
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
                         
                        <a class="collapse-item" href="utilities/accounts.php">Account Management</a>
                        <a class="collapse-item" href="utilities/archive.php">Archive</a>
                        <a class="collapse-item" href="utilities/backup.php">Back Up</a>
                        <a class="collapse-item" href="utilities/logs.php">Activity History</a>
                        <a class="collapse-item" href="utilities/trash.php">Trash</a>

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
                        <!--  0 -->
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="Profile/profile.php">
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

                <!-- ============================================================ -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Welcome, Admin!</h1>
                        <!-- <a href="generate_report.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                        </a> -->
                    </div>
                    <!-- <button id="sendButton">Send</button> -->
                    <!-- Content Row -->
                    

                    <!-- <div class="card shadow mb-4">
                         <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                            <button type="button" class="btn btn-primary" id="filterButton" onclick="filterOnline()">Show Online</button>
                        </div> -->

                        <!-- <div class="card-body">
                            
                        </div>
                    </div>  -->

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
    

    <!-- Tables -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/demo/datatables-demo.js"></script>


    
    <script>
        var showOnline = true;  // Variable to track whether to show online or all users

        function filterOnline() {
            var tableRows = document.querySelectorAll('#dataTable tbody tr');

            if (showOnline) {
                tableRows.forEach(function(row) {
                    var statusCell = row.querySelector('td:nth-child(4) span');
                    if (statusCell.textContent.trim() === 'Online') {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                document.getElementById('filterButton').innerText = 'Show All';
                showOnline = false;
            } else {
                tableRows.forEach(function(row) {
                    row.style.display = 'table-row';
                });
               
                document.getElementById('filterButton').innerText = 'Show Online';
                showOnline = true;
            }
        }
    </script>

<script>
        var sessionTimeout = 60;  // Session timeout in seconds
        var lastActivityTime = new Date().getTime() / 1000;  // Initial activity time

        function resetSessionTimeout() {
            lastActivityTime = new Date().getTime() / 1000;
        }

        // Monitor user activity
        document.addEventListener('mousemove', resetSessionTimeout);
        document.addEventListener('keypress', resetSessionTimeout);

        // Check activity and redirect if needed
        setInterval(function() {
            var currentTime = new Date().getTime() / 1000;
            if ((currentTime - lastActivityTime) > sessionTimeout) {
                // User has been inactive, redirect to login page
                var redirectPath = 'login_form.php';  // Adjust the redirect path
                window.location.href = redirectPath;
            }
        }, 1000);  // Check every second

    </script>
     <script>
        document.getElementById('sendButton').addEventListener('click', function() {
            // Create a new notification item
    
            var createHeader = document.createElement('h6');
            createHeader.classList.add('dropdown-header');
            createHeader.innerHtml = 'Alerts Center'

            var newNotification = document.createElement('a');
            newNotification.classList.add('dropdown-item', 'd-flex', 'align-items-center');

            var notificationIcon = document.createElement('div');
            notificationIcon.classList.add('mr-3');
            notificationIcon.innerHTML = '<div class="icon-circle bg-warning"><i class="fas fa-exclamation-triangle text-white"></i></div>';

            var notificationContent = document.createElement('div');
            var currentDate = new Date().toDateString();
            notificationContent.innerHTML = '<div class="small text-gray-500">' + currentDate + '</div>' +
                '<span class="font-weight-bold">Admin has given you a warning</span>';

            newNotification.appendChild(notificationIcon);
            newNotification.appendChild(notificationContent);

            // Append the new notification to the dropdown
            var dropdownMenu = document.querySelector('.dropdown-list');
            dropdownMenu.insertBefore(newNotification, dropdownMenu.childNodes[0]);
        });
    </script>
</body>

</html>


