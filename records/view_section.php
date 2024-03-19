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
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
        <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="../assets/js/alert.js"></script>
        <title>Edit Section - View Records</title>

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
                            <!-- <a class="collapse-item" href="../filemaintenance/file_instructor.php">Instructor</a> -->
                            <a class="collapse-item" href="../filemaintenance/file_section.php">Class Section</a>
                            <a class="collapse-item" href="../filemaintenance/file_room.php">Room</a>
                            <a class="collapse-item" href="../filemaintenance/timeAvail.php">Instructor Availability</a>

                        </div>
                    </div>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseView"
                        aria-expanded="true" aria-controls="collapseView">
                        <i class="fas fa-fw fa-eye"></i>
                        <span>View Records</span>
                    </a>
                    <div id="collapseView" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="view_strand.php">Strand</a>
                            <a class="collapse-item" href="view_subject.php">Subject</a>
                            <a class="collapse-item" href="view_instructor.php">Instructor</a>
                            <a class="collapse-item active" href="view_section.php">Class Section</a>
                            <a class="collapse-item" href="view_room.php">Room</a>
                            <a class="collapse-item" href="view_timeAvail.php">Instructor Availability</a>

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
                            
                            <a class="collapse-item" href="../utilities/accounts.php">Account Managment</a>
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
                            <div id="actions"> 
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                    <label class="form-check-label" for="checkAll">Check All</label>
                                    </div>
                                        <a href="#" class="mx-2" id="editAll">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="#" class="btn-delete" id="deleteAll">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </div>
                                <div>
                                
                                <!-- Print Button -->
                                <button onclick="printTable()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-print fa-sm text-white-50"></i> Print
                                </button>
                                <a href="section.php" target="_blank">
                                    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-print fa-sm text-white-50"></i> Print All
                                    </button>
                                </a>
                                
                                <!-- Excel Button -->
                            </div>
                        </div>

                        <br>

                        <div class="col-md-6">
                            <label for="department">Department</label>
                            <select class="form-control" id="department" name="Department" required>
                                <option value="" disabled selected>Select Year Level</option>
                                <!-- Your PHP code to generate department options -->
                                <?php
                                            require "../config/db_connection.php";

                                            $sqlDepartment = "SELECT d.DepartmentID, d.GradeLevel, d.Semester, s.StrandID, s.StrandCode, dt.DepartmentName
                                                            FROM departments d
                                                            LEFT JOIN strands s ON d.StrandID = s.StrandID
                                                            LEFT JOIN departmenttypes dt ON d.DepartmentTypeNameID = dt.DepartmentTypeID 
                                                            WHERE d.Active = 1 
                                                            ORDER BY FIELD(dt.DepartmentName, 'Primary', 'Junior High School', 'Senior High School') ASC, 
                                                                d.GradeLevel ASC, 
                                                                dt.DepartmentName DESC";

                                            $resultDepartmentTypeName = $conn->query($sqlDepartment);

                                            if ($resultDepartmentTypeName->num_rows > 0) {
                                                $primaryOptions = [];
                                                $juniorHighOptions = [];
                                                $grade11Semester1Options = [];
                                                $grade11Semester2Options = [];
                                                $grade12Semester1Options = [];
                                                $grade12Semester2Options = [];

                                                while ($row = $resultDepartmentTypeName->fetch_assoc()) {
                                                    $option = '<option value="' . $row["DepartmentID"] . '">'. "Grade " . $row["GradeLevel"];

                                                    if (!is_null($row["StrandID"])) {
                                                        $option .= "-" . $row["StrandCode"];
                                                    }

                                                    // if (!is_null($row["Semester"])) {
                                                    //     $semesterSuffix = $row["Semester"] == 1 ? "st" : "nd";
                                                    //     $option .= " " . $row["Semester"] . $semesterSuffix . " Semester";
                                                    // }

                                                    $option .= "</option>";

                                                    // Group options by DepartmentName
                                                    switch ($row["DepartmentName"]) {
                                                        case "Primary":
                                                            $primaryOptions[] = $option;
                                                            break;
                                                        case "Junior High School":
                                                            $juniorHighOptions[] = $option;
                                                            break;
                                                        case "Senior High School":
                                                            // Group Senior High School options by grade and semester
                                                            if ($row["GradeLevel"] == 11) {
                                                                if ($row["Semester"] == 1) {
                                                                    $grade11Semester1Options[] = $option;
                                                                } elseif ($row["Semester"] == 2) {
                                                                    $grade11Semester2Options[] = $option;
                                                                }
                                                            } elseif ($row["GradeLevel"] == 12) {
                                                                if ($row["Semester"] == 1) {
                                                                    $grade12Semester1Options[] = $option;
                                                                } elseif ($row["Semester"] == 2) {
                                                                    $grade12Semester2Options[] = $option;
                                                                }
                                                            }
                                                            break;
                                                    }
                                                }

                                                // Output grouped options
                                                echo '<optgroup label="Primary">' . implode("", $primaryOptions) . '</optgroup>';
                                                echo '<optgroup label="Junior High School">' . implode("", $juniorHighOptions) . '</optgroup>';
                                                echo '<optgroup label="1st Semester">' . implode("", $grade11Semester1Options) . '</optgroup>';
                                                echo '<optgroup label="2nd Semester">' . implode("", $grade11Semester2Options) . '</optgroup>';
                                                echo '<optgroup label="1st Semester">' . implode("", $grade12Semester1Options) . '</optgroup>';
                                                echo '<optgroup label="2nd Semester">' . implode("", $grade12Semester2Options) . '</optgroup>';
                                            }
                                        ?>
   
                            </select>
                        </div>

                        <br>

                      
 
                     
                       <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                 <!-- Table container -->
                                <div id="strandTableContainer">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <!-- Table headers -->
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Section Number</th>
                                                    <th scope="col">Section Name</th>
                                                     
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody id="strandTable">
                                                <!-- Content will be dynamically populated using JavaScript -->
                                            </tbody>
                                        </table>
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
        <!-- For filtering of subjects details -->
        <script src="../assets/js/filteringStrand.js"></script>

        <!-- loading -->
 
 
        <!-- Print and Import to Excel -->
        <script src="../assets/js/DataPrintExcel/print_subject.js"></script>


        <!-- Check All -->
        <script>
            // JavaScript function to handle 'Check All' functionality
            document.getElementById('checkAll').addEventListener('change', function () {
                var checkboxes = document.querySelectorAll('#strandTable input[type="checkbox"]');
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = document.getElementById('checkAll').checked;
                });
            });
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

                    // Redirect to the edit page with selected SubjectID values
                    if (selectedStrandIDs.length > 0) {
                        var editURL = 'EditData/edit_section.php?subid=' + selectedStrandIDs.join(',');
                        window.location.href = editURL;
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

        <!--DeleteAll  -->
        <script>
            $(document).ready(function () {
                // Function to handle 'Edit' click event
                $('#deleteAll').click(function (e) {
                    e.preventDefault();

                    // Array to store selected StrandIDs
                    var selectedStrandIDs = [];

                    // Loop through each checked checkbox to get the SubjectID
                    $('.checkSingle:checked').each(function () {
                        selectedStrandIDs.push($(this).data('id'));
                    });

                    // Redirect to the edit page with selected SubjectID values
                    if (selectedStrandIDs.length > 0) {
                        var editURL = 'DeleteData/delete_section.php?delid=' + selectedStrandIDs.join(',');
                        window.location.href = editURL;
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


    <script>
        $(document).ready(function () {
            // Attach an event listener to the department dropdown
            $('#department').on('change', function () {
                var departmentID = $(this).val();

                // Send an AJAX request to fetch subjects based on the selected department
                $.ajax({
                    url: 'DataGet/get_section.php', // Adjust the URL to your server-side script
                    method: 'POST',
                    data: { departmentID: departmentID },
                    success: function (response) {
                        // Update the table content with the fetched data
                        $('#strandTableContainer').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>



<!-- Print -->
<script>
    function printTable() {
      var printWindow = window.open('', '_blank');
      printWindow.document.write('<html><head><title>Sections</title>');

      // Add the necessary styles for printing
      printWindow.document.write(`
          <style>
              /* Add any necessary CSS styles for formatting */
              table {
                  border-collapse: collapse;
                  width: 75%;
                  margin: auto; /* Center the table */
              }

              th, td {
                  border: 1px solid #ddd;
                  padding: 8px;
                  text-align: center;
              }

              th {
                  background-color: #F28705;
                  color: #fff;
              }

              * {
                  margin: 0;
                  padding: 0;
              }

              body {
                  font-family: Arial, sans-serif;
                  font-size: 15px;
              }

              .print-header {
                  text-align: left;
              }

              .header img {
                  width: 100px;
                  height: 100px;
              }

              .header-text {
                  display: inline-block;
                  vertical-align: top;
                  margin-left: 10px; /* Adjust the margin as needed */
              }

              .print-table {
                  margin: 60px auto;
                  width: 85%;
              }

              .par::before {
                  content: '';
                  position: fixed;
                  top: 100px;
                  height: 4px;
                  width: 90%;
                  background-color: #F28705;
                  z-index: -1;
              }

              /* Additional styles for table */
              tr:nth-child(even) {
                  background-color: #f2f2f2;
              }

              tr:hover {
                  background-color: #ddd;
              }

              /* Adjust the top margin of h2 to make it smaller and move it down */
              h2 {
                  margin-top: 30px;
                  margin-bottom: 20px;
                  font-size: 18px; /* Adjust the font size as needed */
                  text-align: center; /* Center the h2 element */
              }
          </style>
      `);

      printWindow.document.write('</head><body>');

      // Add the header content
      printWindow.document.write(`
          <div class="print-header">
              <div class="header">
                  <img src="../assets/img/logo1.png" alt="logo">
                  <div class="header-text">
                      <h1>Smart Achievers Academy Subic, Inc.</h1>
                      <p>Block 4 Lots 3 & 4 St. James Subdivision, Calapacuan Subic Zambales, Philippines</p>
                      <p class="par">Mobile No.: 09985501994/09303666559/09178348413 | Tel No. (047) 232-8224</p>
                  </div>
              </div>
          </div>
      `);

      // Add the table content with specific columns
      printWindow.document.write('<h2>Section Reports</h2>');
      printWindow.document.write('<table>');

      // Include only the desired columns
      printWindow.document.write(`
          <thead>
              <tr>
              <th scope="col">Section Number</th>
              <th scope="col">Section Name</th>
              </tr>
          </thead>
      `);

      // Include data rows using DataTables API
      var dataTable = $('#dataTable').DataTable();
      var data = dataTable.rows().data().toArray();
      printWindow.document.write('<tbody>');
      for (var i = 0; i < data.length; i++) {
          printWindow.document.write('<tr>');
          for (var j = 1; j < data[i].length - 1; j++) { // Exclude the first and last columns
              printWindow.document.write('<td>' + data[i][j] + '</td>');
          }
          printWindow.document.write('</tr>');
      }
      printWindow.document.write('</tbody>');

      printWindow.document.write('</table>');
      printWindow.document.write('</body></html>');
      printWindow.document.close();
      printWindow.print();
  }

    </script>
 

        
</body>

</html>
