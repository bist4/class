<?php
require "../config/db_connection.php";
include "../security.php"; // Start the session


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
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../assets/js/alert.js"></script>

    
    <title>Room - File Maintenance</title>
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

<?php include "session_out.php"; ?>

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
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>File Maintenance</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="file_strand.php">Strand</a>
                        <a class="collapse-item" href="file_subject.php">Subject</a>
                        <!-- <a class="collapse-item" href="file_instructor.php">Instructor</a> -->
                        <a class="collapse-item" href="file_section.php">Class Section</a>
                        <a class="collapse-item active" href="file_room.php">Room</a>
                        <a class="collapse-item" href="timeAvail.php">Instructor Availability</a>

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
                        <h1 class="h3 mb-2 text-gray-800">Add New Room</h1>
                    </div>
                
                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            
                            <div id="myForm">
                                <!-- Form Add Data -->
                                <div class="col-md-6">
                                    <label for="department">Department</label>
                                    
                                    <select class="form-control" id="department" name="Department" required>
                                        <option value="" disabled selected>Select Department</option>
                                        <?php
                                            include('../config/db_connection.php');

                                            
                                            $sqlDepartmentType = "SELECT * FROM departmenttypes";
                                            $resultDepartmentTypeName = $conn->query($sqlDepartmentType);
                                            if ($resultDepartmentTypeName->num_rows > 0) {
                                                while ($row = $resultDepartmentTypeName->fetch_assoc()) {
                                                    // Check if DepartmentTypeName is not empty or NULL
                                                    if (!empty($row['DepartmentName'])) {
                                                        echo '<option value="' . $row['DepartmentTypeID'] . '">' . $row['DepartmentName'] . '</option>';
                                                    }
                                                }
                                            }
                                        ?>
                                     </select>
                                </div>  
                                <br>
                                <div class="table-responsive">
                                    <table  class="table table-hover small-text" id="tb">
                                        <tr class="tr-header">
                                            
                                            <th><label class="form-check-label" for="hideRoomNo">Room Number</label></th>
                                            <th><label class="form-check-label" for="hideCapacity">Capacity</label></th>
                                            <th><label class="form-check-label" for="hideRoomType">Room Type</label></th>
                                            
                                            <th>
                                                <a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Room">
                                                <span class="fas fa-plus"></span>
                                                </a>
                                            </th>
                                        <tr>
                                        <td class="col-md-4">
                                            
                                            <input type="text" class="form-control" id="roomNo" name="RoomNo[]"  placeholder="Enter Room No." maxlength="3" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                        </td>
                                        <td class="col-md-4">
                                        <input type="number" class="form-control" id="capacity" name="Capacity[]" placeholder="Enter Capacity"  maxlength="3" placeholder="Enter Capacity" required>
                                        </td>
                                        <td class="col-md-5">
                                            <select class="form-control" id="roomType" name="RoomTypeName[]" required>
                                                <option value="" disabled selected>Select Room Type</option>
                                                <option value="Lecture">Lecture</option>
                                                <option value="Laboratory">Laboratory</option>
                                        </select>
                                        </td>
                                            <td><a href='javascript:void(0);'  class='remove'><span class='fas fa-minus'></span></a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- Form End -->
                        </div>
                       
                        <!-- End Card Body -->
                    </div> 
                    <div class="text-center" id="btnSave">
                        <button type="submit" id="saveBtn" name="add" class="btn btn-primary btn-save" disabled>Save</button>
                    </div>
                    <!-- End Card -->
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
	<script src="../assets/js/capitalLetter.js"></script>
    <!-- Print and Import to Excel -->
    <script src="../assets/js/DataPrintExcel/print_subject.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- Warning message for clicking the add more row button -->
    <script>
        $(function () {
            $('#addMore').on('click', function () {
                // Clone the second row (index 1) to add a new row  
                var department = document.getElementById('department').value.trim();
                var roomNo = document.getElementById('roomNo').value.trim();
                var capacity = document.getElementById('capacity').value.trim();
                var roomType = document.getElementById('roomType').value.trim();



                if (!department) {
                    // If any input data is missing, show SweetAlert
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Please select Department',
                    });
                }
                else if (!roomNo) {
                    // If any input data is missing, show SweetAlert
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Please input Room Number',
                    });
                }
                else if (!capacity) {
                    // If any input data is missing, show SweetAlert
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Please input Room Capacity',
                    });
                }
                else if (!roomType) {
                    // If any input data is missing, show SweetAlert
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Please select Room Type',
                    });
                } else{
                    var newRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                    // Clear input values in the new row
                    newRow.find("input").val('');    

                    var roomNo = newRow.find("input[name='RoomNo[]']").val();
                    if (roomNo.trim() !== '') {
                        newRow.find("input[name='Capacity[]']").val(30);
                    }
                }
                

                // Add code to save values to the database here
                saveToDatabase(newRow);
            });

            $(document).on('click', '.remove', function () {
                var trIndex = $(this).closest("tr").index();
                if (trIndex > 1) {
                    $(this).closest("tr").remove();
                } else {
                    // Use SweetAlert for the error message
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: "Sorry, Can't remove first row",
                    });
                }
            });

        
        });
    </script>
  
    <script>
        $(document).ready(function() {
            // Function to check if all fields are filled
            function checkFields() {
                var department = $('#department').val();
                var roomNo = $('#roomNo').val();
                var capacity = $('#capacity').val();
                var roomType = $('#roomType').val();

                if (department !== "" && roomNo !== "" && capacity !== "" && roomType !== null) {
                    $('#saveBtn').prop('disabled', false); // Enable the button
                } else {
                    $('#saveBtn').prop('disabled', true); // Disable the button
                }
            }

            // Check fields on input/change
            $('#department, #roomNo, #capacity, #roomType').on('input change', function() {
                checkFields();
            });

            // Initial check on page load
            checkFields();
        });
    </script>


   <!-- Lock btn -->
   <script>
        $(document).ready(function () {
            function checkFields() {
                var allFilled = true;

                // Use the same type of selector as in HTML for consistency
                $('input[name^="RoomNo[]"], input[name^="Capacity[]"], select[name^="RoomTypeName[]"]').each(function () {
                    if ($(this).val() === '') {
                        allFilled = false;
                        return false; // Break the loop if any field is empty
                    }
                });

                // Enable or disable the save button based on the fields' status
                if (allFilled) {
                    $('#saveBtn').prop('disabled', false);
                } else {
                    $('#saveBtn').prop('disabled', true);
                }
            }

            // Check fields when any input changes
            $('input[name^="RoomNo[]"], input[name^="Capacity[]"], select[name^="RoomTypeName[]"]').on('input', function () {
                checkFields();
            });

            // Check fields on initial page load
            checkFields();
        }); 
    </script>


    <!-- Insert data -->
    <script>
         var changesMade = false;
    var updateSuccess = false;
        $(document).ready(function() {
            function setChangesMade() {
            changesMade = true;
        }

        // Bind change event to form elements
        $(".form-control").change(setChangesMade);

        // Bind beforeunload event to show confirmation message
        window.addEventListener('beforeunload', function(e) {
            if (changesMade && !updateSuccess) {
                var confirmationMessage = "Changes you made may not be saved. Are you sure you want to leave?";
                (e || window.event).returnValue = confirmationMessage;
                return confirmationMessage;
            }
        });
            $('.btn-save').click(function(e) {
                changesMade = false;
                e.preventDefault();

                var formData = {};
                formData['DepartmentTypeID'] = $('#department').val();
                var rooms = [];
                var fieldsFilled = true;
                
                
                var existingRoomNo = [];
                

                $('#tb tbody tr').each(function(index) {
                    var room = {};
                    room['RoomNo'] = $(this).find('input[name="RoomNo[]"]').val();
                    room['Capacity'] = $(this).find('input[name="Capacity[]"]').val();
                    room['RoomTypeName'] = $(this).find('select[name="RoomTypeName[]"]').val();

                
            
                    if (
                        room['RoomNo'] === '' ||
                        room['Capacity'] === '' ||
                        room['RoomTypeName'] === ''
                    ) {
                        fieldsFilled = false;
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Please fill in all fields.',
                        });
                        return false; // Exit the loop early if any field is empty
                    }

                    if (existingRoomNo.includes(room['RoomNo'])) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Room Number ' + room['RoomNo'] + ' already exists in row ' + (index),
                        });
                        fieldsFilled = false;
                        return false; // Break the loop if a duplicate is found
                    }
                   
                    existingRoomNo.push(room['RoomNo']);
                  
                    // Check if Room Number or Capacity is '0'
                    if (room['RoomNo'] === '0' || room['Capacity'] === '0') {
                        fieldsFilled = false;
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Room Number and Capacity cannot be 0.',
                        });
                        return false; // Exit the loop if '0' is found
                    }
                    rooms.push(room);
                });

                if (!fieldsFilled) {
                    return; // Stop further execution if any field is empty or if there are duplicates
                }

                // Proceed with inserting valid data into the database
                formData['Rooms'] = rooms;

                $.ajax({
                    type: 'POST',
                    url: 'DataAdd/add_Room.php', 
                    data: formData,
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.success,
                            }).then(function() {
                                window.location.href = 'file_room.php';
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while retrieving data.',
                        }).then(function() {
                            window.location.href = 'file_room.php';
                        });
                    }
                });
            });
        });

    </script>
        

      

</body>

</html>


