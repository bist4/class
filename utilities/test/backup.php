<?php
require('../config/db_connection.php');
include('../security.php');// Start the session

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

        if ($row['RoleID'] == 1) {
            // User has RoleID 4 (instructor), so they have access
            // Continue with the page's content
            
            // Display the User ID of the instructor
            // echo "You are an instructor with User ID: " . $row['UserID'];
        } else {
            // User does not have RoleID 4, so they don't have access
            // You can redirect them to an error page or display an error message
            header("location: ../../index.php");
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
    
    <title>Back Up - Utilities</title>

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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../system_admin.php">
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
                        <a class="collapse-item" href="../filemaintenance/file_instructor.php">Instructor</a>
                        <a class="collapse-item" href="../filemaintenance/file_section.php">Section</a>
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
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class="collapse-item" href="accounts.php">Accounts</a>
                        <a class="collapse-item" href="archive.php">Archive</a>
                        <a class="collapse-item active" href="backup.php">Back Up</a>
                        <a class="collapse-item" href="logs.php">Logs</a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
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
                        <h1 class="h3 mb-2 text-gray-800">Backup</h1>
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
                        <div class="card-body">
                              <!-- Switch Button -->
                            
                              
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="backupSwitch" onchange="toggleLabelAndBackup()">
                                <label class="custom-control-label" for="backupSwitch">Manual Backup Database</label>
                            </div>

                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="folder-icon d-flex flex-column align-items-center text-center">
                                            <span>
                                                <i class="fas fa-cloud-download-alt fa-10x"></i>
                                            </span>
                                            <p class="mt-2">
                                                <a href="database/restore.php?file=database/backups/ClassScheduling_backup_TIMESTAMP.sql" download>Restore Database</a>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="folder-icon d-flex flex-column align-items-center text-center">
                                            <span>
                                                <i class="fas fa-cloud-upload-alt fa-10x"></i>
                                            </span>
                                            <p class="mt-2">
                                                <a href="database/backup.php" download>Back Up Database</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr class="my-4">

                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Activity</th>
                                                <th>Date and Time</th>
                                                <th>Action</th>
					                        </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Activity</th>
                                                <th>Date and Time</th>
                                                <th>Action</th> 
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <!--  -->

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
    <script src="../assets/js/switch.js"></script>
 
   
    <script>
        let backupInterval;

        function toggleLabelAndBackup() {
            const backupSwitch = document.getElementById('backupSwitch');
            const label = document.querySelector('label[for="backupSwitch"]');

            if (backupSwitch.checked) {
                label.innerText = 'Automatic Backup Database';
                // Start automatic backup when the switch is turned on
                backupInterval = setInterval(automaticBackup, 10000); // 10000 milliseconds = 10 seconds
            } else {
                label.innerText = 'Manual Backup Database';
                // Stop automatic backup when the switch is turned off
                clearInterval(backupInterval);
            }
        }

        function automaticBackup() {
            // Make an AJAX request to trigger the automatic backup
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'database/backup.php', true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Automatic backup completed successfully.');
                } else {
                    console.error('Error during automatic backup.');
                }
            };

            xhr.send();
        }
        </script>
</body>

</html>
