<?php
require('../../config/db_connection.php');
include('../../security.php');// Start the session

// Check if the user is logged in
if (isset($_SESSION['Username'])) {
    $loggedInName = $_SESSION['Username'];

    // Make sure you have a valid database connection here

    // Create an SQL query to get the RoleID and UserID of the logged-in user
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
    
    if (isset($_GET['delid']) && !empty($_GET['delid'])) {
        // Get the rooms IDs from the URL
        $sectionIDs = explode(',', $_GET['delid']);
        $allSectionData = array(); // Initialize an array to store all room data
    
        // Prepare the SQL statement to fetch data for multiple SectionIDs
        $placeholders = str_repeat('?,', count($sectionIDs) - 1) . '?';
        $subsql = "SELECT * FROM rooms WHERE RoomID IN ($placeholders)";
        $stmt = mysqli_prepare($conn, $subsql);
    
        // Bind parameters for each RoomID
        $types = str_repeat('i', count($sectionIDs)); // 'i' represents integer type
        mysqli_stmt_bind_param($stmt, $types, ...$sectionIDs);
    
        // Execute the statement
        mysqli_stmt_execute($stmt);
    
        // Get the result
        $resultsection = mysqli_stmt_get_result($stmt);
    
        if ($resultsection) {
            // Fetch all data for the specified SectionIDs
            while ($secdata = mysqli_fetch_assoc($resultsection)) {
                $allSectionData[] = $secdata;
            }
    
            if (empty($allSectionData)) {
                echo "No room found for the provided IDs";
            }
        } else {
            echo "Error executing the query: " . mysqli_error($conn);
        }
    
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "No room ID provided!";
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
    
    <link rel="icon" href="../../assets/img/logo1.png">
     <!-- Style for icons and fonts -->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <link href="../../assets/css/select2.min.css" rel="stylesheet">
    
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link href="chosen.css" rel="stylesheet">
    
    <title>Delete Room - File Maintenance</title>
    <style>
        /* Hide the up and down arrow for number input */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../system_admin.php">
                <div class="sidebar-brand-icon">
                    <i class="fas">
                        <img src="../../assets/img/logo1.png" alt="logo" width="50" height="50">
                    </i>
                </div>
                <div class="sidebar-brand-text mx-3" style="font-size: 13px">Online Class Scheduling System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../../system_admin.php">
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
                        <a class="collapse-item" href="../../filemaintenance/file_strand.php">Strand</a>
                        <a class="collapse-item" href="../../filemaintenance/file_subject.php">Subject</a>
                        <!-- <a class="collapse-item" href="../../filemaintenance/file_instructor.php">Instructor</a> -->
                        <a class="collapse-item" href="../../filemaintenance/file_section.php">Class Section</a>
                        <a class="collapse-item" href="../../filemaintenance/file_room.php">Room</a>
                        <a class="collapse-item" href="../../filemaintenance/timeAvail.php">Instructor Availability</a>

                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseView"
                    aria-expanded="true" aria-controls="collapseView">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>View Records</span>
                </a>
                <div id="collapseView" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../view_strand.php">Strand</a>
                        <a class="collapse-item" href="../view_subject.php">Subject</a>
                        <a class="collapse-item" href="../view_instructor.php">Instructor</a>
                        <a class="collapse-item" href="../view_section.php">Class Section</a>
                        <a class="collapse-item active" href="../view_room.php">Room</a>
                        <a class="collapse-item" href="../view_timeAvail.php">Instructor Availability</a>

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
                        
                        <a class="collapse-item" href="../utilities/accounts.php">Account Management</a>
                        <a class="collapse-item" href="../utilities/archive.php">Archive</a>
                        <a class="collapse-item" href="../utilities/backup.php">Back Up</a>
                        <a class="collapse-item" href="../utilities/logs.php">Activity History</a>
                        <a class="collapse-item" href="../utilities/trash.php">Trash</a>

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

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Alerts -->
                      

                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="../../img/undraw_profile.svg">
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
                        <h1 class="h3 mb-2 text-gray-800">Room</h1>
                         
                    </div>
                    <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5  class="mb-0">Are you sure you want to delete?</h5>
                             
                        </div>
                        <div class="card-body"> 
                            <form id="updateForm">
                                <input type="hidden" name="RoomID" id="deleteRoomID">
                                <div class="table-responsive">
                                    <table class="table table-hover small-text" id="tb">
                                        <tr class="tr-header">
                                            <th><label class="form-check-label" for="hideSectioNo">Room Number</label></th>
                                            <th><label class="form-check-label" for="hideSectioName">Capacity</label></th>
                                            <th><label class="form-check-label" for="hideAdviser">Room Type Name</label></th>
                                        </tr>
                                        <?php foreach ($allSectionData as $secdata) { ?>
                                            <tr>
                                            <td class="col-md-2">
                                                <input type="number" class="form-control" id="roomNo<?php echo $secdata['RoomID']; ?>" name="RoomNumber[]" value="<?php echo $secdata['RoomNumber']; ?>" disabled>
                                            </td>
                                            <td class="col-md-5">
                                                <input type="text" class="form-control" id="capacity<?php echo $secdata['RoomID']; ?>" name="Capacity[]" placeholder="Enter Subject Name" value="<?php echo $secdata['Capacity']; ?>" required readonly>
                                            </td>
                                            <td class="col-md-5">
                                                <select class="form-control" id="roomType<?php echo $secdata['RoomID']; ?>" name="RoomTypeName[]" required disabled>
                                                    <option disabled>Select Room Type</option>
                                                    <option value="Lecture" <?php if ($secdata['RoomTypeName'] === 'Lecture') echo 'selected'; ?>>Lecture</option>
                                                    <option value="Laboratory" <?php if ($secdata['RoomTypeName'] === 'Laboratory') echo 'selected'; ?>>Laboratory</option>
                                                </select>
                                                <input type="hidden" name="RoomID[]" value="<?php echo $secdata['RoomID']; ?>">
                                            </td>


                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="javascript:history.go(-1);"><button type="button" id="cancelBtn" class="btn btn-outline-secondary mr-2">Cancel</button></a>
                                    <button type="button" id="updateBtn" class="btn btn-danger">Yes</button>
                                </div>
                            </form>
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

                    <form action="../../logout.php" method="POST">
                        <button type="submit"  name="logout_btn" class="btn btn-primary">Logout</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets/js/demo/datatables-demo.js"></script>
    <!-- For filtering of strands details -->
	<script src="../../assets/js/filteringStrand.js"></script>


 
    <!-- Print and Import to Excel -->
    <script src="../../assets/js/DataPrintExcel/print_subject.js"></script>
    <script src="../../assets/js/capitalLetter.js"></script>
 
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script>
        $(document).ready(function() {
            $('#updateBtn').on('click', function() {
                var roomIDs = []; // Array to store StrandIDs

                // Loop through each input field with name RoomID[] and retrieve the values
                $('input[name="RoomID[]"]').each(function() {
                    roomIDs.push($(this).val()); // Push each RoomID into the array
                });

                $.ajax({
                    type: 'POST',
                    url: '../DataDelete/deleteAll_room.php',
                    data: { roomIDs: roomIDs },
                    success: function (response) {
                        // Handle success response
                        Swal.fire({
                            title: "Success!",
                            text: "Room deleted successfully",
                            icon: "success"
                        }).then(function () {
                            // Redirect after successful deletion
                            window.location.href = '../view_room.php';
                        });
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        Swal.fire({
                            title: "Error!",
                            text: "Failed to delete room. Try again.",
                            icon: "error"
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>








