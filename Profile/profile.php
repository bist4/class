<?php
require('../config/db_connection.php');
include('../security.php');// Start the session

// Check if the user is logged in
if (isset($_SESSION['Username'])) {
    $loggedInName = $_SESSION['Username'];

    // Make sure you have a valid database connection here

    // Create an SQL query to get the RoleID and UserID of the logged-in user
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
    
    <title>Profile</title>

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
                        <div class="col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img class="img-account-profile rounded-circle mb-2"  src="../img/undraw_profile.svg" alt="profile">
                                    <!-- Profile picture help block-->
                                    <!-- <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> -->
                                    <!-- Profile picture upload button-->
                                    <button style="display: none;" class="btn btn-primary" type="button">Upload new image</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <!-- Account details card-->
                            
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex justify-content-start">
                                                <span>Account Details</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="dropdown d-flex justify-content-end">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cog"></i> <!-- Assuming you're using Font Awesome for icons -->
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="edit_profile_admin.php">Edit Profile</a>
                                                    <a class="dropdown-item" href="change_password_admin.php">Change Password</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">

                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label for="email" style="color: black;">Email Address: </label>
                                        <p><a href="mailto:<?php echo $row['Email']?>" style="color: #007bff;"><?php echo $row['Email']?></a></p>
                                    </div>
                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label for="roles" style="color: black;">Roles: </label>
                                        <p style="color: black;"><?php echo $row['UserTypeName']?></p>
                                    </div>
                                </div>
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

    <!-- loading -->
    <script>
        // Function to show the loading spinner and hide the Save button
        function showLoadingSpinner() {
            $("#saveButton").prop("disabled", true);
            $("#saveButton .spinner-border").removeClass("d-none");
        }

        // Function to hide the loading spinner and show the Save button
        function hideLoadingSpinner() {
            $("#saveButton").prop("disabled", false);
            $("#saveButton .spinner-border").addClass("d-none");
        }

        // Handle form submission
        $("#addStrandForm").submit(function (event) {
            // Prevent the form from submitting immediately
            event.preventDefault();

            // Show the loading spinner
            showLoadingSpinner();

            // Submit the form after a short delay to simulate loading
            setTimeout(function () {
                this.submit();
            }.bind(this), 2000); // Adjust the delay as needed

            // If you want to submit the form without the delay, remove the setTimeout function and simply use this.submit();
        });
    </script>


     
     
     

    <!-- delete modal -->
    <script>
         $(document).ready(function () {
            let deleteLogid;

            // Trigger delete modal when delete button is clicked
            $(".btn-delete").click(function () {
                deleteLogid = $(this).data("log-id");
                $("#deletelogModal").modal("show");
            });

            // Handle delete confirmation
            $("#confirmDeleteButton").click(function () {
                deleteLog(deleteLogid);
            });

            // Function to delete the log
            function deleteLog(logId) {
                $.ajax({
                    url: "DataDelete/delete_log.php",
                    method: "POST",
                    data: { LogID: logId }, // Pass the log ID to delete
                    success: function (data) {
                        // Handle the success response here, e.g., show a success message
                        console.log(data); // You can log the response to the console
                        // Add code to refresh the table or update the UI as needed
                        $("#deletelogModal").modal("hide"); // Close the modal
                    },
                    error: function () {
                        // Handle the error response here, e.g., show an error message
                        console.error("Error deleting log.");
                    },
                });
            }
        });

    </script> 



    <!-- Print and Import to Excel -->
    <script src="../assets/js/DataPrintExcel/print_subject.js"></script>
   
    <script src="../assets/js/capitalLetter.js"></script>
   

</body>

</html>