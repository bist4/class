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

        if ($row['RoleID'] == 3) {
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
        <title>Draft Schedule Junior High School</title>

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
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSchedule"
                        aria-expanded="true" aria-controls="collapseSchedule">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Create Schedule</span>
                    </a>
                    <div id="collapseSchedule" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="shs_create_schedule.php">Senior High School</a>
                            <a class="collapse-item" href="jhs_create_schedule.php">Junior High School</a>
                            <a class="collapse-item" href="primary_create_schedule.php">Primary</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - File Maimntenance Menu -->
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#"  data-toggle="collapse" data-target="#collapseDraft"
                        aria-expanded="true" aria-controls="collapseDraft">
                        <i class="fas fa-edit"></i>
                        <span>Draft Schedule</span>
                    </a>
                    <div id="collapseDraft" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="shs_draft_schedule.php">Senior High School</a>
                            <a class="collapse-item active" href="jhs_draft_schedule.php">Junior High School</a>
                            <a class="collapse-item" href="primary_draft_schedule.php">Primary</a>
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
                        <a class="collapse-item" href="view_senior_high_school.php">Senior High School</a>
                        <a class="collapse-item" href="view_junior_high_school.php">Junior High School</a>
                        <a class="collapse-item" href="view_primary.php">Primary</a>
                        <a class="collapse-item" href="view_room.php">Room</a>
                        <a class="collapse-item" href="view_instructor.php">Instructor</a>
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
                    <a class="nav-link" href="modify_schedule.php">
                        <i class="fas fa-fw fa-calendar-alt"></i>
                        <span>Modify Schedule</span>
                    </a>
                </li>

                <!-- Archive Section -->
                <li class="nav-item">
                    <a class="nav-link" href="archive_schedule.php">
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

                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-lg-12 col-md-6 ">
                                    <h1 style="font-size: 25px;">Draft Junior High School Schedule</h1> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-3 mb-3">
                                    <label for="yearLevel" class="form-label">Year Level:</label>
                                    <select id="yearLevel" class="form-control w-100" required>
                                        <option value="" disabled selected>Select Year Level</option>
                                        <option value="7">Grade 7</option>
                                        <option value="8">Grade 8</option>
                                        <option value="9">Grade 9</option>
                                        <option value="10">Grade 10</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-3 mb-3">
                                    <label for="section" class="form-label">Section:</label>
                                    <select id="section" class="form-control w-100" required>
                                        <option value="" disabled selected>Select Section</option>
                                        <option value="1">Section 1</option>
                                        <option value="2">Section 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-success mr-2" id="sendButton" disabled>
                                    <i class="fas fa-paper-plane"></i> Send
                                </button>
                                <button type="button" class="btn btn-primary" id="editButton" disabled>
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Day</th>
                                                <th scope="col">Instructor</th>
                                                <th scope="col">Room</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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

        <!-- reject modal -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to reject?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger">Yes</button>
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
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        
    <script>
        $(document).ready(function () {
            // Handle changes in the yearLevel select element
            $('#yearLevel').change(function () {
                // Get the selected year level
                var yearLevel = $(this).val();

                // Make an AJAX request to fetch data
                $.ajax({
                    url: 'Save/jhs_get_year_level.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { yearLevel: yearLevel }, // Use 'yearLevel' here
                    success: function (data) {
                        // Update the table body with the fetched data
                        $('tbody').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });

                $.ajax({
                    url: 'Save/jhs_get_year_level_section.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { yearLevel: yearLevel }, // Use 'yearLevel' here
                    success: function (data) {
                        // Update the table body with the fetched data
                        $('#section').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#section').change(function () {
                var section = $(this).val();
                var yearLevel = $('#yearLevel').val(); // Corrected the variable name

                $.ajax({
                    url: 'Save/jhs_get_section.php',
                    type: 'POST',
                    data: { section: section, yearLevel: yearLevel },
                    success: function (data) {
                        $('tbody').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });
            });
        });
    </script>

<script>
    document.getElementById('yearLevel').addEventListener('change', function() {
        document.getElementById('section').value = '';
    });
</script>

<script>
        // Get references to the select elements and buttons
        var yearLevelSelect = document.getElementById("yearLevel");
        var sectionSelect = document.getElementById("section");

        var sendButton = document.getElementById("sendButton");
        var editButton = document.getElementById("editButton");

        // Function to check if all selections are made
        function checkSelections() {
            if (
                yearLevelSelect.value !== "" &&
                sectionSelect.value !== ""
            ) {
                // Enable the buttons
                sendButton.disabled = false;
                editButton.disabled = false;
            } else {
                // Disable the buttons
                sendButton.disabled = true;
                editButton.disabled = true;
            }
        }

        // Add event listeners to the select elements
        yearLevelSelect.addEventListener("change", checkSelections);
        sectionSelect.addEventListener("change", checkSelections);
    </script>

<script>
    $(document).ready(function() {
        $("#sendButton").on("click", function() {
            // Display SweetAlert confirmation
            Swal.fire({
                title: 'Confirmation?',
                text: 'Are you sure you want to send this schedule for '+ $("#yearLevel").val() + ' ' + $("#section").val() + '. Continue?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, send it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User clicked "Yes," proceed with the update

                    // Get selected values from dropdowns
                    var yearLevel = $("#yearLevel").val();
                    var section = $("#section").val();

                    // Create a data object to send in the AJAX request
                    var data = {
                        yearLevel: yearLevel,
                        section: section
                    };

                    // Send AJAX request to update Active column
                    $.ajax({
                        type: "POST",  // Change to the appropriate HTTP method for your API
                        url: "SendSchedule/jhs_send_schedule.php",  // Change to the endpoint of your API
                        data: data,
                        success: function(response) {
                            // Handle success, e.g., show a success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Schedule sent successfully!',
                                showConfirmButton: false,
                                timer: 1500  // Time in milliseconds (1.5 seconds)
                            });

                            // Reload the page after a short delay
                            setTimeout(function() {
                                location.reload();
                            }, 1500);  // Time in milliseconds (1.5 seconds)
                        },
                        error: function(error) {
                            // Handle error, e.g., show an error message
                            Swal.fire('Error', 'Failed to update schedule. Please try again.', 'error');
                            console.error("Error updating schedule:", error);
                        }
                    });
                }
            });
        });        
    });
</script>

<script>
$(document).ready(function() {
    $("#editButton").on("click", function() {
        // Display SweetAlert confirmation
        Swal.fire({
            title: 'Confirmation?',
            text: 'Are you sure you want to edit this schedule for Grade ' + $("#yearLevel").val() + ' ' + $("#section").val() + '. Continue?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, edit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Get selected values from dropdowns
                var yearLevel = $("#yearLevel").val();
                var section = $("#section").val();
                
                // Redirect to edit_primary_draft_schedule.php with parameters
                window.location.href = `edit_jhs_draft_schedule.php?yearLevel=${yearLevel}&section=${section}`;
            }
        });
    });
});

</script>





</body>

</html>