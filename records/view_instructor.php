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
        <title>Instructor - View Records</title>

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
                            <a class="collapse-item active" href="view_instructor.php">Instructor</a>
                            <a class="collapse-item" href="view_section.php">Class Section</a>
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

                        <div class="d-sm-flex align-items-center justify-content-end mb-4">
                            <div id="actions"> 
                                <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="checkAll" >
                                    <label class="form-check-label" for="checkAll">Check All</label>
                                    </div>
                                        <a href="#" class="mx-2" id="editAll">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="#" class="btn-delete" id="deleteAll">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                        <a href="#" class="btn-archive" id="archiveAll">
                                            <i class="fa fa-archive"></i> Archive
                                        </a>
                                    </div>
                                <div> -->
                                
                                <!-- Print Button -->
                                <button onclick="printTable()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                     <i class="fas fa-print fa-sm text-white-50"></i> Print
                                 </button>
                                <!-- <a href="instructor.php" target="_blank">
                                   <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                       <i class="fas fa-print fa-sm text-white-50"></i> Print All
                                   </button>
                               </a> -->
                            

                            </div>
                        </div>

                        <br>

                        <div class="col-md-6">
                            <label for="department">Department</label>
                            <select class="form-control" id="department" name="Department" required>
                                <option value="" disabled selected>Select Department</option>
                                <option value="Primary">Primary</option>
                                <option value="JuniorHighSchool">Junior High School</option>
                                <option value="SeniorHighSchool">Senior High School</option>
                                 
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
                                                     
                                                    <th scope="col">Full Name</th>
                                                     
                                                     
                                                    <th scope="col">Specialization Name</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                    <th scope="col">Modify</th>

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
                    var selectedInstructorIDs = [];

                    // Loop through each checked checkbox to get the SubjectID
                    $('.checkSingle:checked').each(function () {
                        selectedInstructorIDs.push($(this).data('id'));
                    });

                    // Redirect to the edit page with selected SubjectID values
                    if (selectedInstructorIDs.length > 0) {
                        var editURL = 'EditData/edit_instructor.php?subid=' + selectedInstructorIDs.join(',');
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
                    var selectedInstructorIDs = [];

                    // Loop through each checked checkbox to get the SubjectID
                    $('.checkSingle:checked').each(function () {
                        selectedInstructorIDs.push($(this).data('id'));
                    });

                    // Redirect to the edit page with selected SubjectID values
                    if (selectedInstructorIDs.length > 0) {
                        var editURL = 'DeleteData/delete_instructor.php?delid=' + selectedInstructorIDs.join(',');
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
                    url: 'DataGet/get_instructor.php', // Adjust the URL to your server-side script
                    method: 'POST',
                    data: { departmentID: departmentID },
                    success: function (data) {
                        // Update the table content with the fetched data
                        $('tbody').html(data);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

    <script>
        // Function to handle 'Archive' click event
        $('#archiveAll').click(function (e) {
            e.preventDefault();

            // Retrieve selected Instructor IDs
            var selectedInstructorIDs = [];
            $('.checkSingle:checked').each(function () {
                selectedInstructorIDs.push($(this).data('id'));
            });

            if (selectedInstructorIDs.length === 0) {
                // No checkboxes selected, display a warning
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'No rows selected. Please select at least one row to archive.'
                });
            } else {
                // Show confirmation dialogue for archiving
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to archive all instructors?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send selected Instructor IDs to archive function
                        archiveInstructors(selectedInstructorIDs);
                    }
                });
            }
        });


        // Function to archive selected instructors
        function archiveInstructors(instructorIDs) {
            // AJAX call to send IDs to PHP script
            $.ajax({
                url: 'Archive/archive_istructor.php',
                type: 'POST',
                data: { instructorIDs: instructorIDs },
                success: function (response) {
                    if (response === 'success') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Instructors archived successfully',
                            icon: 'success'
                        }).then(() => {
                            // Reload the page after the success message is closed
                            location.reload();
                        });
                    } else {
                        // Handle errors (e.g., show error message)
                        Swal.fire('Error', 'Failed to archive instructors', 'error');
                    }
                },
                error: function () {
                    // Handle AJAX errors
                    Swal.fire('Error', 'Something went wrong', 'error');
                }
            });
        }

    </script>



<!-- Print -->
<script>
    function printTable() {
      var printWindow = window.open('', '_blank');
      printWindow.document.write('<html><head><title>Instructors</title>');

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
      printWindow.document.write('<h2>Instructor Reports</h2>');
      printWindow.document.write('<table>');

      // Include only the desired columns
      printWindow.document.write(`
          <thead>
              <tr>
              <th scope="col">Full Name</th>
              <th scope="col">Gender</th>
              <th scope="col">Age</th>
              <th scope="col">Birthday</th>
              <th scope="col">Address</th>
              <th scope="col">Contact Number</th>
              <th scope="col">Email</th>
              <th scope="col">Specialization</th>
              <th scope="col">Status</th>
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


<!-- Export -->
<script>
    function exportToExcel() {
            // Get the selected department from the dropdown
            var selectedDepartment = document.getElementById('department').value;

            // Map department values to corresponding titles
            var departmentTitles = {
                'senior_high_school': 'Senior High School',
                'junior_high_school': 'Junior High School',
                'primary': 'Primary'
            };

            // Create a title based on the selected department
            var title = departmentTitles[selectedDepartment] || 'Instructor';

            // Select the table
            var table = document.getElementById('dataTable');

            // Remove the "Action" column from the table
            var columnIndexToRemove = 10; // Index of the "Action" column (zero-based)
            for (var i = 0; i < table.rows.length; i++) {
                table.rows[i].deleteCell(columnIndexToRemove);
            }

            // Clean up the "Birthday" column (assuming it's in the fourth position, index 3)
            for (var i = 0; i < table.rows.length; i++) {
                var birthdayCell = table.rows[i].cells[3]; // Assuming "Birthday" is in the fourth position
                birthdayCell.textContent = birthdayCell.textContent.replace(/[^0-9]/g, ''); // Keep only numeric characters
            }

            // Convert the modified table to a worksheet
            var ws = XLSX.utils.table_to_sheet(table);

            // Create a workbook with a single sheet
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, title);

            // Save the workbook as an Excel file
            XLSX.writeFile(wb, title.toLowerCase().replace(/\s/g, '_') + '_data.xlsx');
        }
</script>
</body>

</html>