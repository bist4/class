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
        <title>View Schedule Primary</title>

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
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseView"
                        aria-expanded="true" aria-controls="collapseView">
                        <i class="fas fa-fw fa-eye"></i>
                        <span>View Schedule</span>
                    </a>
                    <div id="collapseView" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="view_senior_high_school.php">Senior High School</a>
                            <a class="collapse-item" href="view_junior_high_school.php">Junior High School</a>
                            <a class="collapse-item active" href="view_primary.php">Primary</a>
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

                        <!-- Topbar Search -->
                        <!-- <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form> -->

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
                            <div class="col-lg-12 col-md-12 mb-3">
                                <h1 class="mb-4" style="font-size: 25px;">View Primary Schedule</h1> 

                                 <!-- Print Button -->
                    <button onclick="printTable()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-print fa-sm text-white-50"></i> Print
                    </button>


                   <!-- Print All Button -->
                    <button onclick="printAll()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-print fa-sm text-white-50"></i> Print All
                      </button>

                   <!-- Excel Button -->
                   <button onclick="exportToExcel()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                       <i class="fas fa-file-excel fa-sm text-white-50"></i> Export to Excel
                   </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 mb-3">
                                <label for="yearLevel" class="form-label">Year Level:</label>
                                <select id="yearLevel" class="form-control w-100" required>
                                    <option value="" disabled selected>Select Year Level</option>
                                    <?php
                                        require('../config/db_connection.php');
                                        $view = "SELECT DISTINCT YearLevel, DepartmentID FROM department WHERE DepartmentTypeNameID = 3 ORDER BY YearLevel ASC";
                                        $result = $conn->query($view);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="'. $row["DepartmentID"] . '">' . $row["YearLevel"] .'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 mb-3">
                                <label for="section" class="form-label">Section:</label>
                                <select id="section" class="form-control w-100" required>
                                    <option value="" disabled selected>Select Section</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 mb-3">
                                <label for="filterDay" class="form-label">Day:</label>
                                <select id="filterDay" class="form-control w-100" required>
                                    <option value="" disabled selected>Select Day</option>
                                </select>
                            </div>
                        </div>
                    </div>





                    
                        <!-- Add Subject Button (Visible only on screens below 574px) -->
                        <div class="d-sm-none d-md-none d-lg-none d-xl-none">
                            <div class="card-header py-3 d-flex justify-content-end">
                                <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addSubject">
                                <span class="icon text-white-50"><i class="fas fa-plus" data-toggle="tooltip" data-placement="top" title="Add Subject"></i></span>
                                </a>
                            </div>
                        </div>

                        <!-- Print Button (Visible only on screens below 574px) -->
                        <div class="d-sm-none d-md-none d-lg-none d-xl-none">
                            <div class="card-header py-3 d-flex justify-content-end">
                                <button class="btn btn-success btn-icon-split" id="printButton">
                                <span class="icon text-white-50"><i class="fas fa-print" data-toggle="tooltip" data-placement="top" title="Print"></i></span>
                                </button>
                            </div>
                        </div>

                        <!-- Excel Button (Visible only on screens below 574px) -->
                        <div class="d-sm-none d-md-none d-lg-none d-xl-none">
                            <div class="card-header py-3 d-flex justify-content-end">
                                <button class="btn btn-info btn-icon-split" id="excelButton">
                                <span class="icon text-white-50"><i class="fas fa-file-excel" data-toggle="tooltip" data-placement="top" title="Export to Excel"></i></span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex justify-content-end">

                            </div>



                        <!-- TABLES -->
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
                // SECTION DROPDWON
                $.ajax({
                    url: 'View/primary_get_year_level.php', // Replace with the actual PHP script URL
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
                // SECTION DROPDWON
                $.ajax({
                    url: 'View/primary_get_year_level_section.php',
                    type: 'POST',
                    data: { yearLevel: yearLevel },
                    success: function (data) {
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
                var section = $(this).val(); // Corrected the variable name
                var yearLevel = $('#yearLevel').val(); // Corrected the variable name
                
                $.ajax({
                    url: 'View/primary_get_section.php',
                    type: 'POST',
                    data: { section: section, yearLevel: yearLevel },
                    success: function (data) {
                        $('tbody').html(data);
                    },
                    error: function () {
                        alert('Error fetching data');
                    }
                });

                $.ajax({
                    url: 'FilterDay/primary_filter_day.php',
                    type: 'POST',
                    data: { section: section, yearLevel: yearLevel },
                    success: function (data) {
                        $('#filterDay').html(data);
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
            $('#filterDay').change(function () {
                var filterDay = $(this).val(); // Corrected the variable name
                var yearLevel = $('#yearLevel').val(); // Corrected the variable name
                var section = $('#section').val(); // Corrected the variable name

                $.ajax({
                    url: 'FilterDay/primary_filter_day_table.php',
                    type: 'POST',
                    data: { filterDay: filterDay, section: section, yearLevel: yearLevel },
                    success: function (data) {
                        $('table').html(data);
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


<!-- For print and export to excel -->
<script>
    // Function to print only the table with specific styles
    function printTable() {
        // Clone the table element
        var printableTable = $("#dataTable").clone();

        // Create a new window for the print-friendly page
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        // Add the header content
            printWindow.document.write('</head><body>');
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
        .print-table table {
            width: 100%;
        }

        .print-table th,
        .print-table td {
            padding: 8px;
            text-align: left;
        }

        .print-table th {
            background-color: #F28705;
            color: #fff;
        }

        .print-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .print-table tr:hover {
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

        // Append the cloned table to the new window's body
        printableTable.find('.d-none').remove(); // Remove hidden elements
        printWindow.document.write('<div class="print-table">');
        printWindow.document.write(printableTable.prop('outerHTML'));
        printWindow.document.write('</div>');

        // Close the HTML document
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Focus and print the new window
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }

    function exportToExcel() {
      // Get the DataTable instance
      var dataTable = $('#dataTable').DataTable();

      // Remove the "Action" column from the DataTable
      dataTable.column(4).visible(false);

      // Convert the DataTable to a worksheet
      var ws = XLSX.utils.table_to_sheet($('#dataTable')[0]);

      // Create a workbook with a single sheet
      var wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, 'Primary_School_Data');

      // Save the workbook as an Excel file
      XLSX.writeFile(wb, 'Primary_School_Data.xlsx');

      // Restore the visibility of the "Action" column in the DataTable
      dataTable.column(4).visible(true);
    }




    function printAll() {
        // Clone the content of the container with the table
        var printableContent = $("#dataTable").clone();
        // Create a new window for the print-friendly page
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        // Add the header content
            printWindow.document.write('</head><body>');
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
        .print-table table {
            width: 100%;
        }

        .print-table th,
        .print-table td {
            padding: 8px;
            text-align: left;
        }

        .print-table th {
            background-color: #F28705;
            color: #fff;
        }

        .print-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .print-table tr:hover {
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

        // Append the cloned content to the new window's body
        printWindow.document.write(printableContent.prop('outerHTML'));

        // Close the HTML document
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Focus and print the new window
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }

    // Add event listeners for Print, Print All, and Excel buttons
    $(document).ready(function () {
        $("#printButton").click(function () {
            printTable();
        });

        $("#excelButton").click(function () {
            exportToExcel();
        });

        $("#printAllButton").click(function () {
            printAll();
        });
    });
</script>

</body>

</html>