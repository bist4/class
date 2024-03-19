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

        <title>Create schedule for senior high school</title>

        <!-- Favicon and Styles -->
        <link rel="icon" href="../assets/img/logo1.png">
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
        <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    </head>

    <?php
    include('session_out.php');
    ?>

    <body id="page-top">


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

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="../school_director.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Create Schedule Section -->
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSchedule"
                        aria-expanded="true" aria-controls="collapseSchedule">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Create Schedule</span>
                    </a>
                    <div id="collapseSchedule" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item active" href="shs_create_schedule.php">Senior High School</a>
                            <a class="collapse-item " href="jhs_create_schedule.php">Junior High School</a>
                            <a class="collapse-item" href="primary_create_schedule.php">Primary</a>
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
                            <a class="collapse-item" href="shs_draft_schedule.php">Senior High School</a>
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

                            <!-- User Information Dropdown -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Assistant</span>
                                    <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                                </a>
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
                        <!-- Your page content goes here -->
                        <div class="container mt-4">
                            <!-- Existing code -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <h1 style="font-size: 25px;">Create Senior High School Schedule</h1>
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
                                    <label for="track" class="form-label">Track:</label>
                                    <select id="track" class="form-control w-100" required>
                                        <option value="" disabled selected>Select Track</option>
                                        <?php
                                            require('../config/db_connection.php');

                                            // Assuming your table name is "strands" and the column is "TrackTypeName"
                                            $sql = "SELECT DISTINCT TrackTypeName FROM strands";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . $row['TrackTypeName'] . '">' . $row['TrackTypeName'] . '</option>';
                                                }
                                               echo '</select>';
                                            } else {
                                                echo '<p>No tracks found in the database</p>';
                                            }

                                            // Close the database connection
                                            $conn->close();
                                        ?>
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
                            <!-- Remaining content -->
                        </div>

                        <div class="card shadow mb-4">
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
                    <?php
                    require('../config/db_connection.php');
                    // Fetch all available instructors for DepartmentID 3 from the database
                    $sqlInstructors = "SELECT * FROM instructor WHERE DepartmentID = 1 AND Active = 1";
                    $resultInstructors = $conn->query($sqlInstructors);

                    while ($instructorData = $resultInstructors->fetch_assoc()) {
                        $fullName = $instructorData['Fname'] . ' ' . $instructorData['Lname'];
                        $fullNameWithValue = $instructorData['Fname'] . ' ' . $instructorData['Lname']; // Adjust this format if needed
                        $selected = ($fullNameWithValue === $instructor['Instructor']) ? 'selected' : ''; // Compare full name values

                        // Output the option with full name as text and value
                        echo '<option value="' . $fullNameWithValue . '" ' . $selected . '>' . $fullName . '</option>';
                    }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-control Room" id="room" name="Room[]" required>
                    <option value="" disabled selected>Select Room</option>
                    <?php
                    require('../config/db_connection.php');
                    $sqlRooms = "SELECT * FROM rooms WHERE DepartmentID = 1 AND Active = 1";
                    $resultRooms = $conn->query($sqlRooms);

                    while ($room = $resultRooms->fetch_assoc()) {
                        $selected = ($room['RoomNumber'] === $instructor['Room']) ? 'selected' : ''; // Check if the room matches the current row
                        echo '<option value="' . $room['RoomNumber'] . '" ' . $selected . '>' . $room['RoomNumber'] . '</option>';
                    }

                    ?>
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

        <!-- Logout Modal -->
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
                            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <!-- JavaScript Section -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/demo/datatables-demo.js"></script>
    <script src="../assets/js/filteringStrand.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Custom JavaScript -->

    <script>
        $(document).ready(function () {
            // Handle changes in the track select element
            $('#yearLevel').change(function () {
                // Get the selected track
                var yearLevel = $(this).val();

                // Make an AJAX request to fetch data
                $.ajax({
                    url: 'GetData/shs_get_year_level_section.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { yearLevel: yearLevel }, // Use 'track' here
                    success: function (data) {
                        // Update the 'strand' dropdown with the fetched data
                        $('#section').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });
                $.ajax({
                    url: 'GetData/shs_get_year_level_subject.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { yearLevel: yearLevel }, // Use 'track' here
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
        $(document).ready(function () {
            // Handle changes in the track select element
            $('#semester').change(function () {
                // Get the selected track
                var semester = $(this).val();

                var yearLevel = $('#yearLevel').val(); // Assuming 'yearLevel' comes from an element with ID 'yearLevel'

                // Make an AJAX request to fetch data
                $.ajax({
                    url: 'GetData/shs_get_year_level_semester_section.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { semester: semester, yearLevel: yearLevel }, // Use 'track' here
                    success: function (data) {
                        // Update the 'strand' dropdown with the fetched data
                        $('#section').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });
                $.ajax({
                    url: 'GetData/shs_get_year_level_semester_subject.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { semester: semester, yearLevel: yearLevel }, // Use 'track' here
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
        $(document).ready(function () {
            // Handle changes in the track select element
            $('#strand').change(function () {
                // Get the selected track
                var strand = $(this).val();

                var yearLevel = $('#yearLevel').val(); // Assuming 'yearLevel' comes from an element with ID 'yearLevel'
                var semester = $('#semester').val(); // Assuming 'yearLevel' comes from an element with ID 'yearLevel'

                // Make an AJAX request to fetch data
                $.ajax({
                    url: 'GetData/shs_get_year_level_semester_strand_subject.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { strand: strand, semester:semester,  yearLevel: yearLevel }, // Use 'track' here
                    success: function (data) {
                        // Update the 'strand' dropdown with the fetched data
                        $('#subject').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });
                $.ajax({
                    url: 'GetData/shs_get_year_level_semester_strand_section.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { strand: strand, semester:semester,  yearLevel: yearLevel }, // Use 'track' here
                    success: function (data) {
                        // Update the 'strand' dropdown with the fetched data
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
            // Handle changes in the track select element
            $('#track').change(function () {
                // Get the selected track
                var track = $(this).val();

                // Make an AJAX request to fetch data
                $.ajax({
                    url: 'GetData/shs_get_track_strand.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { track: track }, // Use 'track' here
                    success: function (data) {
                        // Update the 'strand' dropdown with the fetched data
                        $('#strand').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });
            });
        });
    </script>
    <!-- <script>
        $(document).ready(function () {
            // Handle changes in the track select element
            $('#strand').change(function () {
                // Get the selected track
                var strand = $(this).val();

                // Make an AJAX request to fetch data
                $.ajax({
                    url: 'GetData/shs_get_track_strand.php', // Replace with the actual PHP script URL
                    method: 'POST', // Use POST or GET depending on your PHP script
                    data: { strand: strand }, // Use 'track' here
                    success: function (data) {
                        // Update the 'strand' dropdown with the fetched data
                        $('#section').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });
            });
        });
    </script> -->


    <!-- <script>
    function disableWholeTable() {
        var table = document.getElementById('tb');
        table.setAttribute('disabled', true);
        var elements = table.getElementsByTagName('*');
        for (var i = 0; i < elements.length; i++) {
            elements[i].disabled = true;
        }
    }

    function enableWholeTable() {
        var table = document.getElementById('tb');
        table.removeAttribute('disabled');
        var elements = table.getElementsByTagName('*');
        for (var i = 0; i < elements.length; i++) {
            elements[i].disabled = false;
        }
    }

    function clearFields(startIndex) {
        var selects = document.querySelectorAll('.form-control');
        for (var i = startIndex; i < selects.length; i++) {
            selects[i].value = '';
        }
    }

    // Call the function to disable the whole table initially
    disableWholeTable();

    document.getElementById('yearLevel').addEventListener('change', function () {
        clearFields(1); // Start index to clear fields related to yearLevel
    });

    document.getElementById('semester').addEventListener('change', function () {
        clearFields(2); // Start index to clear fields related to semester
    });

    document.getElementById('track').addEventListener('change', function () {
        clearFields(3); // Start index to clear fields related to track
    });

    document.getElementById('strand').addEventListener('change', function () {
        clearFields(4); // Start index to clear fields related to strand
    });

    // You might need to adjust the IDs above based on your HTML structure

    // Implement logic to check if all fields are filled to enable the table
    function checkFieldsFilled() {
        var yearLevel = document.getElementById('yearLevel').value;
        var semester = document.getElementById('semester').value;
        var track = document.getElementById('track').value;
        var strand = document.getElementById('strand').value;
        var section = document.getElementById('section').value;

        if (yearLevel !== '' && semester !== '' && track !== '' && strand !== '' && section !== '') {
            enableWholeTable();
        }
    }

    // Call checkFieldsFilled whenever a selection changes
    document.getElementById('yearLevel').addEventListener('change', checkFieldsFilled);
    document.getElementById('semester').addEventListener('change', checkFieldsFilled);
    document.getElementById('track').addEventListener('change', checkFieldsFilled);
    document.getElementById('strand').addEventListener('change', checkFieldsFilled);
    document.getElementById('section').addEventListener('change', checkFieldsFilled);
</script> -->
<!-- empty data any changes -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const yearLevelSelect = document.getElementById('yearLevel');
    const sectionSelect = document.getElementById('section');
    const semesterSelect = document.getElementById('semester');
    const trackSelect = document.getElementById('track');
    const strandSelect = document.getElementById('strand');

    function updateFieldStatus(disableFields) {
        const dayCheckboxes = document.querySelectorAll('.Day');
        const timeStart = document.querySelectorAll('.Time_Start');
        const timeEnd = document.querySelectorAll('.Time_End');
        const subjects = document.querySelectorAll('.Subject');
        const instructors = document.querySelectorAll('.Instructor');
        const rooms = document.querySelectorAll('.Room');

        dayCheckboxes.forEach(checkbox => {
            checkbox.disabled = disableFields;
        });

        timeStart.forEach(timeInput => {
            timeInput.disabled = disableFields;
        });

        timeEnd.forEach(timeInput => {
            timeInput.disabled = disableFields;
        });

        subjects.forEach(subject => {
            subject.disabled = disableFields;
        });

        instructors.forEach(instructor => {
            instructor.disabled = disableFields;
        });

        rooms.forEach(room => {
            room.disabled = disableFields;
        });
    }

    let previousYearLevel = yearLevelSelect.value.trim();
    let previousSection = sectionSelect.value.trim();
    let previousSemester = semesterSelect.value.trim();
    let previousTrack = trackSelect.value.trim();
    let previousStrand = strandSelect.value.trim();

    function checkFields() {
        const yearLevel = yearLevelSelect.value.trim();
        const section = sectionSelect.value.trim();
        const semester = semesterSelect.value.trim();
        const track = trackSelect.value.trim();
        const strand = strandSelect.value.trim();

        const disableFields =
            !section || section.trim() === '' ||
            (previousYearLevel !== yearLevel) ||
            (previousSemester !== semester) ||
            (previousTrack !== track) ||
            (previousStrand !== strand);

        updateFieldStatus(disableFields);
        previousYearLevel = yearLevel;
        previousSection = section;
        previousSemester = semester;
        previousTrack = track;
        previousStrand = strand;
    }

    // Initial check when the page loads
    checkFields();

    // Add change event listeners to selects
    yearLevelSelect.addEventListener('change', checkFields);
    sectionSelect.addEventListener('change', checkFields);
    semesterSelect.addEventListener('change', checkFields);
    trackSelect.addEventListener('change', checkFields);
    strandSelect.addEventListener('change', checkFields);
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

    // Function to add a new row
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

        var scheduleDataArray = [];

        $("#tb tr:not(:first)").each(function () {
            var scheduleData = {
                AcademicYear: generateAcademicYear(),
                Department: 'Primary',
                YearLevel: document.getElementById("yearLevel").value,
                Day: $(this).find(".Day:checked").map(function () {
                    return this.value;
                }).get().join(),
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
            var currentMonth = currentDate.getMonth() + 1;

            if (currentMonth >= 6 && currentMonth <= 12) {
                return currentDate.getFullYear() + "-" + (currentDate.getFullYear() + 1);
            } else {
                return (currentDate.getFullYear() - 1) + "-" + currentDate.getFullYear();
            }
        }

        // Send AJAX request
        $.ajax({
            type: "POST",
            url: "CheckingError/check_add_more.php",
            data: { data: scheduleDataArray },
            success: function (response) {
                handleResponseMessages(response);
                // Add a new row if the response is successful
                if (response.every(item => item.status === 'success')) {
                    appendNewRow();
                }
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

    // Function to append a new row
    function appendNewRow() {
        var newRow = $("#tb tbody tr:last").clone(true); // Clone the last row
        var rowLength = $("#tb tbody tr").length; // Get the number of rows

        // Update IDs of elements in the cloned row to make them unique
        newRow.find('.Subject').attr('id', 'subject_' + rowLength);
        newRow.find('.Instructor').attr('id', 'instructor_' + rowLength); // Set unique ID for Instructor
        newRow.find('.Room').attr('id', 'room_' + rowLength); // Set unique ID for Room
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
                timeEndNew.val(''); // Empty Time_End if it's the same or less than Time_Start
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
                title: 'Are you sure?',
                text: 'Do you want to remove this row?',
                icon: 'warning',
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
    var track = document.getElementById('track').value;
    var strand = document.getElementById('strand').value;
    var semester = document.getElementById('semester').value;


    // Check if YearLevel and Section are filled
    if (yearLevel.trim() === '' || section.trim() === ''  || semester.trim() === ''  || track.trim() === ''  || strand.trim() === '') {
        return false; // YearLevel or Section is empty, return false
    }

    var allFieldsFilled = true;

    // Loop through each row
    $("#tb tr:not(:first)").each(function () {
        var checkboxes = $(this).find('.Day');
        var subjects = $(this).find('.Subject');
        var timesStart = $(this).find('.Time_Start');
        var timesEnd = $(this).find('.Time_End');
        var instructors = $(this).find('.Instructor');
        var rooms = $(this).find('.Room');

        // Check if any field in the row is empty
        if (
            checkboxes.filter(':checked').length === 0 ||
            subjects.filter(function () { return $(this).val().trim() === ''; }).length > 0 ||
            instructors.filter(function () { return $(this).val() === '' || $(this).val() === null; }).length > 0 ||
            rooms.filter(function () { return $(this).val() === '' || $(this).val() === null; }).length > 0 ||
            timesStart.filter(function () { return $(this).val().trim() === ''; }).length > 0 ||
            timesEnd.filter(function () { return $(this).val().trim() === ''; }).length > 0
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
            icon: 'success',
            title: 'Confirmation',
            text: 'Are you sure you want to save the schedule?',
            showCancelButton: true,
            confirmButtonText: 'Yes, save it!',
            cancelButtonText: 'No, cancel!',
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
    var subjectHours = {}; // Object to store total hours per subject

    // Check for overlaps before saving
    if (hasOverlapForSave()) {
        showOverlapWarningForSave();
        return;
    }

    // Calculate total hours per subject for all selected days
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
        var totalHours = totalMinutes / 60;

        if (subjectHours[subject]) {
            subjectHours[subject] += totalHours;
        } else {
            subjectHours[subject] = totalHours;
        }
    });

    // Check if any subject exceeds 4 hours per week
    // var exceedSubjects = Object.keys(subjectHours).filter(function (subject) {
    //     return subjectHours[subject] > 4; // 4 hours per week
    // });

    // if (exceedSubjects.length > 0) {
    //     // Display a warning for subjects exceeding 4 hours per week
    //     var exceedSubjectNames = exceedSubjects.join(', ');
    //     Swal.fire({
    //         icon: 'warning',
    //         title: 'Warning',
    //         text: 'The following subjects exceed 4 hours per week: ' + exceedSubjectNames,
    //     });
    //     return; // Prevent saving
    // }



    // Collect data for each row
    $("#tb tr:not(:first)").each(function () {
        var scheduleData = {
            AcademicYear: generateAcademicYear(), // Call the function to generate academic year
            Department: 'Senior High School',
            YearLevel: document.getElementById("yearLevel").value,
            Semester: document.getElementById("semester").value,// Assuming you have a class "Semester" in your HTML
            Strand: document.getElementById("strand").value,// Assuming you have a class "Semester" in your HTML
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
        url: "save_shs_schedule.php",
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

// Function to show overlap warning before saving
function showOverlapWarningForSave() {
    Swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: 'Time overlap detected! Please adjust the schedule.',
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
            url: 'GetData/shs_get_subject_instructor.php',
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



</body>
</html>