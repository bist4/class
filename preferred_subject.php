<?php
require('config/db_connection.php');
include('security.php');

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

            <!-- Nav Item - View Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseView"
                    aria-expanded="true" aria-controls="collapseView">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>View Schedule</span>
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
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInstructor"
                    aria-expanded="true" aria-controls="collapseInstructor">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Instructor</span>
                </a>
                <div id="collapseInstructor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item active" href="preferred_subject.php">Preferred Subject</a>
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
                        <h1 class="h3 mb-0 text-gray-800">Preferred Subject</h1>
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
                            <div class="card-header py-3 d-flex justify-content-end">
                                <a href="#" class="d-none d-sm-inline-block btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addschedule">
                                    <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Preffered Subject"></i></span>
                                </a>
                            </div>
                        </div>
                         <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Instructor Name</th>
                                            <th>Subjects</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Instructor Name</th>
                                            <th>Subjects</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            <?php
                                                require('config/db_connection.php');
                                                $table = mysqli_query($conn, "SELECT instructorpreferredsubject.*, subjects.SubjectDescription, instructor.Fname, instructor.Lname FROM instructorpreferredsubject 
                                                INNER JOIN subjects ON instructorpreferredsubject.SubjectID = subjects.SubjectID 
                                                INNER JOIN instructor ON instructorpreferredsubject.InstructorID = instructor.InstructorID
                                                WHERE instructorpreferredsubject.Active = 1 AND instructor.Active=1
                                                ORDER BY instructorpreferredsubject.CreatedAt DESC");

                                                $count = 0;
                                                while ($row = mysqli_fetch_array($table)) {
                                                    $count++;
                                                    $highlightClass = ($count == 1) ? 'text-primary' : '';
                                                ?>
                                                    <tr class="<?php echo $highlightClass; ?>">
                                                        <td><?php echo $count; ?></td>
                                                        <td><?php echo $row['Fname'],' ',$row['Lname']; ?></td>

                                                        <td><?php echo $row['SubjectDescription']; ?></td>
                                                        
                                                        <td>
                                                        <div class="d-flex justify-content-center">
                                                            <!-- <a href="#" class="btn btn-primary mx-2"><i class="fa fa-edit"></i></a> -->
                                                            <a href="#" class="btn btn-danger mx-2 btn-delete" data-instructorpreferredsubject-id="<?php echo $row['InstructorPreferredSubjectID']; ?>">
                                                                <i class="fa fa-trash"></i>
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
            <form action="instructor/add_preferred_subject.php" method="POST"> 
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Preferred Subject</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control" id="department" name="Department" required>
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
                        <!-- <div class="form-group">
                            <label for="instructor">Instructor Name</label>
                            <select class="form-control" id="InstructorID" name="InstructorID" required>
                                <option disabled selected>Select Instruction Name</option>
                                
                                    $sqlInstructor = "SELECT * FROM instructor";
                                    $resultInstructor = $conn->query($sqlInstructor);

                                    if ($resultInstructor->num_rows > 0) {
                                        while ($row = $resultInstructor->fetch_assoc()) {
                                            echo '<option value="' . $row['InstructorID'] . '">' . $row['Fname'] . ' ' . $row['Lname'] . '</option>';
                                        }
                                    }
                                
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label for="instructor">Instructor Name</label>
                            <select class="form-control" id="InstructorID" name="InstructorID" required>
                                <option disabled selected>Select Instructor Name</option>
                                <!-- Options populated dynamically by JavaScript -->
                                
                            </select>
                        </div>

                        <!-- <div class="form-group">
                            <label for="preferred_subjects">Preferred Subjects</label>
                            <select class="form-control" id="SubjectID" name="SubjectID" required>
                                <option disabled selected>Select Subjects</option>
                                <
                                    $sqlSubjects = "SELECT * FROM subjects";
                                    $resultSubjectDescription = $conn->query($sqlSubjects);

                                    if ($resultSubjectDescription->num_rows > 0) {
                                        while ($row = $resultSubjectDescription->fetch_assoc()) {
                                            echo '<option value="' . $row['SubjectID'] . '">' . $row['SubjectDescription'] . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="instructor_specialization">Instructor Specialization</label>
                            <p id="instructorSpecialization">Select an instructor to see their specialization</p>
                        </div>   -->

                        <!-- <div class="form-group">
                            <label for="instructor_specialization">Instructor Specialization</label>
                            <p id="instructorSpecialization">Select an instructor to see their specialization</p>
                            
                        </div> -->


                        <div class="form-group">
                            <label for="preferred_subjects">Preferred Subjects</label>
                            <select class="form-control custome-select" id="SubjectID" name="SubjectID" required>
                                <option disabled selected>Select Subjects</option>
                            </select>
                        </div>


                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="add_btn" name="add_btn" class="btn btn-primary">Save
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>                 
            </form>
        </div>
    </div>


    <!-- Delete Modal -->
    <div class="modal fade" id="deletePreferred" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Instructor preferred subjects</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this instructor preferred siubjects?</p>
                </div>
                <div class="modal-footer">
                    <form action="DataDeleteTime/delete_time.php" method="POST" id="deleteForm">
                        <input type="hidden" name="InstructorTimeAvailabilityID" id="deleteInstructorTimeAvailabilityID">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" id="confirmDeleteButton">Delete</button>
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
 
   <!-- <script>
        $(document).ready(function() {
            $('#department').change(function() {
                var departmentID = $(this).val();

                // Make an AJAX request to fetch instructors for the selected department
                $.ajax({
                    url: 'get_department_id.php',
                    type: 'POST',
                    data: { departmentID: departmentID },
                    success: function(data) {
                        $('#InstructorID').html(data);
                        $('#SubjectID').html(data);
                    }
                });
            });
        });
    </script> -->

    <script>
        $(document).ready(function() {
            $('#department').change(function() {
                var departmentID = $(this).val();

                // Make an AJAX request to fetch instructors for the selected department
                $.ajax({
                    url: 'get_department_id_subject.php',
                    type: 'POST',
                    data: { departmentID: departmentID },
                    success: function(data) {
                        $('#InstructorID').html(data);
                    }
                });

                // Make another AJAX request to fetch subjects for the selected department
                $.ajax({
                    url: 'get_subject.php',
                    type: 'POST',
                    data: { departmentID: departmentID },
                    success: function(data) {
                        $('#SubjectID').html(data);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#InstructorID').change(function() {
                var instructorID = $(this).val();

                // Make an AJAX request to fetch the instructor's specialization
                $.ajax({
                    url: 'get_spec.php',
                    type: 'POST',
                    data: { instructorID: instructorID },
                    success: function(data) {
                        $('#instructorSpecialization').text(data);
                    }
                });
            });
        });

    </script>
    



</body>

</html>