<?php
require('../config/db_connection.php');
include('../security.php');// Start the session

// Check if the user is logged in
if (isset($_SESSION['Username'])) {
    $loggedInName = $_SESSION['Username'];

    // Make sure you have a valid database connection here

    // Create an SQL query to get the RoleID and UserID of the logged-in user
    $query = "SELECT usr.RoleID, usi.lock_account FROM userroles usr
    INNER JOIN userinfo usi ON usr.UserID = usi.UserInfoID
    WHERE Username = '$loggedInName'";
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
                            <h1 class="h3 mb-2 text-gray-800">Account</h1>
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
                                     <a href="#" class="d-none d-sm-inline-block btn btn-danger btn-icon-split" data-toggle="modal" data-target="#addAccount2">
                                        <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Account"></i></span>
                                    </a>
                                    <a href="#" class="d-none d-sm-inline-block btn btn-info btn-icon-split" data-toggle="modal" data-target="#addAccount4">
                                        <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Roles"></i></span>
                                    </a>
                                    <a href="#" class="d-none d-sm-inline-block btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addAccount5">
                                        <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Department"></i></span>
                                    </a>
                                    <br>
                                    <a href="#" class="d-none d-sm-inline-block btn btn-success btn-icon-split" data-toggle="modal" data-target="#addAccount3">
                                        <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Specialization"></i></span>
                                    </a>
                                </div>
                                <div class="card-header py-3 d-flex justify-content-end">
                                    <a href="#" class="d-none d-sm-inline-block btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addAccount">
                                        <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Account"></i></span>
                                    </a>
                                </div>
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
                                                $table = mysqli_query($conn, "SELECT users.*, users.lock_account, roles.Roles FROM users 
                                                                INNER JOIN roles ON users.RoleID = roles.RoleID
                                                                
                                                                WHERE users.Active=1 AND roles.Roles != 'System Administrator' ORDER BY users.CreatedAt DESC");

                                                $count = 0;
                                                $userTypes = array(); // Associative array to store user types for each username

                                                while ($row = mysqli_fetch_array($table)) {
                                                    $count++;
                                                    $lockAccountValue = $row['lock_account'];
                                                    $highlightClass = ($count == 1) ? 'text-primary' : '';

                                                    $key = $row['Fname'] . $row['Mname'] . $row['Lname'] . $row['Username'] . $row['Email']. $row['Specialization'] . $row['Status'];
                                                    if (!isset($userTypes[$key])) {
                                                        $userTypes[$key] = $row['Roles'];
                                                    } else {
                                                        $userTypes[$key] .= ', ' . $row['Roles'];
                                                    }
                                                    
                                                ?>
                                                    <tr class="<?php echo $highlightClass; ?>">
                                                        <td><?php echo $row['Username']; ?></td>
                                                        <td><?php echo $row['Email']; ?></td>
                                                        <td><?php echo $userTypes[$key]; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($row['lock_account'] == 1) {
                                                                echo "Deactive";
                                                            } else {
                                                                echo "Active";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <!-- <button class="btn btn-info" data-toggle="modal" data-target="#viewAccounts" title="View" data-user-id="<?php echo $row['UserID']; ?>"><i class="fas fa-eye"></i></button> -->
                                                                <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal" title="View" 
                                                                    data-user-id="<?php echo $row['UserID']; ?>"
                                                                    data-fname="<?php echo $row['Fname']; ?>"
                                                                    data-mname="<?php echo $row['Mname']; ?>"
                                                                    data-lname="<?php echo $row['Lname']; ?>"
                                                                    data-birthdate="<?php echo $row['BirthDate']; ?>"
                                                                    data-cnumber="<?php echo $row['ContactNumber']; ?>"
                                                                    data-address="<?php echo $row['Address']; ?>"
                                                                    data-gender="<?php echo $row['Gender']; ?>"
                                                                    data-department="<?php echo $row['DepartmentID']; ?>"
                                                                    data-role="<?php echo $row['Roles']; ?>">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button class="btn <?php echo ($lockAccountValue == 1) ? 'btn-danger' : 'btn-success'; ?> mx-2 btn-toggle"
                                                                        data-toggle="modal"
                                                                        data-target="#confirmationModal"
                                                                        data-user-id="<?php echo $row['UserID']; ?>"
                                                                        data-fname="<?php echo $row['Fname']; ?>"
                                                                        data-mname="<?php echo $row['Mname']; ?>"
                                                                        data-lname="<?php echo $row['Lname']; ?>"
                                                                        data-birthdate="<?php echo $row['BirthDate']; ?>"
                                                                        data-cnumber="<?php echo $row['ContactNumber']; ?>"
                                                                        data-address="<?php echo $row['Address']; ?>"
                                                                        data-gender="<?php echo $row['Gender']; ?>"
                                                                        data-role="<?php echo $row['Roles']; ?>">
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






        <!-- Add Room Modal -->
        <div class="modal fade" id="addAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="process/new_account.php" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Accounts</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="userType">User Type</label>
                                <select class="form-control blogcat"multiple id="Roles" name="Roles[]"  required title="Select User Type">
                                    <option disabled selected>Role</option>
                                    
                                    <?php
                                        $Roles = "SELECT * FROM roles";
                                        $resultRoles = $conn->query($Roles);

                                        if ($resultRoles->num_rows > 0) {
                                            while ($row = $resultRoles->fetch_assoc()) {
                                                $role = $row['Roles'];
                                                
                                                // Check if the role is 'System Administrator' and skip it
                                                if ($role == 'System Administrator') {
                                                    continue;
                                                }
                                                
                                                echo '<option value="' . $row['RoleID'] . '">' . $role . '</option>';
                                            }
                                        }
                                    ?>

                                </select>
						    </div>
                            
                            <div>
                                <label for="title" style="font-size:1.5em;">Personal Information</label>
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="Fname" name="Fname"  placeholder="Enter your First Name" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="middleName">Middle Name<span class="small">(optional)</span></label>
                                    <input type="text" class="form-control" id="Mname" name="Mname"  placeholder="Enter your Middle Name" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="Lname" name="Lname"  placeholder="Enter your Last Name" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="birthDate">Date of Birth</label>
                                    <input type="date" class="form-control" id="Bday" name="Bday"  placeholder="Enter your Date of Birth" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option disabled selected>Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div> 
                            </div> 

                            <div>
                                
                                <label for="contact"  style="font-size:1.5em;">Contact Information</label>
                                <div class="form-group">
                                    <label for="mobileNumber">Mobile Number</label>
                                    <input type="tel" class="form-control" id="mobile" name="Cnumber" pattern="[0-9]{11}" placeholder="Enter a valid 11-digit mobile number" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="tel" class="form-control" id="address" name="address" placeholder="Enter address" required autofocus>
                                </div>
                            </div>
                            
                            <div id="instructorInfo" >
                                <label for="other"  style="font-size:1.5em;">Other Information</label>
                                <span class="small">(This is only for Instructor)</span>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control specs" name="" id="testDep" disabled>
                                        <option value="" disabled selected>Select Department</option>
                                        <option value="5" selected>Select Department</option>

                                    </select>
                                    <input type="hidden" name="Department[]" value="5">
                                    <div id="showDep" style="display:none">
                                    <select class="form-control blogcat dep" name="Department[]" id="department" title="Select Department" multiple>
                                    <!-- <select class="form-control blogcat dep" multiple name="Department[]" id="department" title="Select Department"  > -->
                                        <!-- Department options -->
                                        <option value="" disabled selected>Select Department</option>
                                        <?php
                                            include('../config/db_connection.php');
                                            
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
                                   
                                    
                                </div>  
                                <div class="form-group">
                                    <label for="specialization">Specialization</label>
                                    <select class="form-control specs" name="spec" id="testSpec" disabled>
                                        <option value="" disabled selected>Select Specialization</option>
                                        <option value="N/A">Select Specialization</option>
                                    </select>
                                    <input type="hidden" name="Specialization[]" value="N/A">
                                    <div id="showSpec" style="display:none">
                                    <select class="form-control blogcat specs" name="Specialization[]" id="specialization" title="Input Specialization" multiple>
                                    <!-- <select class="form-control blogcat specs" multiple name="Specialization[]" id="specialization"  title="Input Specialization" > -->
                                        <option value="" disabled selected>Select Specialization</option>
                                        <?php
                                            require('../config/db_connection.php');
                                            $sql = "SELECT DISTINCT Classification FROM subjects";

                                            $classfication = $conn->query($sql);


                                            if ($classfication->num_rows > 0) {
                                                while ($row = $classfication->fetch_assoc()) {
                                                    echo '<option value="'.$row['Classification'].'">'.$row['Classification'].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    </div>

                                    <!-- <input type="text" class="form-control" id="Specialization" name="Specialization" placeholder="Enter Specialization" required title="Input Specialization" oninput="validateNoSpace(this)"> -->
                                </div>
 
                                <input type="hidden" name="Status" value="N/A">

                                <div class="form-group" id="showStat">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="Status"  title="Select Status" disabled>
                                        <option value=" " disabled selected>Select Status</option>
                                        <option value="Full Time">Full-Time</option>
                                        <option value="Part Time">Part-Time</option>
                                    </select>
                                </div> 

                              

                            </div>
                            

                            <div>
                                <label for="accountInfo" style="font-size:1.5em;">Account Information</label>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Valid Email" required autofocus>
                                </div>   

                                
                                
                                    

                                <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" class="form-control" id="Username" name="Username" placeholder="Enter your Username" required autofocus 
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must contain at least one number, one uppercase letter, one lowercase letter, and be at least 8 characters long. 
                                        Example: MyUsername123">
                                </div>

                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter your Password" required autofocus 
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must contain at least one number, one uppercase letter, one lowercase letter, and be at least 8 characters long. 
                                        Example: MyP@ssw0rd">
                                    <progress max="100" value="0" id="password-strength"></progress>
                                    <p id="password-strength-text"></p>
                                </div>
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


        <!-- Add Roles -->
         
        <div class="modal fade" id="addAccount4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="process/new_roles.php" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Accounts</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="userType">User</label>
                                <select class="form-control" id="User" name="User"  required title="Select User">
                                    <option disabled selected>Select User</option>
                                    
                                    <?php
                                        $Roles = "SELECT * FROM userinfo";
                                        $resultRoles = $conn->query($Roles);

                                        if ($resultRoles->num_rows > 0) {
                                            while ($row = $resultRoles->fetch_assoc()) {
                                                
                                                
                                                
                                                
                                                echo '<option value="' . $row['UserInfoID'] . '">' .$row['Fname']. '</option>';
                                            }
                                        }
                                    ?>

                                </select>
						    </div>
                            
                            

                            
                            
                            <div class="form-group">
                                <label for="userType">User Type</label>
                                <select class="form-control blogcat"multiple id="Roles" name="Roles[]"  required title="Select User Type">
                                    <option disabled selected>Role</option>
                                    
                                    <?php
                                        // $Roles = "SELECT * FROM roles";
                                        $Roles = "SELECT DISTINCT Roles, RoleID FROM roles";
                                        $resultRoles = $conn->query($Roles);

                                        if ($resultRoles->num_rows > 0) {
                                            while ($row = $resultRoles->fetch_assoc()) {
                                                $role = $row['Roles'];
                                                
                                                // Check if the role is 'System Administrator' and skip it
                                                if ($role == 'System Administrator') {
                                                    continue;
                                                }
                                                
                                                echo '<option value="' . $row['RoleID'] . '">' . $role . '</option>';
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

        <!-- Add Department -->
        <div class="modal fade" id="addAccount5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="process/new_dep.php" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Accounts</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="userType">User</label>
                                <select class="form-control" id="User" name="User"  required title="Select User">
                                    <option disabled selected>Select User</option>
                                    
                                    <?php
                                        $Roles = "SELECT * FROM userinfo";
                                        $resultRoles = $conn->query($Roles);

                                        if ($resultRoles->num_rows > 0) {
                                            while ($row = $resultRoles->fetch_assoc()) {
                                                
                                                
                                                
                                                
                                                echo '<option value="' . $row['UserInfoID'] . '">' .$row['Fname']. '</option>';
                                            }
                                        }
                                    ?>

                                </select>
						    </div>
                            
                            

                            
                            
                            <div class="form-group">
                                <label for="userType">User Type</label>
                                <select class="form-control blogcat dep" name="Department[]" id="department" title="Select Department" multiple>
                                    <option value="" disabled selected>Select Department</option>
                                    <?php
                                        include('../config/db_connection.php');
                                        
                                        $sqlDepartmentType = "SELECT DISTINCT DepartmentTypeName, DepartmentTypeNameID FROM departmenttypename";
                                        $resultDepartmentTypeName = $conn->query($sqlDepartmentType);
                                        if ($resultDepartmentTypeName->num_rows > 0) {
                                            while ($row = $resultDepartmentTypeName->fetch_assoc()) {
                                                echo '<option value="' . $row['DepartmentTypeNameID'] . '">' . $row['DepartmentTypeName'] . '</option>';
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


        <!-- Add Specialization -->
        <div class="modal fade" id="addAccount3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="process/new_spec.php" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Accounts</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="userType">User</label>
                                <select class="form-control" id="User" name="User"  required title="Select User">
                                    <option disabled selected>Select User</option>
                                    
                                    <?php
                                        $Roles = "SELECT * FROM userinfo";
                                        $resultRoles = $conn->query($Roles);

                                        if ($resultRoles->num_rows > 0) {
                                            while ($row = $resultRoles->fetch_assoc()) {
                                                
                                                
                                                
                                                
                                                echo '<option value="' . $row['UserInfoID'] . '">' .$row['Fname']. '</option>';
                                            }
                                        }
                                    ?>

                                </select>
						    </div>
                            
                            

                            
                            
                            <div id="instructorInfo" >
                                 
                                 
                                <div class="form-group">
                                    <label for="specialization">Specialization</label>
                                     
                                    <div id="showSpec">
                                    <select class="form-control blogcat specs" name="Specialization[]" id="specialization" title="Input Specialization" multiple>
                                    <!-- <select class="form-control blogcat specs" multiple name="Specialization[]" id="specialization"  title="Input Specialization" > -->
                                        <option value="" disabled selected>Select Specialization</option>
                                        <?php
                                            require('../config/db_connection.php');
                                            $sql = "SELECT DISTINCT ClassificationName, ClassificationID FROM classification";

                                            $classfication = $conn->query($sql);


                                            if ($classfication->num_rows > 0) {
                                                while ($row = $classfication->fetch_assoc()) {
                                                    echo '<option value="'.$row['ClassificationID'].'">'.$row['ClassificationName'].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    </div>

                                    <!-- <input type="text" class="form-control" id="Specialization" name="Specialization" placeholder="Enter Specialization" required title="Input Specialization" oninput="validateNoSpace(this)"> -->
                                </div>
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

        <!-- Add Room Modal -->
        <div class="modal fade" id="addAccount2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="process/new_account.php" method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Accounts</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            
                            <div>
                                <label for="title" style="font-size:1.5em;">Personal Information</label>
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="Fname" name="Fname"  placeholder="Enter your First Name" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="middleName">Middle Name<span class="small">(optional)</span></label>
                                    <input type="text" class="form-control" id="Mname" name="Mname"  placeholder="Enter your Middle Name" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="Lname" name="Lname"  placeholder="Enter your Last Name" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="birthDate">Date of Birth</label>
                                    <input type="date" class="form-control" id="Bday" name="Bday"  placeholder="Enter your Date of Birth" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option disabled selected>Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div> 

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="Status"  title="Select Status">
                                        <option value=" " disabled selected>Select Status</option>
                                        <option value="Full Time">Full-Time</option>
                                        <option value="Part Time">Part-Time</option>
                                    </select>
                                </div> 
                            </div> 

                            <div>
                                
                                <label for="contact"  style="font-size:1.5em;">Contact Information</label>
                                <div class="form-group">
                                    <label for="mobileNumber">Mobile Number</label>
                                    <input type="tel" class="form-control" id="mobile" name="Cnumber" pattern="[0-9]{11}" placeholder="Enter a valid 11-digit mobile number" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="tel" class="form-control" id="address" name="address" placeholder="Enter address" required autofocus>
                                </div>
                            </div>
                            
                             
                            

                            <div>
                                <label for="accountInfo" style="font-size:1.5em;">Account Information</label>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Valid Email" required autofocus>
                                </div>   

                                
                                
                                    

                                <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" class="form-control" id="Username" name="Username" placeholder="Enter your Username" required autofocus 
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must contain at least one number, one uppercase letter, one lowercase letter, and be at least 8 characters long. 
                                        Example: MyUsername123">
                                </div>

                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter your Password" required autofocus 
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must contain at least one number, one uppercase letter, one lowercase letter, and be at least 8 characters long. 
                                        Example: MyP@ssw0rd">
                                    <progress max="100" value="0" id="password-strength"></progress>
                                    <p id="password-strength-text"></p>
                                </div>
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



        <!-- Delete Room Modal -->
        <div class="modal fade" id="deleteRoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Room</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Room?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="DataDelete/delete_room.php" method="POST" id="deleteForm">
                            <input type="hidden" name="RoomID" id="deleteRoomID">
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
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".blogcat").chosen();
    </script>

        

     <script>
        $(document).ready(function () {
            $("#Roles").change(function () {
                var selectedRole = $("#Roles").val();
                var departmentSelect = $("#department");
                var specializationSelect = $("#specialization");
                var statusSelect = $("#status");


                var testDep = $('#testDep');
                var testSpec = $('#testSpec');
                var testStat = $('#testStat');

                var showDep = $('#showDep');
                var showSpec = $('#showSpec');
                var showStat = $('#showStat');


                if (selectedRole.includes('4') || selectedRole.includes('Instructor')) {
                    // If the selected role includes '4' or 'Instructor'
                    statusSelect.prop('disabled', false);

                    testDep.hide();
                    testSpec.hide();
                   
                    showDep.show();
                    showSpec.show();
                     
                    // Add option element with value "N/A" to status
                     
                    

                    
                    
                    
                } else {
                    // If the selected role doesn't include '4' or 'Instructor'
                
                    testDep.show();
                    testSpec.show();
                    testStat.show();
                    showDep.hide();
                    showSpec.hide();
                     
                    statusSelect.prop('disabled', true);

                    testDep.empty();
                    testSpec.empty();
                    

                    // Add option element with value "N/a" to testDep
                    testDep.append($('<option>', {
                        value: '5',
                        text: 'N/A',
                        selected: true
                    }));

                    // Add option element with value "N/A" to testSpec
                    testSpec.append($('<option>', {
                        value: 'N/A',
                        text: 'N/A',
                        selected: true
                    }));

                    // Add option element with value "N/A" to status
                    statusSelect.append($('<option>', {
                        value: 'N/A',
                        text: 'N/A',
                        selected: true
                    }));
                }
            });
        });
    </script>


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
            // var department = $(this).data('department')
            

            // Construct HTML with the information
            var content = '<label style="font-size:1.5em;">'+ 'Personal Information' + '</label>' +
                          '<p>First Name: ' + fname + '</p>' +
                          '<p>Middle Name: ' + mname + '</p>' +
                          '<p>Last Name: ' + lname + '</p>' +
                          '<p>Birthdate: ' + birthdate + '</p>' +
                          '<p>Gender: ' + gender + '</p>' +
                          '<label style="font-size:1.5em;">'+ 'Contact Information' + '</label>' +
                          '<p>Contact Number: ' + cnumber + '</p>' +
                          '<p>Address: ' + address + '</p>' +
                        //   '<label style="font-size:1.5em;">'+ 'Other Information' + '</label>' +
                        //   '<p>Department: ' + department + '</p>';

                          '<p>Role: ' + role + '</p>';

            // Insert the HTML into the modal body
            $('#modalBody').html(content);
        });
    });
</script>
 

<!-- 
<script>
    // Function to enable or disable fields based on the selected role
    function handleRoleSelection() {
        var selectedRole = document.getElementById("Roles").value;
        var departmentSelect = document.getElementById("department");
        var specializationSelect = document.getElementById("specialization");
        var statusSelect = document.getElementById("status");

        // Check if the selected role is equal to 4 (assuming '4' corresponds to the desired role ID)
        if (selectedRole == 4) {
            // Enable the Department, Specialization, and Status selects
            departmentSelect.disabled = false;
            specializationSelect.disabled = false;
            statusSelect.disabled = false;
        } else {
            // Disable the Department, Specialization, and Status selects
            departmentSelect.disabled = true;
            specializationSelect.disabled = true;
            statusSelect.disabled = true;
        }
    }

    // Add an event listener to the Roles select element
    document.getElementById("Roles").addEventListener("change", handleRoleSelection);

    // Initial call to set the initial state based on the default selected role
    handleRoleSelection();
</script> -->


</body>

</html>