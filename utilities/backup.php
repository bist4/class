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
    
    <title>Back Up - Utilities</title>

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
                <li class="nav-item active">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Utilities</span>
                    </a>
                    <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            
                            <a class="collapse-item" href="accounts.php">Account Management</a>
                            <a class="collapse-item" href="archive.php">Archive</a>
                            <a class="collapse-item active" href="backup.php">Backup</a>
                            <a class="collapse-item" href="logs.php">Activity History</a>
                            <a class="collapse-item" href="trash.php">Trash</a>

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
                        <h1 class="h3 mb-2 text-gray-800">Backup</h1>
                        
                    </div>
                
                    

                

                    <!-- Switch Button -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <!-- Switch Button -->
                            <div class="row justify-content-end">
                                <div class="col-md-6 col-lg-4 offset-md-6 offset-lg-8">
                                    <div class="custom-control custom-switch text-right">
                                        <input type="checkbox" class="custom-control-input" id="backupSwitch" onchange="toggleLabelAndBackup()">
                                        <label class="custom-control-label" for="backupSwitch">Manual Backup Database</label>
                                    </div>
                                </div>
                            </div>



                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="folder-icon d-flex flex-column align-items-center text-center">
                                            <span>
                                                <i class="fas fa-cloud-download-alt fa-10x"></i>
                                            </span>
                                            <p class="mt-2">
                                            <a href="database/restore.php?action=restore&file=Backupdatabase/ClassScheduling_backup_TIMESTAMP.sql" target="_blank" download>Restore Database</a>

                                                <br>
                                                <span id="restoreCountdown"></span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="folder-icon d-flex flex-column align-items-center text-center">
                                            <span>
                                                <i class="fas fa-cloud-upload-alt fa-10x"></i>
                                            </span>
                                            <p class="mt-2">
                                            <a href="database/backup.php?action=backup" download>Backup Database</a>
                                                <br>
                                                <span id="backupCountdown"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <!-- End of Main Content -->

           <!-- Footer -->
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

    <!-- loading -->
    <script>
        // Function to show the loading spinner and hide the Save button
        function showLoadingSpinner() {
            $("#saveButton").prop("disabled", true);
            $("#saveButton .spinner-border").removeClass("d-none");
        }

        // Function to hide the loading spinner and show the Save button
        function hideLoadingSpinner() {
            $("#saveButton").prop("disabled", false);
            $("#saveButton .spinner-border").addClass("d-none");
        }

        // Handle form submission
        $("#addStrandForm").submit(function (event) {
            // Prevent the form from submitting immediately
            event.preventDefault();

            // Show the loading spinner
            showLoadingSpinner();

            // Submit the form after a short delay to simulate loading
            setTimeout(function () {
                this.submit();
            }.bind(this), 2000); // Adjust the delay as needed

            // If you want to submit the form without the delay, remove the setTimeout function and simply use this.submit();
        });
    </script>


     
     
     

    <!-- delete modal -->
    <script>
         $(document).ready(function () {
            let deleteLogid;

            // Trigger delete modal when delete button is clicked
            $(".btn-delete").click(function () {
                deleteLogid = $(this).data("log-id");
                $("#deletelogModal").modal("show");
            });

            // Handle delete confirmation
            $("#confirmDeleteButton").click(function () {
                deleteLog(deleteLogid);
            });

            // Function to delete the log
            function deleteLog(logId) {
                $.ajax({
                    url: "DataDelete/delete_log.php",
                    method: "POST",
                    data: { LogID: logId }, // Pass the log ID to delete
                    success: function (data) {
                        // Handle the success response here, e.g., show a success message
                        console.log(data); // You can log the response to the console
                        // Add code to refresh the table or update the UI as needed
                        $("#deletelogModal").modal("hide"); // Close the modal
                    },
                    error: function () {
                        // Handle the error response here, e.g., show an error message
                        console.error("Error deleting log.");
                    },
                });
            }
        });

    </script> 



    <!-- Print and Import to Excel -->
    <script src="../assets/js/DataPrintExcel/print_subject.js"></script>
   
    <script src="../assets/js/capitalLetter.js"></script>
    <script src="../assets/js/switch.js"></script>
 
   
    <script>
    let backupInterval;
    let countdownInterval;
    let countdownDuration = calculateTimeUntilNextMonday();

    // Set the default mode based on sessionStorage
    document.addEventListener('DOMContentLoaded', function () {
        const backupSwitch = document.getElementById('backupSwitch');
        const label = document.querySelector('label[for="backupSwitch"]');
        const restoreCountdown = document.getElementById('restoreCountdown');
        const backupCountdown = document.getElementById('backupCountdown');

        const isAutomaticMode = sessionStorage.getItem('automaticBackup') === 'true';

        backupSwitch.checked = isAutomaticMode;
        label.innerText = isAutomaticMode ? 'Automatic Backup Database' : 'Manual Backup Database';

        if (isAutomaticMode) {
            startCountdown(restoreCountdown, backupCountdown);

            backupInterval = setInterval(function () {
                automaticBackup();
                startCountdown(restoreCountdown, backupCountdown);
            }, countdownDuration);
        }
    });

    function toggleLabelAndBackup() {
        const backupSwitch = document.getElementById('backupSwitch');
        const label = document.querySelector('label[for="backupSwitch"]');
        const restoreCountdown = document.getElementById('restoreCountdown');
        const backupCountdown = document.getElementById('backupCountdown');

        if (backupSwitch.checked) {
            const confirmation = confirm('Do you want to switch to Automatic Backup?');

            if (confirmation) {
                // If confirmed, switch to automatic mode
                label.innerText = 'Automatic Backup Database';
                sessionStorage.setItem('automaticBackup', 'true');

                startCountdown(restoreCountdown, backupCountdown);
                backupInterval = setInterval(function () {
                    automaticBackup();
                    startCountdown(restoreCountdown, backupCountdown);
                }, countdownDuration);
            } else {
                // If not confirmed, stay in manual mode
                backupSwitch.checked = false;
                label.innerText = 'Manual Backup Database';
                sessionStorage.setItem('automaticBackup', 'false');

                clearInterval(backupInterval);
                clearInterval(countdownInterval);
            }
        } else {
            const confirmation = confirm('Do you want to switch back to Manual Backup?');

            if (confirmation) {
                // If confirmed, switch to manual mode
                label.innerText = 'Manual Backup Database';
                sessionStorage.setItem('automaticBackup', 'false');

                clearInterval(backupInterval);
                clearInterval(countdownInterval);
            } else {
                // If not confirmed, stay in automatic mode
                backupSwitch.checked = true;
                label.innerText = 'Automatic Backup Database';
                sessionStorage.setItem('automaticBackup', 'true');

                startCountdown(restoreCountdown, backupCountdown);
                backupInterval = setInterval(function () {
                    automaticBackup();
                    startCountdown(restoreCountdown, backupCountdown);
                }, countdownDuration);
            }
        }
    }

    function checkOrCreateFolder(folderPath) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'database/create_folder.php?folder=' + folderPath, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(xhr.responseText);
        } else {
            console.error('Error creating folder.');
        }
    };

    xhr.send();
}

    function automaticBackup() {
    // Make an AJAX request to trigger the automatic backup
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'database/backup.php?auto=true', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            // Create a blob with the backup data
            const blob = new Blob([response.sqlScript], { type: 'application/octet-stream' });

            // Specify the folder path for automatic backups
            const folderPath = 'AutoBackupsuccessful/';
            
            // Create a link element and set its attributes
            const downloadLink = document.createElement('a');
            downloadLink.href = URL.createObjectURL(blob);
            downloadLink.download = folderPath + response.filename;

            // Append the link to the document and trigger the download
            document.body.appendChild(downloadLink);
            downloadLink.click();

            // Clean up by removing the link
            document.body.removeChild(downloadLink);
            
            console.log('Automatic backup completed successfully.');
        } else {
            console.error('Error during automatic backup.');
        }
    };

    xhr.send();
}



function startCountdown(restoreCountdown, backupCountdown) {
    let remainingTime = countdownDuration;

    function updateCountdown() {
        const now = new Date();
        const currentDay = now.getDay(); // 0 is Sunday, 1 is Monday, ..., 6 is Saturday
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();

        if (currentDay === 1 && hours === 0 && minutes === 0 && seconds === 0) {
            // It's Monday and midnight, trigger automatic backup
            automaticBackup();
        }

        const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
        const hoursRemaining = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutesRemaining = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
        const secondsRemaining = Math.floor((remainingTime % (1000 * 60)) / 1000);

        restoreCountdown.innerText = `Next Restore in ${days} days, ${hoursRemaining} hours, ${minutesRemaining} minutes, ${secondsRemaining} seconds`;
        backupCountdown.innerText = `Next Backup in ${days} days, ${hoursRemaining} hours, ${minutesRemaining} minutes, ${secondsRemaining} seconds`;

        remainingTime -= 1000;

        if (remainingTime < 0) {
            clearInterval(countdownInterval);
            countdownDuration = calculateTimeUntilNextMonday();
            startCountdown(restoreCountdown, backupCountdown); // Restart the countdown
        }
    }

    updateCountdown(); // Call once to avoid initial delay

    countdownInterval = setInterval(updateCountdown, 1000);
}


    function calculateTimeUntilNextMonday() {
        const now = new Date();
        const currentDay = now.getDay(); // 0 is Sunday, 1 is Monday, ..., 6 is Saturday
        const daysUntilMonday = currentDay === 1 ? 7 : (8 - currentDay) % 7; // Calculate days until next Monday

        const nextMonday = new Date(now);
        nextMonday.setDate(now.getDate() + daysUntilMonday);
        nextMonday.setHours(0, 0, 0, 0);

        const timeUntilNextMonday = nextMonday.getTime() - now.getTime();
        return timeUntilNextMonday;
    }

    // Run the countdown reset check every hour (adjust as needed)
    setInterval(function () {
        countdownDuration = calculateTimeUntilNextMonday();
        startCountdown(document.getElementById('restoreCountdown'), document.getElementById('backupCountdown'));
    }, 60 * 60 * 1000);
</script>




 


</body>

</html>
