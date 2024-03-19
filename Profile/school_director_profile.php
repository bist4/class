<!-- <php

include('../security.php');

$allowedPages = array(
    1 => array('system_admin.php'),
    2 => array('school_director.php'),
    3 => array('assistant.php'),
    4 => array('instructor.php')
    // Add more roles and corresponding allowed pages as needed
);

 
?> -->

<?php
require('../config/db_connection.php');
include('../security.php');
// Start the session

// Check if the user is logged in
if (isset($_SESSION['Username'])) {
    $loggedInName = $_SESSION['Username'];

    $query = "SELECT * FROM userinfo WHERE Username = '$loggedInName' AND is_SchoolDirector = 1";
    // Execute the query
    $result = $conn->query($query);
    
    if ($result) {
        $row = $result->fetch_assoc();

        // Close the result set
        $result->close();

        if ($row['is_SchoolDirector'] == 1) {
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
include('../session_out.php');
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../school_director.php">
                <div class="sidebar-brand-icon">
                    <i class="fas">
                        <img src="../assets/img/logo1.png" alt="logo" width="50" height="50">
                    </i>
                </div>
                <div class="sidebar-brand-text mx-3" style="font-size: 13px">Online Class Scheduling System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                    <a class="nav-link" href="../school_director.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReview"
                    aria-expanded="true" aria-controls="collapseReview">
                    <i class="fas fa-fw fa-pencil-alt"></i>
                    <span>Review Schedule</span>
                </a>
                <div id="collapseReview" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../school_director/review_senior_high_school.php">Senior High School</a>
                        <a class="collapse-item" href="../school_director/review_junior_high_school.php">Junior High School</a>
                        <a class="collapse-item" href="../school_director/review_primary.php">Primary</a>
                        <a class="collapse-item" href="../school_director/review_room.php">Room</a>
                        <a class="collapse-item" href="../school_director/review_instructor.php">Instructor</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseView"
                    aria-expanded="true" aria-controls="collapseView">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>View Schedule</span>
                </a>
                <div id="collapseView" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../school_director/view_senior_high_school.php">Senior High School</a>
                        <a class="collapse-item" href="../school_director/view_junior_high_school.php">Junior High School</a>
                        <a class="collapse-item" href="../school_director/view_primary.php">Primary</a>
                        <a class="collapse-item" href="../school_director/view_room.php">Room</a>
                        <a class="collapse-item" href="../school_director/view_instructor.php">Instructor</a>
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
                        
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">School Director</span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                             <!-- Dropdown - User Information -->
                             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="school_director_profile.php">
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
                                                        <a class="dropdown-item" href="edit_profile_school_director.php">Edit Profile</a>
                                                        <a class="dropdown-item" href="change_password_school_director.php">Change Password</a>
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
                                    
                                    </div>
                                </div>
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
    

    <!-- Tables -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/demo/datatables-demo.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
$(document).ready(function () {
    $("#update_btn").click(function () {
        // Gather data from form fields
        var username = "<?php echo $loggedInUsername; ?>"; // Get the logged-in username from PHP
        var fname = $("#Fname").val();
        var mname = $("#Mname").val();
        var lname = $("#Lname").val();
        var bday = $("#Bday").val();
        var address = $("#Address").val();
        var contactNumber = $("#ContactNumber").val();

        // Create data object to send to the server
        var data = {
            username: username,
            fname: fname,
            mname: mname,
            lname: lname,
            bday: bday,
            address: address,
            contactNumber: contactNumber
        };

        // Send AJAX request
        $.ajax({
            type: "POST",
            url: "DataUpdate/update_profile.php", // Replace with the actual file handling the update on the server
            data: data,
            success: function (response) {
                // Handle the server response here with SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Profile updated successfully!',
                    showConfirmButton: false,
                    timer: 1500
                });
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