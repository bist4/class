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
    <link href="chosen.css" rel="stylesheet">

    <title>Instructor - File Maintenance</title>
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
        .table-responsive::-webkit-scrollbar {
            display: show;
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
                        <!-- <a class="collapse-item active" href="file_instructor.php">Instructor</a> -->
                        <a class="collapse-item" href="file_section.php">Class Section</a>
                        <a class="collapse-item" href="file_room.php">Room</a>
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
                        <h1 class="h3 mb-2 text-gray-800">Add New Instructor</h1>
                    </div>
                    

                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            
                             

                            <div id="myForm">
                                <!-- Form Add Data -->
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control blogcat" multiple name="Department[]" id="department" title="Select Department" required>
                                        <!-- Department options -->
                                        <option value="" disabled>Select Department</option>
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
                                <br>
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">First Name</label>
                                                <input type="text" class="form-control" id="Fname" name="Fname" placeholder="Enter First Name" required title="Input First Name" oninput="validateNoSpace(this)">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mname">Middle Name <span class="small">(optional)</span></label>
                                                <input type="text" class="form-control" id="Mname" name="Mname" placeholder="Enter Middle Name" title="Input Middle Name" oninput="validateNoSpace(this)">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="lname">Last Name</label>
                                                <input type="text" class="form-control" id="Lname" name="Lname" placeholder="Enter Last Name" required title="Input Last Name" oninput="validateNoSpace(this)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control" id="Gender" name="Gender" required title="Select Gender">
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="birthday">Birthday</label>
                                                <input type="date" class="form-control" id="Birthday" name="Birthday" required title="Input Birthday">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="Address" name="Address" placeholder="Enter Address" required title="Input Address" oninput="validateNoSpace(this)">
                                    </div>

                                    <label for="Contact">Contact Number</label>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <span class="flag-icon flag-icon-ph"></span>
                                                +63 <!-- Country code -->
                                            </span>
                                        </div>
                                        <input type="tel" class="form-control" id="Contact" name="ContactNumber" placeholder="9123456780" required title="Input Contact Number">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter Email" required title="Input Email">
                                    </div>

                                    <div class="form-group">
                                        <label for="specialization">Specialization</label>
                                        <select class="form-control blogcat" multiple name="Specialization" id="Specialization" required title="Input Specialization">
                                            <option value="" disabled>Select Specialization</option>
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

                                        <!-- <input type="text" class="form-control" id="Specialization" name="Specialization" placeholder="Enter Specialization" required title="Input Specialization" oninput="validateNoSpace(this)"> -->
                                    </div>
                                   

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="Status" name="Status" required title="Select Status">
                                            <option value="" disabled selected>Select Status</option>
                                            <option value="Full Time">Full-Time</option>
                                            <option value="Part Time">Part-Time</option>
                                        </select>
                                    </div> 

                                    
                                </div>
                            </div>
                            <!-- Form End -->
                        </div>
                       
                        <!-- End Card Body -->
                    </div> 
                    <div class="text-center" id="btnSave">
                        <button type="submit" id="saveBtn" name="add" class="btn btn-primary btn-save">Save</button>
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

    <!-- Print and Import to Excel -->
    <script src="../assets/js/DataPrintExcel/print_subject.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
    // JavaScript function to validate and disallow spaces
        function validateNoSpace(inputField) {
            inputField.value = inputField.value.replace(/\s/g, ''); // Replace any spaces with an empty string
        }
    </script>

    <!-- Lock Button -->
    <script>
        $(document).ready(function() {
            // Function to check if all required fields are filled
            function checkFields() {
                var allFilled = true;
                var department = $('#deparment').val();

                if(department !== '' && department === null){
                    $('#saveBtn').show();
                } else {
                    $('#saveBtn').hide();
                }
                

                // Check each required field
                $('input[required], select[required]').each(function() {
                    if ($(this).val() === '' || $(this).val() === null) {
                        allFilled = false;
                        return false; // Exit loop early if any field is empty
                    }
                });

                // Show/hide save button based on field completion
                if (allFilled) {
                    $('#saveBtn').show();
                } else {
                    $('#saveBtn').hide();
                }
            }

            // Trigger field check on input change
            $('input[required], select[required]').on('input change', function() {
                checkFields();
            });

            // Initially hide the save button
            $('#saveBtn').hide();
        });
    </script>
    <!-- Number format -->
    <script>
        $(document).ready(function() {
            $('#Contact').on('input', function() {
                var input = $(this).val().replace(/\D/g, ''); // Remove non-digit characters
                
                // If the first character is '0', ensure it doesn't persist
                if (input.charAt(0) === '0') {
                    input = input.substring(1);
                }
                
                // Limit the total length to 10 digits
                if (input.length > 10) {
                    input = input.substring(0, 10);
                }

                var formatted = '';
                if (input.length > 6) {
                    formatted += input.substr(0, 3) + ' ' + input.substr(3, 3) + ' ' + input.substr(6);
                } else if (input.length > 3) {
                    formatted += input.substr(0, 3) + ' ' + input.substr(3);
                } else {
                    formatted += input;
                }

                $(this).val(formatted.replace(/\s/g, '')); // Remove spaces before setting the value
            });
        });

    </script>
    
    <!--Others -->
    <script>
        function showHideFields() {
            var select = document.getElementById("Specialization");
            var otherFields = document.getElementById("otherFields");

                if (select.value === "Others") {
                    otherFields.style.display = "block";
                } else {
                    otherFields.style.display = "none";
                }
            }
    </script>
     

    <!-- Insert Data -->
    <script>
        $(document).ready(function() {
            $('#saveBtn').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                var fieldsFilled = true;
                // Gather form data
                var formData = {
                    Department: $('#department').val(),
                    Fname: $('#Fname').val(),
                    Mname: $('#Mname').val(),
                    Lname: $('#Lname').val(),
                    Gender: $('#Gender').val(),
                    Birthday: $('#Birthday').val(),
                    Address: $('#Address').val(),
                    ContactNumber: $('#Contact').val(),
                    Email: $('#Email').val(),
                    Specialization: $('#Specialization').val(),
                    Status: $('#Status').val()
                };

                // Check if Department or Status is null or empty
                if (formData.Status === '' || formData.Status === null || formData.Gender === '' || formData.Gender === null) {
                    fieldsFilled = false;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Please fill in all fields.',
                    });
                    return false; // Stop further execution
                }

                var departmentSelect = document.getElementById('department');

                // Check if any option is selected
                if (departmentSelect.value.length === 0) {
                    // If no option is selected, show a warning message
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Please select at least one department.',
                    });
                }
                 // Validate Fname, Mname, and Lname (no numbers allowed)
                var containsNumber = /\d/;
                if (containsNumber.test(formData.Fname) || containsNumber.test(formData.Mname) || containsNumber.test(formData.Lname)) {
                    Swal.fire({
                        title: "Error!",
                        text: "Name fields should not contain numbers.",
                        icon: "error",
                    });
                    return; // Stop further execution
                }


                // Send form data using AJAX
                $.ajax({
                    type: 'POST',
                    url: 'DataAdd/add_Instructor.php',
                    data: formData,
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.success) {
                            Swal.fire({
                                title: "Success!",
                                text: response.message, // Display success message
                                icon: "success",
                            }).then(function() {
                                location.reload();
                            });
                        } else if (response.warning) {
                            Swal.fire({
                                title: "Warning!",
                                text: response.message, // Display error message
                                icon: "warning",
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = "Failed to add instructor. Please try again.";

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            title: "Error!",
                            text: errorMessage,
                            icon: "error",
                        });
                    }
                });


            });
        });
    </script>

    <!-- MultiSelect -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".blogcat").chosen();
    </script>




</body> 

</html>


