<?php
require('../config/db_connection.php');
include('../security.php');
// Start the session

// Check if the user is logged in
if (isset($_SESSION['Username'])) {
    $loggedInName = $_SESSION['Username'];

    $query = "SELECT is_Lock_Account, is_SchoolDirectorAssistant FROM userinfo WHERE Username = '$loggedInName' AND is_SchoolDirectorAssistant = 1";
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
        <title>Draft Senior High School Schedule</title>

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
                            <a class="collapse-item active" href="shs_draft_schedule.php">Senior High School</a>
                            <a class="collapse-item" href="jhs_draft_schedule.php">Junior High School</a>
                            <a class="collapse-item" href="primary_draft_schedule.php">Primary</a>
                        </div>
                    </div>
                </li>

                <!-- View Schedule Section -->
                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseView"
                    aria-expanded="true" aria-controls="collapseView">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>Approved Schedule</span>
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
                        <span>Modify Details</span>
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
                        <span>Modify Details</span>
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
                                    <a class="dropdown-item" href="../Profile/assistant_profile.php">
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
                                    <h1 style="font-size: 25px;">Draft Senior High School Schedule</h1> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-3 mb-3">
                                    <label for="yearLevel" class="form-label">Year Level:</label>
                                    <select id="yearLevel" class="form-control w-100 YearLevel" required>
                                        <option value="" disabled selected>Select Year Level</option>
                                        <option value="11">Grade 11</option>
                                        <option value="12">Grade 12</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-3 mb-3">
                                    <label for="semester" class="form-label">Semester:</label>
                                    <select id="semester" class="form-control w-100 Semester" required>
                                        <option value="" disabled selected>Select Semester</option>
                                        <option value="1">1st Semester</option>
                                        <option value="2">2nd Semester</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-3 mb-3">
                                    <label for="strand" class="form-label">Strand:</label>
                                    <select id="strand" class="form-control w-100 Strand" required>
                                        <option value="" disabled selected>Select Strand</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-3 mb-3">
                                    <label for="section" class="form-label">Section:</label>
                                    <select id="section" class="form-control w-100 Section" required>
                                        <option value="" disabled selected>Select Section</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mb-4" id="first_table">
                            <div class="card-header py-3 align-items-center">
                                <div class="form-inline">
                                    <div class="form-check mr-3">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll">Check All</label>
                                        <a href="#" class="mx-2" id="editAll" title="Edit">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="#" class="mx-2" id="deleteAll" title="Delete">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                        <!-- <button type="button" class="btn btn-primary mr-2" id="editAll">Edit</button> -->
                                    </div>
                                    <div class="ml-auto">
                                        <button type="button" class="btn btn-success mr-2" id="sendButton" >Send</button>
                                        <button type="button" class="btn btn-primary" id="continueButton">Continue</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Day</th>
                                                <th scope="col">Instructor</th>
                                                <th scope="col">Room</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody1">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4" id="second_table" style="display: none;">
                            <div class="card-header py-3">
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-hover small-text" id="tb">
                                    <thead>
                                        <tr class="tr-header">
                                            <th>Subject</th>
                                            <th>Time Start</th>
                                            <th>Time End</th>
                                            <th>Day</th>
                                            <th>Instructor</th>
                                            <th>Room</th>
                                            <th>
                                                <a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Subject">
                                                    <span class="fas fa-plus"></span>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control Subject" id="subject" name="Subject" required>
                                                    <option value="" disabled selected>Select Subject</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="time" class="form-control Time_Start" id="Time_Start" name="Time_Start" min="08:00" max="17:00" required>
                                               
                                            </td>
                                            <td>
                                                <input type="time" class="form-control Time_End" id="Time_End" name="Time_End" min="08:00" max="17:00" required>
                                            </td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input Day" type="checkbox" id="Monday" name="Day[]" value="M">
                                                    <label class="form-check-label" for="Monday">M</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input Day" type="checkbox" id="Tuesday" name="Day[]" value="T">
                                                    <label class="form-check-label" for="Tuesday">T</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input Day" type="checkbox" id="Wednesday" name="Day[]" value="W">
                                                    <label class="form-check-label" for="Wednesday">W</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input Day" type="checkbox" id="Thursday" name="Day[]" value="TH">
                                                    <label class="form-check-label" for="Thursday">Th</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input Day" type="checkbox" id="Friday" name="Day[]" value="F">
                                                    <label class="form-check-label" for="Friday">F</label>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-control Instructor" id="instructor" name="Instructor[]" required>
                                                    <option value="" disabled selected>Select Instructor</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control Room" id="room" name="Room[]" required>
                                                    <option value="" disabled selected>Select Room</option>
                                                    <!-- <php
                                                    require('../config/db_connection.php');
                                                    $sqlRooms = "SELECT * FROM rooms WHERE DepartmentID = 3 AND Active = 1";
                                                    $resultRooms = $conn->query($sqlRooms);

                                                    while ($room = $resultRooms->fetch_assoc()) {
                                                        $selected = ($room['RoomNumber'] === $instructor['Room']) ? 'selected' : ''; // Check if the room matches the current row
                                                        echo '<option value="' . $room['RoomNumber'] . '" >' . $room['RoomNumber'] . '</option>';
                                                    }

                                                    ?> -->
                                                </select>
                                            </td>
                                            <td><a href='javascript:void(0);' id="removeRow"><span class='fas fa-minus remove'></span></a></td>
                                        </tr>
                                    </tbody>
                                </table>

                                </div>
                               

                                <div class="text-center" id="btnSave">
                                    <button type="submit" id="saveBtn" name="add" class="btn btn-primary">Save</button>
                                </div>

                                <div class="card-body">
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
        $(document).ready(function () {
            // Handle changes in the track select element
            $('#yearLevel').change(function () {
                // Get the selected track
                var yearLevel = $(this).val();

                $.ajax({
                    url: 'Save/shs_get_year_level_tbody.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { yearLevel: yearLevel }, // Use 'yearLevel' here
                    success: function (data) {
                        // Update the table body with the fetched data
                        $('#tbody1').html(data);
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
            // Handle changes in the track select element
            $('#semester').change(function () {
                // Get the selected track
                var semester = $(this).val();

                var yearLevel = $('#yearLevel').val(); // Assuming 'yearLevel' comes from an element with ID 'yearLevel'

                $.ajax({
                    url: 'Save/shs_get_year_level_semester_tbody.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { yearLevel: yearLevel, semester: semester }, // Use 'yearLevel' here
                    success: function (data) {
                        // Update the table body with the fetched data
                        $('#tbody1').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });
                $.ajax({
                    url: 'Save/shs_get_semester_strand.php',
                    method: 'POST',
                    data: { yearLevel: yearLevel, semester: semester }, // Corrected order
                    success: function (data) {
                        // Update the 'strand' dropdown with the fetched data
                        $('#strand').html(data);

                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                }); // 
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // Handle changes in the track select element
            $('#strand').change(function () {
                // Get the selected track
                var strand = $(this).val();

                // Make an AJAX request to fetch data
                $.ajax({
                    url: 'Save/shs_get_year_level.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { strand: strand }, // Use 'yearLevel' here
                    success: function (data) {
                        // Update the table body with the fetched data
                        $('#tbody1').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });

                $.ajax({
                    url: 'Save/shs_get_year_level_section.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { strand: strand }, // Use 'yearLevel' here
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
                var strand = $('#strand').val(); // Corrected the variable name

                $.ajax({
                    url: 'Save/shs_get_section.php',
                    type: 'POST',
                    data: { section: section, strand: strand },
                    success: function (data) {
                        $('#tbody1').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });
                $.ajax({
                    url: 'GetData/shs_get_year_level_subject.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { strand: strand, section: section },
                    success: function (data) {
                        // Update the 'strand' dropdown with the fetched data
                        $('#subject').html(data);
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
    $(document).ready(function() {
        $("#sendButton").on("click", function() {
            // Display SweetAlert confirmation
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to send this schedule for '+ $("#yearLevel option:selected").text() + ' ' + $("#section option:selected").text() + '. Continue?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User clicked "Yes," proceed with the update

                    // Get selected values from dropdowns
                    var yearLevel = $("#strand").val();
                    var section = $("#section").val();

                    // Create a data object to send in the AJAX request
                    var data = {
                        yearLevel: yearLevel,
                        section: section
                    };

                    // Send AJAX request to update Active column
                    $.ajax({
                        type: "POST",  // Change to the appropriate HTTP method for your API
                        url: "SendSchedule/primary_send_schedule.php",  // Change to the endpoint of your API
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
    var yearLevelSelected = false;
    var sectionSelected = false;

    // Watch for changes in the dropdowns
    $("#yearLevel").on("change", function() {
        if ($(this).val() !== "") {
            yearLevelSelected = true;
        } else {
            yearLevelSelected = false;
        }
        checkSelection();
    });

    $("#section").on("change", function() {
        if ($(this).val() !== "") {
            sectionSelected = true;
        } else {
            sectionSelected = false;
        }
        checkSelection();
    });

    function checkSelection() {
        if (yearLevelSelected && sectionSelected) {
            $("#continueButton").prop("disabled", false);
        } else {
            $("#continueButton").prop("disabled", true);
        }
    }

    $("#continueButton").on("click", function() {
        // Display SweetAlert confirmation
        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure you want to send this schedule for '+ $("#yearLevel option:selected").text() + ' ' + $("#section option:selected").text() + '. Continue?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                // Get selected values from dropdowns
                var yearLevel = $("#yearLevel").val();
                var section = $("#section").val();

                // Hide the Continue button
                $("#continueButton").hide();

                // Show the second table
                $("#second_table").show();
            }
        });
    });
});
</script>




<!-- filter time -->
<script>
    // Function to enforce time limits
    function enforceTimeLimits(row) {
        var timeStart = row.querySelector('.Time_Start');
        var timeEnd = row.querySelector('.Time_End');

        // Set minimum and maximum values for both time inputs
        timeStart.addEventListener('input', function () {
            // Remove AM/PM from the input
            timeStart.value = timeStart.value.replace(/[^\d:]/g, '');

            if (timeStart.value < "07:00") {
                timeStart.value = "";
            } else if (timeStart.value > "17:00") {
                timeStart.value = "";
            }

            // Ensure Time_Start is always less than Time_End
            if (timeStart.value >= timeEnd.value) {
                timeEnd.value = "";
            }
        });

        timeEnd.addEventListener('input', function () {
            // Remove AM/PM from the input
            timeEnd.value = timeEnd.value.replace(/[^\d:]/g, '');

            if (timeEnd.value < "07:00") {
                timeEnd.value = "";
            } else if (timeEnd.value > "17:00") {
                timeEnd.value = "";
            }

            // Ensure Time_Start is always less than Time_End
            if (timeStart.value >= timeEnd.value) {
                timeEnd.value = "";
            }
        });

    }

    function addNewRow() {
        var allFieldsFilled = checkAllFieldsFilled();

        // Check if all fields are filled
        if (!allFieldsFilled) {
            showFieldWarning();
            return;
        }

        // Check for overlaps before saving
        if (hasOverlap()) {
            showOverlapWarning();
            return;
        }

        // Append a new row without checking for overlaps
        appendNewRow();
    }

    // Function to append a new row
    function appendNewRow() {
        var newRow = $("#tb tbody tr:last").clone(true); // Clone the last row
        var rowLength = $("#tb tbody tr").length; // Get the number of rows

        // Update IDs of elements in the cloned row to make them unique
        newRow.find('.Subject').attr('id', 'subject_' + rowLength);
        newRow.find('.Instructor').attr('id', 'instructor_' + rowLength);
        newRow.find('.Room').attr('id', 'room_' + rowLength);
        newRow.find('.Time_Start').attr('id', 'time_start_' + rowLength);
        newRow.find('.Time_End').attr('id', 'time_end_' + rowLength);
        newRow.find('.Day').each(function (index) {
            $(this).attr('id', 'day_' + rowLength + '_' + (index + 1));
        });

        // Clear input values in the cloned row
        newRow.find('input[type="text"], input[type="time"]').val('');
        newRow.find('.Day').prop('checked', false);

        // Append the cloned row to the table
        $("#tb tbody").append(newRow);

        // Apply the logic for Time_Start and Time_End in the cloned row
        var timeStartNew = newRow.find('.Time_Start');
        var timeEndNew = newRow.find('.Time_End');

        timeStartNew.attr('min', '07:00');
        timeStartNew.attr('max', '17:00');
        timeEndNew.attr('min', '07:00');
        timeEndNew.attr('max', '17:00');

        timeStartNew.on('input', function () {
            if (timeStartNew.val() < "07:00") {
                timeStartNew.val("");
            } else if (timeStartNew.val() > "17:00") {
                timeStartNew.val("");
            }

            if (timeStartNew.val() >= timeEndNew.val()) {
                timeEndNew.val('');
            }
        });

        timeEndNew.on('input', function () {
            if (timeEndNew.val() < "07:00") {
                timeEndNew.val("");
            } else if (timeEndNew.val() > "17:00") {
                timeEndNew.val("");
            }

            if (timeStartNew.val() >= timeEndNew.val()) {
                timeEndNew.val('');
            }
        });

        // Enforce time limits for the new row
        enforceTimeLimits(newRow[0]);
    }

    // Call the function for each row when the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function () {
        var rows = document.querySelectorAll('#tb tr:not(.tr-header)');
        rows.forEach(function (row) {
            enforceTimeLimits(row);
        });
    });

    $("#addMore").on('click', function () {
        addNewRow();
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove')) {
            confirmRemoveRow(e);
        }
    });

    // Additional functions for row manipulation
    function checkAllFieldsFilled() {
        var inputs = document.querySelectorAll('#tb input, #tb select');
        return Array.from(inputs).every(input => input.value.trim() !== '');
    }

    function confirmRemoveRow(e) {
        var table = document.getElementById('tb');
        var row = e.target.closest('tr');
        var rows = table.querySelectorAll('tr');

        if (rows.length === 2) {
            showRowRetainWarning();
        } else {
            Swal.fire({
                title: 'Confirmation',
                text: 'Do you want to remove this row?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    removeRow(row); // Pass the row directly
                    Swal.fire(
                        'Deleted!',
                        'The row has been removed.',
                        'success'
                    );
                }
            });
        }
    }

    function removeRow(row) {
        row.parentNode.removeChild(row);
    }

    // Function to check overlap before saving
    function hasOverlap() {
        var scheduleDataArray = [];

        $("#tb tr:not(:first)").each(function () {
            var scheduleData = {
                Days: $(this).find(".Day:checked").map(function () { return $(this).val(); }).get(),
                Time_Start: $(this).find(".Time_Start").val(),
                Time_End: $(this).find(".Time_End").val(),
            };

            scheduleDataArray.push(scheduleData);
        });

        for (var i = 0; i < scheduleDataArray.length; i++) {
            for (var j = i + 1; j < scheduleDataArray.length; j++) {
                var overlappingDays = scheduleDataArray[i].Days.filter(value => scheduleDataArray[j].Days.includes(value));

                if (overlappingDays.length === 0) {
                    continue; // No common days, skip comparison
                }

                if (
                    (
                        (scheduleDataArray[i].Time_Start >= scheduleDataArray[j].Time_Start &&
                            scheduleDataArray[i].Time_Start < scheduleDataArray[j].Time_End) ||
                        (scheduleDataArray[i].Time_End > scheduleDataArray[j].Time_Start &&
                            scheduleDataArray[i].Time_End <= scheduleDataArray[j].Time_End) ||
                        (scheduleDataArray[i].Time_Start <= scheduleDataArray[j].Time_Start &&
                            scheduleDataArray[i].Time_End >= scheduleDataArray[j].Time_End)
                    )
                ) {
                    return true; // Overlap detected
                }
            }
        }
        return false; // No overlap
    }

    function showOverlapWarning() {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Time overlap detected! Please adjust the schedule.',
        });
    }

    function showFieldWarning() {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Please fill in all fields before adding a new row!',
        });
    }

    function showRowRetainWarning() {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'At least one row must be retained!',
        });
    }
</script>


<!-- save -->
<script>
function showFieldWarningForSave() {
    Swal.fire({
        icon: 'warning',
        title: 'Warning.',
        text: 'Please fill in all fields before saving!',
    });
}

function checkAllFieldsFilled() {
    var yearLevel = document.getElementById('yearLevel').value;
    var section = document.getElementById('section').value;

    // Check if YearLevel and Section are filled
    if (yearLevel === '' || section === '') {
        return false; // YearLevel or Section is empty, return false
    }

    var allFieldsFilled = true;

    // Loop through each row
    $("#tb tr:not(:first)").each(function () {
        var checkboxes = $(this).find('.Day');
        var subjects = $(this).find('.Subject');
        var instructors = $(this).find('.Instructor');
        var rooms = $(this).find('.Room');
        var timesStart = $(this).find('.Time_Start');
        var timesEnd = $(this).find('.Time_End');

        // Check if any field in the row is empty
        if (
            checkboxes.filter(':checked').length === 0 ||
            subjects.filter(function () { return $(this).val() === '' || $(this).val() === null; }).length > 0 ||
            instructors.filter(function () { return $(this).val() === '' || $(this).val() === null; }).length > 0 ||
            rooms.filter(function () { return $(this).val() === '' || $(this).val() === null; }).length > 0 ||
            timesStart.filter(function () { return $(this).val() === ''; }).length > 0 ||
            timesEnd.filter(function () { return $(this).val() === ''; }).length > 0
        ) {
            allFieldsFilled = false;
            return false; // Exit the loop early if any row has missing fields
        }
    });

    return allFieldsFilled;
}



$(document).ready(function () {
    $("#saveBtn").click(function () {
        if (!checkAllFieldsFilled()) {
            showFieldWarningForSave();
            return;
        }

        Swal.fire({
            icon: 'question',
            title: 'Confirmation',
            text: 'Are you sure you want to save the schedule?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            // cancelButtonText: 'Cancel',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed only if confirmed
                saveSchedule(); // Call save function here
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('Cancelled', 'The schedule was not saved.', 'info');
            }
        });
    });
});


// Move the save logic into a separate function
function saveSchedule() {
    var scheduleDataArray = [];
    var subjectMinutes = {};
    var maxMinutesPerWeek = 0;

    // Check for overlaps before saving
    if (hasOverlapForSave()) {
        showOverlapWarningForSave();
        return;
    }
       // Check for overlaps before saving
    if (hasConflictForSave()) {
        showConflictWarningForSave();
        return;
    }



    // Calculate total minutes per subject for all selected days
    $("#tb tr:not(:first)").each(function () {
        var subject = $(this).find(".Subject").val();
        var days = $(this).find(".Day:checked");
        var startTime = $(this).find(".Time_Start").val();
        var endTime = $(this).find(".Time_End").val();

        var start = parseTime(startTime);
        var end = parseTime(endTime);

        var startInMinutes = start.hours * 60 + start.minutes;
        var endInMinutes = end.hours * 60 + end.minutes;

        var totalMinutes = (endInMinutes - startInMinutes) * days.length;

        // Update total minutes for the subject
        if (subjectMinutes[subject]) {
            subjectMinutes[subject] += totalMinutes;
        } else {
            subjectMinutes[subject] = totalMinutes;
        }
    });

    // Print or display the total minutes per subject
    for (var subject in subjectMinutes) {
        console.log("Subject:", subject, "Total Minutes:", subjectMinutes[subject]);
        // You can display this information as needed (e.g., in a popup, table, etc.)
    }


    // Collect data for each row
    $("#tb tr:not(:first)").each(function () {
        var scheduleData = {
            AcademicYear: generateAcademicYear(), // Call the function to generate academic year
            Department: document.getElementById("strand").value,
            Day: $(this).find(".Day:checked").map(function () {
                return this.value;
            }).get().join(), // Concatenate selected days
            Time_Start: $(this).find(".Time_Start").val(),
            Time_End: $(this).find(".Time_End").val(),
            Subject: $(this).find(".Subject").val(),
            Section: document.getElementById("section").value,
            Instructor: $(this).find(".Instructor").val(),
            Room: $(this).find(".Room").val(),
            
        };

        scheduleDataArray.push(scheduleData);
        console.log('Row Data:', scheduleData);
    });

    // Function to generate academic year based on condition
    function generateAcademicYear() {
        var currentDate = new Date();
        var currentMonth = currentDate.getMonth() + 1; // Adding 1 as months are zero-based

        // Define academic year range
        if (currentMonth >= 6 && currentMonth <= 12) {
            return currentDate.getFullYear() + "-" + (currentDate.getFullYear() + 1);
        } else {
            return (currentDate.getFullYear() - 1) + "-" + currentDate.getFullYear();
        }
    }


    // Send AJAX request
    $.ajax({
        type: "POST",
        url: "save_primary_schedule.php",
        data: { data: scheduleDataArray },
        success: function (response) {
            handleResponseMessages(response);
        },
        error: function (error) {
            console.error("Error:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while saving the schedule.',
            });
        }
    });
}


// Helper function to parse time with hours and minutes
function parseTime(time) {
    var parts = time.split(':');
    return {
        hours: parseInt(parts[0]),
        minutes: parseInt(parts[1])
    };
}

function hasConflictForSave() {
    var scheduleDataArray = [];

    $("#tb tr:not(:first)").each(function () {
        var subject = $(this).find(".Subject").val();
        var startTime = $(this).find(".Time_Start").val();
        var endTime = $(this).find(".Time_End").val();

        scheduleDataArray.push({ Subject: subject, Time_Start: startTime, Time_End: endTime });
    });

    for (var i = 0; i < scheduleDataArray.length; i++) {
        for (var j = i + 1; j < scheduleDataArray.length; j++) {
            if (
                scheduleDataArray[i].Subject === scheduleDataArray[j].Subject &&
                (
                    (scheduleDataArray[i].Time_Start >= scheduleDataArray[j].Time_Start &&
                        scheduleDataArray[i].Time_Start < scheduleDataArray[j].Time_End) ||
                    (scheduleDataArray[i].Time_End > scheduleDataArray[j].Time_Start &&
                        scheduleDataArray[i].Time_End <= scheduleDataArray[j].Time_End) ||
                    (scheduleDataArray[i].Time_Start <= scheduleDataArray[j].Time_Start &&
                        scheduleDataArray[i].Time_End >= scheduleDataArray[j].Time_End)
                )
            ) {
                return true; // Conflict detected
            }
        }
    }
    return false; // No conflict found
}


// Function to check overlap before saving
function hasOverlapForSave() {
    var scheduleDataArray = [];

    $("#tb tr:not(:first)").each(function () {
        var scheduleData = {
            Days: $(this).find(".Day:checked").map(function () { return $(this).val(); }).get(),
            Time_Start: $(this).find(".Time_Start").val(),
            Time_End: $(this).find(".Time_End").val(),
        };

        scheduleDataArray.push(scheduleData);
    });

    for (var i = 0; i < scheduleDataArray.length; i++) {
        for (var j = i + 1; j < scheduleDataArray.length; j++) {
            var overlappingDays = scheduleDataArray[i].Days.filter(value => scheduleDataArray[j].Days.includes(value));

            if (overlappingDays.length === 0) {
                continue; // No common days, skip comparison
            }

            if (
                (
                    (scheduleDataArray[i].Time_Start >= scheduleDataArray[j].Time_Start &&
                        scheduleDataArray[i].Time_Start < scheduleDataArray[j].Time_End) ||
                    (scheduleDataArray[i].Time_End > scheduleDataArray[j].Time_Start &&
                        scheduleDataArray[i].Time_End <= scheduleDataArray[j].Time_End) ||
                    (scheduleDataArray[i].Time_Start <= scheduleDataArray[j].Time_Start &&
                        scheduleDataArray[i].Time_End >= scheduleDataArray[j].Time_End)
                )
            ) {
                return true; // Overlap detected
            }
        }
    }
    return false; // No overlap
}


// // Function to show overlap warning before saving
// function showOverlapWarningForSave() {
//     Swal.fire({
//         icon: 'warning',
//         title: 'Warning',
//         text: 'Time overlap detected! Please adjust the schedule.',
//     });
// }

function showOverlapWarningForSave() {
    Swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: 'Time overlap detected! Please adjust the schedule.',
    });
}

function showConflictWarningForSave() {
    Swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: 'They have the same subject and time; please consolidate them into one.',
    });
}




// Function to handle response messages
function handleResponseMessages(response) {
    if (response && response.length > 0) {
        var successMessages = [];
        var warningMessages = [];
        var errorMessages = [];

        response.forEach(function (item) {
            if (item.status === 'success') {
                successMessages.push(item.message);
            } else if (item.status === 'warning') {
                warningMessages.push(item.message);
            } else if (item.status === 'error') {
                errorMessages.push(item.message);
            }
        });

        // Display success messages
        if (successMessages.length > 0) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: successMessages.join('\n'),
            }).then(function () {
                location.reload(); // Example: Reload the page after success
            });
        }

        // Display warning messages
        if (warningMessages.length > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: warningMessages.join('\n'),
            });
        }

        // Display error messages
        if (errorMessages.length > 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessages.join('\n'),
            });
        }
    }
}

</script>

<!-- first Instructor Working -->
<!-- <script>
$(document).ready(function() {
    // Add an event listener to the .Subject dropdown
    $('.Subject').change(function() {
        var subject = $(this).val();
        console.log('Selected Subject:', subject); // For debugging

        // Find the closest tr and then find the .Instructor dropdown inside it
        var instructorDropdown = $(this).closest('tr').find('.Instructor');

        // Make an AJAX request to fetch instructors based on the selected subject
        $.ajax({
            type: 'POST',
            url: 'GetData/primary_get_subject_instructor.php',
            data: { subject: subject },
            success: function(data) {
                console.log('Received data:', data); // For debugging
                // Update the .Instructor dropdown with the fetched data
                instructorDropdown.html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching instructors:', error); // For debugging
            }
        });
    });
});
</script> -->

<!-- Second Instructor Working -->
<!-- <script>
$(document).ready(function() {
    // Add an event listener to the .Subject dropdown
    $('.Subject').change(function() {
        var subject = $(this).val();
        console.log('Selected Subject:', subject); // For debugging

        // Find the closest tr and then find the .Instructor dropdown inside it
        var instructorDropdown = $(this).closest('tr').find('.Instructor');
        var timeStart = $(this).closest('tr').find('.Time_Start').val();
        var timeEnd = $(this).closest('tr').find('.Time_End').val();
        var selectedDays = [];
        $(this).closest('tr').find('.Day:checked').each(function() {
            selectedDays.push($(this).val());
        });

        // Make an AJAX request to fetch instructors based on the selected subject, time, and days
        $.ajax({
            type: 'POST',
            url: 'GetData/primary_get_subject_instructor.php',
            data: {
                subject: subject,
                timeStart: timeStart,
                timeEnd: timeEnd,
                selectedDays: selectedDays
            },
            success: function(data) {
                console.log('Received data:', data); // For debugging
                // Update the .Instructor dropdown with the fetched data
                instructorDropdown.html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching instructors:', error); // For debugging
            }
        });
    });
});

</script> -->

<script>
    $(document).ready(function () {
    // Add event listener for changes in Subject
    $(document).on('change', '.Subject', function () {
        updateInstructors('subject', $(this));
    });

    // Add event listeners for changes in time
    $(document).on('change', '.Time_Start, .Time_End', function () {
        updateInstructors('time', $(this));
    });

    // Add event listeners for changes in day
    $(document).on('change', '.Day', function () {
        updateInstructors('day', $(this));
    });

    function updateInstructors(type, changedElement) {
        var row = changedElement.closest('tr');
        var subject = row.find('.Subject').val();
        var timeStart = row.find('.Time_Start').val();
        var timeEnd = row.find('.Time_End').val();
        var selectedDays = row.find('.Day:checked').map(function () {
            return this.value;
        }).get();

        // Make an AJAX request to fetch instructors based on the selected subject, time, and day
        $.ajax({
            type: 'POST',
            url: 'GetData/shs_get_subject_instructor.php',
            data: {
                subject: subject,
                timeStart: timeStart,
                timeEnd: timeEnd,
                selectedDays: selectedDays,
                type: type  // Pass the type of update (subject, time, or day) to the server
            },
            success: function (data) {
                // Update the .Instructor dropdown within the current row with the fetched data
                row.find('.Instructor').html(data);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching instructors:', error);
            }
        });
    }
});

</script>

<script>
    $(document).ready(function () {

    // Add event listeners for changes in time
    $(document).on('change', '.Time_Start, .Time_End', function () {
        updateInstructors('time', $(this));
    });

    // Add event listeners for changes in day
    $(document).on('change', '.Day', function () {
        updateInstructors('day', $(this));
    });

    function updateInstructors(type, changedElement) {
        var row = changedElement.closest('tr');
        var timeStart = row.find('.Time_Start').val();
        var timeEnd = row.find('.Time_End').val();
        var selectedDays = row.find('.Day:checked').map(function () {
            return this.value;
        }).get();

        // Make an AJAX request to fetch instructors based on the selected subject, time, and day
        $.ajax({
            type: 'POST',
            url: 'GetData/shs_get_room.php',
            data: {
                timeStart: timeStart,
                timeEnd: timeEnd,
                selectedDays: selectedDays,
                type: type  // Pass the type of update (subject, time, or day) to the server
            },
            success: function (data) {
                // Update the .Instructor dropdown within the current row with the fetched data
                row.find('.Room').html(data);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching instructors:', error);
            }
        });
    }
});

</script>

<!-- <script>
// Wait for the DOM to be ready
$(document).ready(function () {
    // Store the initial values of the dropdowns
    var initialYearLevel = $('#yearLevel').val();
    var initialSection = $('#section').val();
    var isFirstChangeYearLevel = true; // Flag to check if it's the first change for Year Level
    var isFirstChangeSection = true; // Flag to check if it's the first change for Section

    // Add event listener for changes in the "Year Level" dropdown
    $('#yearLevel').on('change', function () {
        // Skip the initial change
        if (isFirstChangeYearLevel) {
            isFirstChangeYearLevel = false;
            return;
        }

        // Check if there is content in the specified fields inside tbody
        if (!areFieldsEmpty()) {
            var selectedYearLevel = $(this).val();
            displaySweetAlert('The created schedule, if there is no conflict, will be auto-saved.');
            // Update the initial value
            initialYearLevel = selectedYearLevel;
        }
    });

    // Add event listener for changes in the "Section" dropdown
    $('#section').on('change', function () {
        // Skip the initial change
        if (isFirstChangeSection) {
            isFirstChangeSection = false;
            return;
        }

        // Check if there is content in the specified fields inside tbody
        if (!areFieldsEmpty()) {
            var selectedSection = $(this).val();
            displaySweetAlert('The created schedule, if there is no conflict, will be auto-saved.');
            // Update the initial value
            initialSection = selectedSection;
        }
    });

    function displaySweetAlert(message) {
        // Display a SweetAlert with "OK" button
        Swal.fire({
            title: 'Warning!',
            text: message,
            icon: 'warning',
            showConfirmButton: true, // Show the "OK" button
        });
    }

    function areFieldsEmpty() {
        // Specify the fields to check for content
        var fieldsToCheck = ['#subject', '#Time_Start', '#Time_End', 'input[name="Day[]"]', '#instructor', '#room'];

        // Check if any of the specified fields has content
        return fieldsToCheck.some(function (field) {
            return $(field).filter(function () {
                return $.trim($(this).val()).length > 0;
            }).length > 0;
        });
    }
});

</script> -->

<script>
    // Get references to the select elements and buttons
    var yearLevelSelect = document.getElementById("strand");
    var sectionSelect = document.getElementById("section");

    var sendButton = document.getElementById("sendButton");
    var continueButton = document.getElementById("continueButton");

    // Function to check if all selections are made and update buttons
    function checkSelections() {
        if (yearLevelSelect.value !== "" && sectionSelect.value !== "") {
            // Perform AJAX request to check class schedule
            $.ajax({
                url: 'check.php',
                method: 'POST',
                data: {
                    yearLevel: yearLevelSelect.value,
                    section: sectionSelect.value
                },
                dataType: 'json',
                success: function (response) {
                    console.log('Server Response:', response);

                    // Enable/disable and toggle between "Send" and "Continue" based on the response
                    if (response.complete) {
                        sendButton.style.display = "inline-block";
                        continueButton.style.display = "none";
                    } else {
                        sendButton.style.display = "none";
                        continueButton.style.display = "inline-block";
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error checking class schedule:', textStatus, errorThrown);
                }
            });
        } else {
            // Disable the buttons if no selection made
            sendButton.style.display = "none";
            continueButton.style.display = "none";
        }
    }

    // Add event listeners to the select elements
    yearLevelSelect.addEventListener("change", checkSelections);
    sectionSelect.addEventListener("change", checkSelections);

    // Check selections on page load
    checkSelections();
</script>


 <!--EditAll  -->
 <script>
    $(document).ready(function () {
        // Function to handle 'Edit' click event
        $('#editAll').click(function (e) {
            e.preventDefault();

            // Array to store selected StrandIDs
            var selectedStrandIDs = [];

            // Loop through each checked checkbox to get the SubjectID
            $('.checkSingle:checked').each(function () {
                selectedStrandIDs.push($(this).data('id'));
            });

            // Confirm before redirecting
            if (selectedStrandIDs.length > 0) {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to edit?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var editURL = 'edit_shs_draft_schedule.php?subid=' + selectedStrandIDs.join(',');
                        window.location.href = editURL;
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'No rows selected. Please select at least one row to edit.'
                });
            }
        });

        // Function to handle 'Check All' click event
        $('#checkAll').click(function () {
            $('.checkSingle').prop('checked', $(this).prop('checked'));
        });
    });
</script>
<!--DeleteAll  -->
<script>
    $(document).ready(function () {
        // Function to handle 'Edit' click event
        $('#deleteAll').click(function (e) {
            e.preventDefault();

            // Array to store selected ClasscheduleIDs
            var selectedClasscheduleIDs = [];

            // Loop through each checked checkbox to get the ClasscheduleID
            $('.checkSingle:checked').each(function () {
                selectedClasscheduleIDs.push($(this).data('id'));
            });

            // Confirm before deletion
            if (selectedClasscheduleIDs.length > 0) {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform AJAX request for deletion
                        $.ajax({
                            url: 'DataDelete/delete_primary_schedule.php',
                            type: 'POST',
                            data: { classScheduleData: selectedClasscheduleIDs },
                            success: function(response) {
                                // Handle success response
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted',
                                    text: 'Selected items have been deleted.',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    // Reload or update your page as needed
                                    location.reload(); // Example: reload the page
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle error
                                console.error(xhr.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong. Please try again later.'
                                });
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'No rows selected. Please select at least one row to delete.'
                });
            }
        });

        // Function to handle 'Check All' click event
        $('#checkAll').click(function () {
            $('.checkSingle').prop('checked', $(this).prop('checked'));
        });
    });
</script>






</body>

</html>
