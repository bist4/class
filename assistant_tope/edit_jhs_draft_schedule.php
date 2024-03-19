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

    if(isset($_GET['yearLevel']) && isset($_GET['section'])) {
        $yearLevel = $_GET['yearLevel'];
        $section = $_GET['section'];
    
        // Fetch data from the database based on Year Level and Section
        // Perform necessary database query here using your connection $conn
        // Example query to retrieve data
        $sql = "SELECT * FROM classschedule WHERE YearLevel = '$yearLevel' AND Section = '$section' AND Active = 0";
        $result = $conn->query($sql);
    
        // Check if the query execution was successful
        if ($result) {
            if ($result->num_rows > 0) {
                // Fetch all rows of data into an array
                $scheduleData = $result->fetch_all(MYSQLI_ASSOC);
    
                // Loop through each row in the fetched data
                foreach ($scheduleData as $row) {
                    // Use $row['columnName'] to access data for each row
                    $day = $row['Day'];
                    $timeStart = $row['Time_Start'];
                    $timeEnd = $row['Time_End'];
                    $subject = $row['Subject'];
                    $instructor = $row['Instructor'];
                    $room = $row['Room'];
    
                    // Output or process data as needed
                    // Here you can create your HTML structure or perform further actions
                }
            } else {
                // Handle case where no data is found
                echo "No data found for the specified criteria.";
            }
        } else {
            // Handle query execution error
            echo "Error executing the query: " . $conn->error;
        }
    } else {
        // Handle the case where parameters are missing
        echo "Year Level and Section parameters are required.";
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

    <title>Edit Junior High School Draft Schedule</title>

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
                            <a class="collapse-item" href="jhs_draft_schedule.php">Junior High School</a>
                            <a class="collapse-item active" href="primary_draft_schedule.php">Primary</a>
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
                <li class="nav-item">
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

                            <!-- Alerts Dropdown -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <span class="badge badge-danger badge-counter">3+</span>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <!-- ... (Alerts Content) ... -->
                                    </a>
                                    <!-- Add more alerts items as needed -->
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                </div>
                            </li>

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
                        <div class="container mt-4 mb-4">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 ">
                                    <h1 style="font-size: 25px;">Edit draft schedule for grade <?php echo $yearLevel . ' section ' . $section; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Any content you want to add here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <form id="updateForm">
                                <?php
                                            require('../config/db_connection.php');
                                            // Your PHP code to fetch and display data from the database
                                            ?>
                                <div class="table-responsive">
                                        <table class="table table-hover small-text" id="tb">
                                            <thead class="tr-header">
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Time Start</th>
                                                    <th>Time End</th>
                                                    <th>Subject</th>
                                                    <th>Instructor</th>
                                                    <th>Room</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($scheduleData as $row) { ?>

                                                    <tr>
                                                    
                                                        <td>
                                                        <input type="hidden" class="ClasscheduleID" value="<?php echo $row['ClasscheduleID']; ?>">
                                                            <select disabled class="form-control Day" id="Day" name="Day[]" required>
                                                                <option value="M" <?php if($row['Day'] === 'M') echo 'selected'; ?>>Monday</option>
                                                                <option value="T" <?php if($row['Day'] === 'T') echo 'selected'; ?>>Tuesday</option>
                                                                <option value="W" <?php if($row['Day'] === 'W') echo 'selected'; ?>>Wednesday</option>
                                                                <option value="TH" <?php if($row['Day'] === 'TH') echo 'selected'; ?>>Thursday</option>
                                                                <option value="F" <?php if($row['Day'] === 'F') echo 'selected'; ?>>Friday</option>
                                                            </select>

                                                        </td>
                                                        <td>
                                                            <input disabled type="time" class="form-control Time_Start" id="Time_Start" name="Time_Start[]" min="08:00" max="17:00" required value="<?php echo $row['Time_Start']; ?>">
                                                        </td>
                                                        <td>
                                                            <input disabled type="time" class="form-control Time_End" id="Time_End" name="Time_End[]" min="08:00" max="17:00" required value="<?php echo $row['Time_End']; ?>">
                                                        </td>
                                                        <td>
                                                            <select disabled class="form-control Subject" id="subject" name="Subject[]" required>
                                                                <?php
                                                                // Assuming 'DepartmentID' is the foreign key in the 'subjects' table that references the 'department' table
                                                                // Replace 'YearLevelField' with the correct field name in the 'department' table that holds the year level

                                                                // Fetch subjects based on the department's YearLevel
                                                                $sqlSubjects = "SELECT s.* FROM subjects s 
                                                                                JOIN department d ON s.DepartmentID = d.DepartmentID 
                                                                                WHERE d.YearLevel = '$yearLevel'";

                                                                $resultSubjects = $conn->query($sqlSubjects);

                                                                if ($resultSubjects) {
                                                                    while ($subject = $resultSubjects->fetch_assoc()) {
                                                                        $selected = ($subject['SubjectDescription'] === $row['Subject']) ? 'selected' : '';
                                                                        echo '<option value="' . $subject['SubjectDescription'] . '" ' . $selected . '>' . $subject['SubjectDescription'] . '</option>';
                                                                    }
                                                                } else {
                                                                    // Handle the case where the query fails
                                                                    echo "Error fetching subjects: " . $conn->error;
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>


                                                        <td>
                                                            <select class="form-control Instructor" id="instructor" name="Instructor[]" required>
                                                                <option value="" disabled selected>Select Instructor</option>
                                                                <?php
                                                                // Fetch all available instructors for DepartmentID 3 from the database
                                                                $sqlInstructors = "SELECT * FROM instructor WHERE DepartmentID = 2 AND Active = 1";
                                                                $resultInstructors = $conn->query($sqlInstructors);

                                                                while ($instructor = $resultInstructors->fetch_assoc()) {
                                                                    $fullName = $instructor['Fname'] . ' ' . $instructor['Lname'];
                                                                    $fullNameWithValue = $instructor['Fname'] . ' ' . $instructor['Lname']; // Adjust this format if needed
                                                                    $selected = ($fullNameWithValue === $row['Instructor']) ? 'selected' : ''; // Compare full name values

                                                                    // Output the option with full name as text and value
                                                                    echo '<option value="' . $fullNameWithValue . '" ' . $selected . '>' . $fullName . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>


                                                        <td>
                                                            <select disabled class="form-control Room" id="room" name="Room[]" required>
                                                                <option value="" disabled selected>Select Room</option>
                                                                <?php
                                                                $sqlRooms = "SELECT * FROM rooms WHERE DepartmentID = 2 AND Active = 1";
                                                                $resultRooms = $conn->query($sqlRooms);

                                                                while ($room = $resultRooms->fetch_assoc()) {
                                                                    $selected = ($room['RoomNumber'] === $row['Room']) ? 'selected' : ''; // Check if the room matches the current row
                                                                    echo '<option value="' . $room['RoomNumber'] . '" ' . $selected . '>' . $room['RoomNumber'] . '</option>';
                                                                }

                                                                ?>
                                                            </select>
                                                            

                                                        </td>
                                                        <td><a href='javascript:void(0);' id="removeRow"><span class='fas fa-minus remove'></span></a></td>

                                                        
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" id="cancelBtn" onclick="location.href='jhs_draft_schedule.php';" class="btn btn-outline-secondary mr-2">Cancel</button> 
                                            <button type="button" id="updateBtn" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>

                                </form>

                                <div class="card-body">
                                    <!-- Additional content goes here -->
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
    <script>
    $(document).ready(function() {
        $("#updateBtn").on("click", function() {
            // Display SweetAlert confirmation
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to update?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gather selected values from the form
                    var classScheduleIDs = [];
                    var days = [];
                    var timeStarts = [];
                    var timeEnds = [];
                    var subjects = [];
                    var instructors = [];
                    var rooms = [];

                    // Loop through each row in the table
                    $("tbody tr").each(function() {
                        classScheduleIDs.push($(this).find(".ClasscheduleID").val());
                        days.push($(this).find(".Day").val());
                        timeStarts.push($(this).find(".Time_Start").val());
                        timeEnds.push($(this).find(".Time_End").val());
                        subjects.push($(this).find(".Subject").val());
                        instructors.push($(this).find(".Instructor").val());
                        rooms.push($(this).find(".Room").val());
                    });

                    // If confirmed, perform the AJAX request
                    $.ajax({
                        url: 'DataUpdate/update_jhs_schedule.php',
                        type: 'POST',
                        data: {
                            classScheduleIDs: classScheduleIDs,
                            days: days,
                            timeStarts: timeStarts,
                            timeEnds: timeEnds,
                            subjects: subjects,
                            instructors: instructors,
                            rooms: rooms
                        },

                        success: function(response) {
                            console.log(response);
                            // Handle the success response after update
                            Swal.fire({
                                title: 'Success',
                                text: 'Update successfully!',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'jhs_draft_schedule.php';
                                    // You can perform further actions after the user clicks "OK"
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors that occur during the AJAX request
                            console.error(error);
                            // You can display an error message or handle the error accordingly
                        }
                    });
                }
            });
        });
    });
</script>

</body>
</html>