<?php
require('../config/db_connection.php');
include('../security.php');// Start the session

if (isset($_SESSION['Username'])) {
    $loggedInName = $_SESSION['Username'];

    // Make sure you have a valid database connection here

    $query = "SELECT usi.is_Lock_Account, usi.UserTypeID, usi.*, ust.UserTypeName 
    FROM userinfo usi
    INNER JOIN usertypes ust ON usi.UserTypeID = ust.UserTypeID
    WHERE usi.Username = '$loggedInName' AND usi.UserTypeID = 2";

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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <title>Edit Profile</title>

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
                        <img src="../assets/img/logo1.png" alt="logo" width="50" height="50">
                    </i>
                </div>
                <div class="sidebar-brand-text mx-3" style="font-size: 13px">Online Class Scheduling System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../system_admin.php">
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
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>File Maintenance</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../filemaintenance/file_strand.php">Strand</a>
                        <a class="collapse-item" href="../filemaintenance/file_subject.php">Subject</a>
                        <a class="collapse-item" href="../filemaintenance/file_section.php">Section</a>
                        <a class="collapse-item" href="../filemaintenance/file_instructor.php">Instructor</a>
                        <a class="collapse-item" href="../filemaintenance/file_room.php">Room</a>
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
                        <a class="collapse-item" href="">Class</a>
                        <a class="collapse-item" href="">Instructor</a>
                        <a class="collapse-item" href="">Room</a>
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

                     

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                         

                        

                        <!-- Nav Item - Messages -->
                         

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
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
                    <!-- DataTales Example -->
                    <div class="container-xl px-4 mt-4">
                        <div class="d-sm-flex align-items-center">
                            <h1 class="h3 mb-2 text-gray-800">
                                <?php
                                    echo $row['Fname'] . " ". $row['Mname'] . " " . $row['Lname'];
                                ?></h1>
                                <!-- <span class="h4 mb-1 ml-2"><i class="fa fa-cogs"></i></span> -->
                        </div>
                        <hr class="mt-0 mb-4">
                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex justify-content-start">
                                                <span>Change Password</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="dropdown d-flex justify-content-end">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cog"></i> <!-- Assuming you're using Font Awesome for icons -->
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="edit_profile_assistant.php">Edit Profile</a>
                                                    <a class="dropdown-item" href="change_password_assistant.php">Change Password</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Start the session (if not already started)
                                    

                                    // Check if the user is logged in (you should have your own authentication mechanism)
                                    if (!isset($_SESSION['Username'])) {
                                        // Redirect to the login page or handle unauthorized access as needed
                                        header("Location: login.php"); // Replace 'login.php' with your login page URL
                                        exit();
                                    }

                                    require('../config/db_connection.php');

                                    $loggedInUsername = $_SESSION['Username']; // Get the logged-in username from the session

                                    // Query the database for the currently logged-in user
                                    $query = "SELECT * FROM userinfo WHERE Username = '$loggedInUsername'";
                                    $result = mysqli_query($conn, $query);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                    } else {
                                        // Handle the case where the user is not found
                                        echo "User not found";
                                    }
                                    ?>

                                    <form method="POST">
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-12">
                                            <label class="small mb-1">Username</label>
                                                <input class="form-control" id="username" name="username" type="text" placeholder="Enter your first name" value="<?php echo $row['Username']?>">
                                            </div>
                                        </div>
                                        
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="inputCurrentPassword">Current Password</label>
                                                <input class="form-control"  id="current_password" name="current_password" type="password" placeholder="Enter current password" name="current_password" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="inputNewPassword">New Password</label>
                                                <input class="form-control"  id="new_password" name="new_password" type="password" placeholder="Enter new password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                <input class="form-control"  id="confirm_password" name="confirm_password" type="password" placeholder="Confirm new password" name="confirm_password" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-12">
                                                <p class="text-muted">
                                                    The password must have at least 8 characters, at least 1 digit(s), at least 1 lower case letter(s), at least 1 upper case letter(s), at least 1 non-alphanumeric character(s) such as *, -, or #
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-12 d-flex justify-content-end">
                                                <a href="profile.php">
                                                    <button class="btn btn-outline-secondary mr-2" type="button" name="cancel_btn">Cancel</button>
                                                </a>
                                                <button class="btn btn-primary" type="submit" id="update_btn">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>


                                        
                                </div>
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
                        <span>Copyright &copy; BATANG COMTEQ 2023</span>
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


    <!-- Delete Logs Modal -->
    <div class="modal fade" id="deletelogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Logs</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Logs?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" id="confirmDeleteButton">Delete</button>
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



   


    <!-- Print and Import to Excel -->
    <script src="../assets/js/DataPrintExcel/print_subject.js"></script>
   
    <script src="../assets/js/capitalLetter.js"></script>
   
    <!-- Add SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  
    <script>
$(document).ready(function () {
    $("#update_btn").click(function () {
        // Gather data from form fields
        var username = $("#username").val();
        var current_password = $("#current_password").val();
        var new_password = $("#new_password").val();
        var confirm_password = $("#confirm_password").val();

        // Create data object to send to the server
        var data = {
            username: username,
            current_password: current_password,
            new_password: new_password,
            confirm_password: confirm_password
        };

        // Send AJAX request
        $.ajax({
            type: "POST",
            url: "changePassword/change_password_connection.php", // Update with the correct path
            data: data,
            success: function (response) {
                // Handle the server response here with SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response,
                    showConfirmButton: false,
                    timer: 1500
                });
                // Reload the page with a delay of 2 seconds (2000 milliseconds)
                setTimeout(function () {
                        location.reload();
                    }, 2000);
            },
            error: function () {
                // Handle errors here with SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error updating profile. Please try again.',
                });
            }
        });
    });
});
</script>






</body>

</html>
    