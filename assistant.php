<?php
require('config/db_connection.php');
include('security.php');
// Start the session

// Check if the user is logged in
if (isset($_SESSION['Username'])) {
    $loggedInName = $_SESSION['Username'];

    $query = "SELECT is_Lock_Account, is_SchoolDirectorAssistant FROM userinfo WHERE Username = '$loggedInName' AND is_SchoolDirectorAssistant = 1";
    // Execute the query
    $result = $conn->query($query);
    
    if ($result) {
        $row = $result->fetch_assoc();

        // Close the result set
        $result->close();

        if ($row['is_SchoolDirectorAssistant'] == 1) {
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

            <!-- Nav Item - File Maimntenance Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#"  data-toggle="collapse" data-target="#collapseSchedule"
                    aria-expanded="true" aria-controls="collapseSchedule">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Create Schedule</span>
                </a>
                <div id="collapseSchedule" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="assistant/shs_create_schedule.php">Senior High School</a>
                        <a class="collapse-item" href="assistant/jhs_create_schedule.php">Junior High School</a>
                        <a class="collapse-item" href="assistant/primary_create_schedule.php">Primary</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - File Maimntenance Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#"  data-toggle="collapse" data-target="#collapseDraft"
                    aria-expanded="true" aria-controls="collapseDraft">
                    <i class="fas fa-edit"></i>
                    <span>Draft Schedule</span>
                </a>
                <div id="collapseDraft" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="assistant/shs_draft_schedule.php">Senior High School</a>
                        <a class="collapse-item" href="assistant/jhs_draft_schedule.php">Junior High School</a>
                        <a class="collapse-item" href="assistant/primary_draft_schedule.php">Primary</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - View Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseView"
                    aria-expanded="true" aria-controls="collapseView">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>Approved Schedule</span>
                </a>
                <div id="collapseView" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="assistant/view_senior_high_school.php">Senior High School</a>
                        <a class="collapse-item" href="assistant/view_junior_high_school.php">Junior High School</a>
                        <a class="collapse-item" href="assistant/view_primary.php">Primary</a>
                        <a class="collapse-item" href="assistant/view_room.php">Room</a>
                        <a class="collapse-item" href="assistant/view_instructor.php">Instructor</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - View Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOfficial"
                    aria-expanded="true" aria-controls="collapseOfficial">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Modify Details</span>
                </a>
                <div id="collapseOfficial" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="assistant/shs_schedule.php">Senior High School</a>
                        <a class="collapse-item" href="assistant/jhs_schedule.php">Junior High School</a>
                        <a class="collapse-item" href="assistant/primary_schedule.php">Primary</a>
                    </div>
                </div>
            </li> -->


            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="assistant/modify_schedule.php">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Modify Details</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="assistant/archive_schedule.php">
                    <i class="fas fa-fw fa-archive"></i>
                    <span>Archive Schedule</span>
                </a>
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
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
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
                        <h1 class="h3 mb-0 text-gray-800">Messages</h1>
                    </div>


                    <div class="message-container" style="max-height: 70vh; overflow-y: auto;">
    <!-- Display Messages -->
    <?php
    // Include your database connection code here
    require('config/db_connection.php');

    // Fetch messages from the database, ordered by the latest ones first
    $sql = "SELECT * FROM message WHERE UserTo = 3 ORDER BY CreatedAt DESC";
    $result = $conn->query($sql);

    // Check if there are messages
    if ($result->num_rows > 0) {
        // Iterate through each message
        while ($row = $result->fetch_assoc()) {
            // Convert timestamp to AM/PM format with time first, followed by month, day, and year
            $createdAt = date("g:i A, F j, Y", strtotime($row['CreatedAt']));

            // Display each message in an alert
            echo '<div class="alert alert-info message-box" role="alert">';
            echo '<div class="row">';
            echo '<div class="col-md-8">';

            // Display specific messages for different actions
            if ($row['Action'] == 5 || $row['Action'] == 9) {
                echo '<span style="font-size: 1.2em;"><strong>Approved Revision</strong></span><br>';
            } elseif ($row['Action'] == 0 || $row['Action'] == 1) {
                echo '<span style="font-size: 1.2em;"><strong>' . ($row['Action'] == 0 ? 'Rejected Schedule' : 'Approved Schedule') . '</strong></span><br>';
                // Display Year Level and Section for actions 0 and 1
                echo '<strong>Grade:</strong> ' . $row['YearLevel'] . ' ' .  $row['Strand'] . '<br>';
                echo '<strong>Section:</strong> ' . $row['Section'] . '<br>';
            } elseif ($row['Action'] == 6) {
                echo '<span style="font-size: 1.2em;"><strong>Approved Drop Schedule</strong></span><br>';
            } elseif ($row['Action'] == 7) {
                echo '<span style="font-size: 1.2em;"><strong>Rejected Modify Schedule</strong></span><br>';
            } elseif ($row['Action'] == 8) {
                echo '<span style="font-size: 1.2em;"><strong>Rejected Drop Schedule</strong></span><br>';
            } else {
                // Handle other actions as needed
            }

            // Display "School Director" if UserFrom is 2
            if ($row['UserFrom'] == 2) {
                echo '<strong>From:</strong> School Director<br>';
            } else {
                echo '<strong>From:</strong> ' . $row['UserFrom'] . '<br>';
            }

            echo '</div>';
            echo '<div class="col-md-4 text-right">';
            echo '<span class="timestamp">' . $createdAt . '</span><br>';
            echo '</div>';
            echo '</div>';
            echo '<hr class="message-hr" style="display: none;">'; // Initially hidden
            echo '<div class="message-content" style="display: none; ">' . $row['Message'] . '</div><br>';
            echo '<div class="row">';
            echo '<div class="col-md-12 text-center">';
            echo '<a href="#" class="see-more-link" style="color: #007bff;">See More</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        // No messages found
        echo '<div class="alert alert-warning" role="alert">No messages found.</div>';
    }

    // Close the database connection
    $conn->close();
    ?>
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
    $(document).ready(function () {
        // Toggle message content and hr on "See More" click
        $(".see-more-link").click(function (e) {
            e.preventDefault();
            var messageBox = $(this).closest('.message-box');
            var messageContent = messageBox.find('.message-content');
            var messageHr = messageBox.find('.message-hr');
            var linkText = $(this).text();

            messageContent.toggle();
            messageHr.toggle();

            // Change link text based on the current state
            $(this).text(linkText === 'See More' ? 'See Less' : 'See More');
        });
    });
</script>
    
</body>

</html>
