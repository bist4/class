<?php
require('../config/db_connection.php');
include('../security.php');// Start the session

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
        
        <link rel="icon" href="../assets/img/logo1.png">
        <!-- Style for icons and fonts -->
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <link href="chosen.css" rel="stylesheet">
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
        <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <title>Account Management - Utilities</title>

        
       

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
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>File Maintenance</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../filemaintenance/file_strand.php">Strand</a>
                            <a class="collapse-item" href="../filemaintenance/file_subject.php">Subject</a>
                            <a class="collapse-item" href="../filemaintenance/file_instructor.php">Instructor</a>
                            <a class="collapse-item" href="../filemaintenance/file_section.php">Class Section</a>
                            <a class="collapse-item" href="../filemaintenance/file_room.php">Room</a>
                            <a class="collapse-item" href="../filemaintenance/timeAvail.php">Instructor Availability</a>

                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseView"
                        aria-expanded="true" aria-controls="collapseView">
                        <i class="fas fa-fw fa-eye"></i>
                        <span>View Records</span>
                    </a>
                    <div id="collapseView" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../records/view_strand.php">Strand</a>
                            <a class="collapse-item" href="../records/view_subject.php">Subject</a>
                            <a class="collapse-item" href="../records/view_instructor.php">Instructor</a>
                            <a class="collapse-item" href="../records/view_section.php">Class Section</a>
                            <a class="collapse-item" href="../records/view_room.php">Room</a>
                            <a class="collapse-item" href="../records/view_timeAvail.php">Instructor Availability</a>

                        </div>
                    </div>
                </li>


                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item active">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Utilities</span>
                    </a>
                    <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            
                            <a class="collapse-item active" href="accounts.php">Account Management</a>
                            <a class="collapse-item" href="archive.php">Archive</a>
                            <a class="collapse-item" href="backup.php">Back Up</a>
                            <a class="collapse-item" href="logs.php">Activity History</a>
                            <a class="collapse-item" href="trash.php">Trash</a>

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
                            <h1 class="h3 mb-2 text-gray-800">Account Management</h1>
                            <div>
                                
                            </div>
                        </div>
                    
                        

                        
                        
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            
                            <div class="card-header py-3">
                                <div class="d-flex justify-content-start">
                                   
                                    
                                </div>
                                <div class="dropdown d-flex justify-content-end">
                                    <button class="btn btn-secondary" type="button" title="Add New User" data-toggle="modal" data-target="#addDataForm">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addAccount2">Add User Info</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addAccount4">Add User Role</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addAccount3">Add Instructor Specialization</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addAccount5">Add Instructor Department</a>
                                    </div> -->
                                </div>

                                <!-- <div class="card-header py-3 d-flex justify-content-end">
                                    <a href="#" data-toggle="modal" data-target="#addAccount2">
                                        <span class="">Add New Account</span>
                                    </a>
                                </div> -->
                                <!-- <div class="card-header py-3 d-flex justify-content-end">
                                    <a href="#" class="d-none d-sm-inline-block btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addAccount">
                                        <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Account"></i></span>
                                    </a>
                                </div> -->
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>User Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            require('../config/db_connection.php');
                                            $table = mysqli_query($conn, "SELECT usi.*, ust.UserTypeName
                                            FROM userinfo usi 
                                            INNER JOIN usertypes ust ON usi.UserTypeID = ust.UserTypeID
                                            WHERE 
                                                Active = 1");

                                        $count = 0;
                                        // Initialize arrays outside of the loop
                                        $userTypes = array(); 
                                        $userDep = array();

                                        while ($row = mysqli_fetch_array($table)) {
                                            $count++;
                                            $lockAccountValue = $row['is_Lock_Account'];
                                            $RolesUser = $row['UserTypeName'];
                                            $highlightClass = ($count == 1) ? 'text-primary' : '';

                                            $userID = $row['UserInfoID'];

                                            // Fetch user roles for the current user
                                            $rolesQuery = mysqli_query($conn, "SELECT UserTypeName FROM usertypes INNER JOIN userinfo ON usertypes.UserTypeID = userinfo.UserTypeID WHERE userinfo.UserInfoID = $userID");
                                            // $depQuery = mysqli_query($conn, "SELECT DepartmentTypeName FROM departmenttypename INNER JOIN userdepartment ON departmenttypename.DepartmentTypeNameID = userdepartment.DepartmentID WHERE userdepartment.UserID = $userID");
                                            
                                            // Reset arrays before populating them
                                            $userTypes = array();
                                            // $userDep = array();
                                            
                                            while ($roleRow = mysqli_fetch_array($rolesQuery)) {
                                                $userTypes[] = $roleRow['UserTypeName'];
                                            }
                                            
                                            // while ($depRow = mysqli_fetch_array($depQuery)) {
                                            //     $userDep[] = $depRow['DepartmentTypeName'];
                                            // }
                                        ?>
                                        <tr class="<?php echo $highlightClass; ?>">
                                            <td><?php echo $row['Username']; ?></td>
                                            <td><?php echo $row['Email']; ?></td>
                                            <td>
                                                <?php
                                                if (!empty($userTypes)) {
                                                    foreach ($userTypes as $userType) {
                                                        echo $userType . "<br>";
                                                    }
                                                } else {
                                                    echo "N/A";   
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['is_Lock_Account'] == 1) {
                                                    echo "Deactive";
                                                } else {
                                                    echo "Active";
                                                }
                                                ?>
                                            </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">

                                                        <a href="EditUser/edit_user.php?subid=<?php echo $row['UserInfoID']; ?>">
                                                            <button class="btn btn-primary mx-2"> 
                                                                <i class="fa fa-edit"></i>
                                                            </button>        
                                                        </a>
                                                        

                                                        <!-- <button class="btn btn-info" data-toggle="modal" data-target="#viewAccounts" title="View" data-user-id="<?php echo $row['UserID']; ?>"><i class="fas fa-eye"></i></button> -->
                                                        <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal" title="View" 
                                                            data-user-id="<?php echo $row['UserInfoID']; ?>"
                                                            data-fname="<?php echo $row['Fname']; ?>"
                                                            data-mname="<?php echo $row['Mname']; ?>"
                                                            data-lname="<?php echo $row['Lname']; ?>"
                                                            data-birthdate="<?php echo $row['Birthday']; ?>"
                                                            data-cnumber="<?php echo $row['ContactNumber']; ?>"
                                                            data-address="<?php echo $row['Address']; ?>"
                                                            data-gender="<?php echo $row['Gender']; ?>"
                                                            data-instructor="<?php echo $row['is_Instructor']; ?>"
                                                            data-sda="<?php echo $row['is_SchoolDirectorAssistant']; ?>"
                                                            data-sd="<?php echo $row['is_SchoolDirector']; ?>"
                                                            data-role="<?php echo $row['UserTypeName']; ?>">

                                                            
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn <?php echo ($lockAccountValue == 1) ? 'btn-danger' : 'btn-success'; ?> mx-2 btn-toggle"
                                                                data-toggle="modal"
                                                                data-target="#confirmationModal"
                                                                data-user-id="<?php echo $row['UserInfoID']; ?>"
                                                                data-fname="<?php echo $row['Fname']; ?>"
                                                                data-mname="<?php echo $row['Mname']; ?>"
                                                                data-lname="<?php echo $row['Lname']; ?>"
                                                                data-birthdate="<?php echo $row['Birthday']; ?>"
                                                                data-cnumber="<?php echo $row['ContactNumber']; ?>"
                                                                data-address="<?php echo $row['Address']; ?>"
                                                                data-gender="<?php echo $row['Gender']; ?>"
                                                                data-role="<?php echo $row['UserTypeName']; ?>">
                                                            <i class="fas <?php echo ($lockAccountValue == 1) ? 'fa-lock' : 'fa-unlock'; ?>" data-placement="top"></i>
                                                        </button>

                                                        <!-- <button class="btn btn-secondary" title="Edit"><i class="fas fa-edit"></i></button> -->
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

        <!-- View Information Modal -->
        <div class="modal fade" id="exampleModal" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBody">
                        <!-- Information will be displayed here -->
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Modal Form -->
        <div class="modal fade" id="addDataForm" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="addDataFormLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input type="text" class="form-control" id="fname" name="fname" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="mname">Middle Name:<span class="small">(optional)</span></label>
                                <input type="text" class="form-control" id="mname" name="mname">
                            </div>
                            
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input type="text" class="form-control" id="lname" name="lname" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="birthday">Birthday:</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" required>
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value = "">Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                        
                                </select>
                            </div> 

                            
                            <div class="form-group">
                                <label for="contact">Contact Number:</label>
                                <input type="text" class="form-control" id="contact" name="contact" pattern="[0-9]{11}" placeholder="Enter a valid 11-digit contact number" required>
                                <div class="invalid-feedback">
                                    Please enter a valid 11-digit contact number <br> Example: 09123456789
                                </div>           
                            </div>

                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email.
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                <div class="invalid-feedback">
                                Must contain at least one number, one uppercase letter, one lowercase letter, and be at least 8 characters long. 
                                Example: MyUsername123
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                <progress max="100" value="0" id="password-strength"></progress>
                                <p id="password-strength-text"></p>
                                <div class="invalid-feedback">
                                Must contain at least one number, one uppercase letter, one lowercase letter, and be at least 8 characters long. 
                                Example: MyP@ssword123
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="instructor">Are you an instructor?</label>
                                <input type="checkbox" id="instructor" name="instructor">
                            </div>
                            
                            <div class="form-group">
                                <label for="school_director">Are you a school director?</label>
                                <input type="checkbox" id="school_director" name="school_director">
                            </div>
                            
                            <div class="form-group">
                                <label for="school_director_assistant">Are you a school director assistant?</label>
                                <input type="checkbox" id="school_director_assistant" name="school_director_assistant">
                            </div>
                            
                            <div id="instructor_fields" style="display: none;">
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <!-- <input type="text" class="form-control" id="status" name="status"> -->
                                    <select class="form-control" id="status" name="status"  title="Select Status" required>
                                        <option value="">Select Status</option>
                                        <option value="1">Full-Time</option>
                                        <option value="0">Part-Time</option>
                                    </select>   
                                </div>
                                
                                <div class="form-group">
                                    <label for="primary">Primary School:</label>
                                    <input type="checkbox" id="primary" name="primary">
                                </div>
                                
                                <div class="form-group">
                                    <label for="juniorhigh">Junior High School:</label>
                                    <input type="checkbox" id="juniorhigh" name="juniorhigh">
                                </div>
                                
                                <div class="form-group">
                                    <label for="seniorhigh">Senior High School:</label>
                                    <input type="checkbox" id="seniorhigh" name="seniorhigh">
                                </div>
                                
                                <div class="form-group" id="specializationFields">
                                    <label for="specializations">Specializations:</label>
                                    <input type="text" class="form-control specialization" id="specialization" name="specializations[]" required>
                                </div>
                                <button type="button" class="btn btn-primary" id="addMoreButton" >Add More Specialization</button>

                            </div>
                            
                            <br>
                            <input type="submit" class="btn btn-primary" id="addButton" value="Submit">
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
    
<!-- 
    <script>
        const passwordInput = document.getElementById("Password");
        const progressBar = document.getElementById("password-strength");
        const progressText = document.getElementById("password-strength-text");

        passwordInput.addEventListener("input", function () {
            const password = passwordInput.value;
            const score = calculatePasswordStrength(password);
            const progressBarValue = (score / 4) * 100;
            progressBar.value = progressBarValue;

            let strengthText = getStrengthText(score);
            progressText.innerText = "Password Strength: " + strengthText;
        });

        function calculatePasswordStrength(password) {
            // Implement your password strength calculation logic here.
            // You can count the number of characters, check for uppercase, lowercase, digits, special characters, etc.
            // Return a score or value representing the strength.
            // This is a simplified example; you can customize it further.
            return password.length;
        }

        function getStrengthText(score) {
            if (score < 4) {
                return "Very Weak";
            } else if (score < 8) {
                return "Weak";
            } else if (score < 12) {
                return "Moderate";
            } else if (score < 16) {
                return "Strong";
            } else {
                return "Very Strong";
            }
        }
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

 
    
    
    <!-- Lock Account -->
    <script>
        $(document).ready(function() {
        let userID, lockAccountValue;

        $('.btn-toggle').on('click', function() {
            userID = $(this).data('user-id');
            lockAccountValue = $(this).hasClass('btn-danger') ? 1 : 0;

            // Show confirmation modal before locking account
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to lock this account?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    lockAccount(); // Call the function to lock the account
                }
            });
        });

        function lockAccount() {
            // Set up AJAX call to send the user ID to the PHP script
                $.ajax({
                    type: 'POST',
                    url: 'process/lock_account.php', // Replace with your PHP endpoint
                    data: { userId: userID },
                    success: function(response) {
                        // Handle the response (e.g., show a success message)
                        Swal.fire({
                            icon: 'success',
                            title: 'Account Locked',
                            text: 'The account has been successfully locked!'
                        }).then(function() {
                            location.reload(); // Reload the page after locking
                        });
                    },
                    error: function(err) {
                        // Handle errors, if any
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to lock the account. Please try again.'
                        });
                    }
                });
            }
        });

    </script>


    <!--Account unLocked  -->
    <script>
        $(document).ready(function() {
            $('.btn-toggle').click(function() {
                var icon = $(this).find('i');
                var lockAccountValue = <?php echo $lockAccountValue; ?>; // Set the initial lock status here

                // Check if the icon class is fa-lock
                if (icon.hasClass('fa-lock')) {
                    // Show SweetAlert for confirmation
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you want to unlock this account?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Perform AJAX request to update lock status to 0
                            var userID = $(this).data('user-id');
                            $.ajax({
                                type: 'POST',
                                url: 'process/update_lock_status.php', // Change this to your PHP script to handle the update
                                data: {
                                    userID: userID,
                                    lockStatus: 0 // Set the lock status to 0 (unlocked)
                                },
                                success: function(response) {
                                    // Update the icon and show a success message
                                    icon.removeClass('fa-lock').addClass('fa-unlock');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Account Unlocked',
                                        text: 'The account has been successfully unlocked!',
                                        confirmButtonColor: '#3085d6',
                                    }).then(function() {
                                        location.reload(); // Reload the page after locking
                                    });
                                    // You might want to update other UI elements or perform additional actions
                                },
                                error: function(xhr, status, error) {
                                    // Handle errors if any
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>


    <script src="chosen.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".blogcat").chosen();
    </script>



    <!-- Progress Bar for Password -->
    <script>
        const passwordInput = document.getElementById("password");
        const progressBar = document.getElementById("password-strength");
        const progressText = document.getElementById("password-strength-text");

        passwordInput.addEventListener("input", function () {
            const password = passwordInput.value;
            const score = calculatePasswordStrength(password);
            const progressBarValue = (score / 4) * 100;
            progressBar.value = progressBarValue;

            let strengthText = getStrengthText(score);
            progressText.innerText = "Password Strength: " + strengthText;
        });

        function calculatePasswordStrength(password) {
            // Implement your password strength calculation logic here.
            // You can count the number of characters, check for uppercase, lowercase, digits, special characters, etc.
            // Return a score or value representing the strength.
            // This is a simplified example; you can customize it further.
            return password.length;
        }

        function getStrengthText(score) {
            if (score < 4) {
                return "Very Weak";
            } else if (score < 8) {
                return "Weak";
            } else if (score < 12) {
                return "Moderate";
            } else if (score < 16) {
                return "Strong";
            } else {
                return "Very Strong";
            }
        }
    </script>

        

  
    <!-- View Info -->
    <script>
        $(document).ready(function() {
            $('.btn-info').click(function() {
                // Get data attributes from the clicked button
                // var userId = $(this).data('user-id');
                var fname = $(this).data('fname');
                var mname = $(this).data('mname');
                var lname = $(this).data('lname');
                var birthdate = $(this).data('birthdate');
                var cnumber = $(this).data('cnumber');
                var address = $(this).data('address');
                var gender = $(this).data('gender');
                var role = $(this).data('role');

                var position = [
                    $(this).data('instructor'),
                    $(this).data('sda'),
                    $(this).data('sd')
                ]
                
                var pos = '';

                if (position[0] === 1) {
                    pos += 'Instructor';
                }
                if (position[1] === 1) {
                    if (pos !== '') pos += ', ';
                    pos += 'School Director Assistant';
                }
                if (position[2] === 1) {
                    if (pos !== '') pos += ', ';
                    pos += 'School Director';
                }
               

                // var department = $(this).data('department')
                

                // Construct HTML with the information
                var content = '<label style="font-size:1.5em;">'+ 'Personal Information' + '</label>' +
                            '<p>First Name: ' + fname + '</p>' +
                            '<p>Middle Name: ' + mname + '</p>' +
                            '<p>Last Name: ' + lname + '</p>' +
                            '<p>Birthday: ' + birthdate + '</p>' +
                            '<p>Gender: ' + gender + '</p>' +
                            '<label style="font-size:1.5em;">'+ 'Contact Information' + '</label>' +
                            '<p>Contact Number: ' + cnumber + '</p>' +
                            '<p>Address: ' + address + '</p>' +
                            //   '<label style="font-size:1.5em;">'+ 'Other Information' + '</label>' +
                            //   '<p>Department: ' + department + '</p>';

                            '<p>Role: ' + role + '</p>' +
                            '<p>Position: ' + pos + '</p>' ;
                    
                            

                // Insert the HTML into the modal body
                $('#modalBody').html(content);
            });
        });
    </script>
 
 

    <!-- Validation Form -->
    <script>
    // JavaScript for form validation
        (function () {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
            });
        })(); 
    </script>

      <!-- Add data -->
      <script>
        $(document).ready(function(){
            $('#instructor').change(function() {
                var instructorFields = $('#instructor_fields');
                instructorFields.toggle($(this).is(':checked'));
            });

            $('#addButton').click(function(e){
                e.preventDefault();
                var form = $('.needs-validation')[0];
                if (form.checkValidity()) {
                    var formData = new FormData(form);
                    var loading = Swal.fire({
                        title: 'Please wait',
                        html: 'Submitting your data...',
                        allowOutsideClick: false,
                        showConfirmButton: false, 
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: 'submit_second_form.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response){
                            response = JSON.parse(response);
                            loading.close(); // Close loading animation
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.success,
                                }).then(function() {
                                    window.location.href = 'accounts.php';
                                });
                            } else if (response.error) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Warning',
                                    text: response.error,
                                });
                            }
                        },
                        error: function() {
                            loading.close(); // Close loading animation
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while submitting data.',
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please fill in all required fields.'
                    });
                }
                form.classList.add('was-validated');
            });
        });
    </script>




    <!-- Add more Specialziations -->
    <script>
        document.getElementById('addMoreButton').addEventListener('click', function() {
            // Create a new specialization text field
            var newSpecializationField = document.createElement('div');
            newSpecializationField.classList.add('form-group');
            newSpecializationField.innerHTML = `
                <input type="text" id="specialization" class="form-control specialization" name="specializations[]" placeholder="Enter specialization" required>
            `;
            
            // Append the new text field to the specializationFields div
            document.getElementById('specializationFields').appendChild(newSpecializationField);

            // Scroll the modal to the bottom
            var modalBody = document.querySelector('#secondModal .modal-body');
            modalBody.scrollTop = modalBody.scrollHeight;
        });
    </script>




    

</body>
</html>
