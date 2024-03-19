<?php
require('../config/db_connection.php');
include('../security.php');
// Start the session

// Check if the user is logged in
if (isset($_SESSION['Username'])) {
    $loggedInName = $_SESSION['Username'];

    $query = "SELECT * FROM userinfo WHERE Username = '$loggedInName' AND is_SchoolDirectorAssistant = 1";
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
    
    <link rel="icon" href="../assets/img/logo1.png">
    <!-- Style for icons and fonts -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <title>Change Password - Profile</title>

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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../assistant.php">
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
                    <a class="nav-link" href="../assistant.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Create Schedule Section -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSchedule"
                        aria-expanded="true" aria-controls="collapseSchedule">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Create Schedule</span>
                    </a>
                    <div id="collapseSchedule" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../assistant/shs_create_schedule.php">Senior High School</a>
                            <a class="collapse-item" href="../assistant/jhs_create_schedule.php">Junior High School</a>
                            <a class="collapse-item" href="../assistant/primary_create_schedule.php">Primary</a>
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
                            <a class="collapse-item" href="../assistant/shs_draft_schedule.php">Senior High School</a>
                            <a class="collapse-item" href="../assistant/jhs_draft_schedule.php">Junior High School</a>
                            <a class="collapse-item" href="../assistant/primary_draft_schedule.php">Primary</a>
                        </div>
                    </div>
                </li>

                <!-- View Schedule Section -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseView"
                        aria-expanded="true" aria-controls="collapseView">
                        <i class="fas fa-fw fa-eye"></i>
                        <span>View Schedule</span>
                    </a>
                    <div id="collapseView" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../assistant/view_senior_high_school.php">Senior High School</a>
                            <a class="collapse-item" href="../assistant/view_junior_high_school.php">Junior High School</a>
                            <a class="collapse-item" href="../assistant/view_primary.php">Primary</a>
                            <a class="collapse-item" href="../assistant/view_room.php">Room</a>
                            <a class="collapse-item" href="../assistant/view_instructor.php">Instructor</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - View Menu -->
                <!-- <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOfficial"
                        aria-expanded="true" aria-controls="collapseOfficial">
                        <i class="fas fa-fw fa-calendar-alt"></i>
                        <span>Modify Schedule</span>
                    </a>
                    <div id="collapseOfficial" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="shs_schedule.php">Senior High School</a>
                            <a class="collapse-item" href="jhs_schedule.php">Junior High School</a>
                            <a class="collapse-item" href="primary_schedule.php">Primary</a>
                        </div>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="../assistant/modify_schedule.php">
                        <i class="fas fa-fw fa-calendar-alt"></i>
                        <span>Modify Schedule</span>
                    </a>
                </li>

                <!-- Archive Section -->
                <li class="nav-item">
                    <a class="nav-link" href="../assistant/archive_schedule.php">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Assistant</span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="assistant_profile.php">
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
                                                <input disabled class="form-control" id="username" name="username" type="text" placeholder="Enter your first name" value="<?php echo $row['Username']?>">
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
                                                <button class="btn btn-outline-secondary mr-2" type="submit" id="cancel_btn">Cancel</button>

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
    $("#current_password").on("input", function () {
        var enteredPassword = $(this).val().trim();
        if (enteredPassword !== "") {
            $(this).css("border-color", "red");
            checkPassword(); // Check the password immediately upon input
        } else {
            $(this).css("border-color", "transparent"); // Set border color to transparent when input is not empty
        }
    });

    $("#current_password").on("keypress", function (event) {
        // Check if Enter key is pressed
        if (event.keyCode === 13) {
            checkPassword();
        }
    });

    function checkPassword() {
        var currentPassword = $("#current_password").val().trim();
        
        $.ajax({
            type: "POST",
            url: "changePassword/check_password.php",
            data: {
                current_password: currentPassword
            },
            success: function (response) {
                console.log("Response received:", response);
                if (response === "success") {
                    $("#current_password").css("border-color", "lightgreen");
                } else {
                    $("#current_password").css("border-color", "red");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error occurred:", error);
            }
        });
    }
});
</script>

<script>
$(document).ready(function () {
    $("#confirm_password").on("input", function () {
        var newPassword = $("#new_password").val().trim();
        var confirmPassword = $("#confirm_password").val().trim();
        if (confirmPassword !== newPassword) {
            $("#new_password, #confirm_password").css("border-color", "red");
        } else {
            $("#new_password, #confirm_password").css("border-color", "lightgreen");
        }
    });
    

});


</script>

<script>
$(document).ready(function () {
    // Remove error messages and reset border color when user starts typing in the input fields
    $("#current_password").on('input', function() {
        $("#current_password").css("border-color", ""); // Reset border color
        $("#current_password_error").remove(); // Remove error message
    });
    $("#new_password").on('input', function() {
        $("#new_password").css("border-color", ""); // Reset border color
        $("#new_password_error").remove(); // Remove error message
        var newPassword = $(this).val();
        if (!/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/.test(newPassword)) {
            $("#new_password").css("border-color", "red");
            $("#new_password").after("<div id='new_password_error' style='color:red'>New password must contain at least one digit, one lowercase letter, one uppercase letter, and be at least 8 characters long.</div>");
        }
        else {
            $("#new_password").css("border-color", ""); // Reset border color
        }
        checkPasswordMatch(); // Check if passwords match after every input
    });
    $("#confirm_password").on('input', function() {
        $("#confirm_password").css("border-color", ""); // Reset border color
        $("#confirm_password_error").remove(); // Remove error message
        checkPasswordMatch(); // Check if passwords match after every input
    });

    function checkPasswordMatch() {
        var newPassword = $("#new_password").val();
        var confirmPassword = $("#confirm_password").val();

        if (newPassword === confirmPassword) {
            // If passwords match and are not empty, set border color to green
            $("#new_password").css("border-color", "green");
            $("#confirm_password").css("border-color", "green");
        } 
    }

    $("#update_btn").click(function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Remove previous error messages
        $("#new_password_error").remove();
        $("#confirm_password_error").remove();
        $("#current_password_error").remove();

        // Check if all fields are filled
        var username = "<?php echo $loggedInUsername; ?>"; // Get the logged-in username from PHP
        var currentPassword = $("#current_password").val(); // Get the current password
        var newPassword = $("#new_password").val();
        var confirmPassword = $("#confirm_password").val();

        // Check if any of the fields are empty
        if (currentPassword === "" || newPassword === "" || confirmPassword === "") {
            // Set border color of empty fields to red
            if (currentPassword === "") {
                $("#current_password").css("border-color", "red");
                $("#current_password").after("<div id='current_password_error' style='color:red'>Current password cannot be empty.</div>");
            } else {
                $("#current_password").css("border-color", ""); // Reset border color
            }
            if (newPassword === "") {
                $("#new_password").css("border-color", "red");
                $("#new_password").after("<div id='new_password_error' style='color:red'>New password cannot be empty.</div>");
            } else {
                $("#new_password").css("border-color", ""); // Reset border color
            }
            if (confirmPassword === "") {
                $("#confirm_password").css("border-color", "red");
                $("#confirm_password").after("<div id='confirm_password_error' style='color:red'>Confirm password cannot be empty.</div>");
            } else {
                $("#confirm_password").css("border-color", ""); // Reset border color
            }
            
            return; // Stop further execution
        }

        // Check if new password matches confirm password
        if (newPassword !== confirmPassword) {
            Swal.fire({
                title: 'Error',
                text: 'New password and confirm password do not match.',
                icon: 'error'
            });
            return; // Stop further execution
        }

        // Check if the new password meets the required pattern
        if (!/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/.test(newPassword)) {
            $("#new_password").css("border-color", "red");
            $("#new_password").after("<div id='new_password_error' style='color:red'>New password must contain at least one digit, one lowercase letter, one uppercase letter, and be at least 8 characters long.</div>");
            return; // Stop further execution
        }

        // If all validation passes, proceed with the confirmation dialog
        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure you want to update your password?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with AJAX request
                // Prepare form data
                var formData = {
                    username: username,
                    current_password: currentPassword, // Include the current password
                    new_password: newPassword
                };

                // Perform AJAX request
                $.ajax({
                    type: "POST",
                    url: "changePassword/change_password_connection.php",
                    data: formData,
                    dataType: "json", // Expect JSON response
                    success: function (response) {
                        // Handle success response
                        if (response.status === "success") {
                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Reload the page
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Warning',
                                text: response.message,
                                icon: 'warning'
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error("Error occurred:", error);
                        Swal.fire({
                            title: 'Error',
                            text: 'An error occurred while updating the password.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
});
</script>





<script>
$(document).ready(function () {
    $("#cancel_btn").click(function () {
        // Perform the Ajax request to redirect to 'assistant_profile.php'
        $.ajax({
            url: 'assistant_profile.php',
            type: 'GET',
            success: function(data) {
                // Redirect to assistant_profile.php
                window.location.href = 'assistant_profile.php';
            },
            error: function() {
                console.error('Error occurred during the Ajax request');
            }
        });
    });
});

</script>


   
  






</body>

</html>
