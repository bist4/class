<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../assets/js/demo/datatables-demo.js"></script>



<?php
require "../../config/db_connection.php";

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    $sql = "SELECT InstructorID, CONCAT(Fname, ' ', Mname, ' ', Lname) AS FullName, Gender, Age, Birthday, Address, ContactNumber, Email, Specialization, Status, DepartmentID FROM instructor WHERE DepartmentID = ? AND Active = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $departmentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $count = 1;

        // Start capturing the output in a variable
        ob_start();

        // Begin capturing the content within the table-responsive div
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
        echo "<thead><tr>
                <th scope='col'>#</th>
                <th scope='col'>Full Name</th>
                <th scope='col'>Gender</th>
                <th scope='col'>Age</th>
                <th scope='col'>Birthday</th>
                <th scope='col'>Address</th>
                <th scope='col'>Contact Number</th>
                <th scope='col'>Email</th>
                <th scope='col'>Specialization</th>
                <th scope='col'>Status</th>
                <th scope='col'>Action</th>
              </tr></thead>";
        echo "<tbody id='strandTable'>";

        while ($row = $result->fetch_assoc()) {
            // Outputting table rows with fetched data
            echo "<tr>";
            echo "<td>
                    <div class='form-check form-check-inline'>
                        <input class='form-check-input checkSingle' type='checkbox' name='selectedSection[]' id='check_" . $row['InstructorID'] . "' data-id='" . $row['InstructorID'] . "' value='" . $row['InstructorID'] . "'>
                    </div>
                </td>";

            echo "<td>" . $row['FullName'] . "</td>";
            echo "<td>" . $row['Gender'] . "</td>";
            echo "<td>" . $row['Age'] . "</td>";
            echo "<td>" . $row['Birthday'] . "</td>";
            echo "<td>" . $row['Address'] . "</td>";
            echo "<td>" . $row['ContactNumber'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "<td>" . $row['Specialization'] . "</td>";
            echo "<td>" . $row['Status'] . "</td>";
            echo "<td>";
            echo  "<div class='d-flex justify-content-center'>";
            echo "<a href='EditData/edit_instructor.php?subid=" . $row['InstructorID'] . "'>
                    <button class='btn btn-primary mr-3' title='Edit Instructor'>
                        <i class='fa fa-edit'></i>
                    </button>
                </a>";
            echo "<a href='DeleteData/delete_instructor.php?delid=" . $row['InstructorID'] . "'>
                    <button class='btn btn-danger mr-3' title='Delete Instructor'>
                        <i class='fa fa-trash'></i>
                    </button>
                </a>"; 
            echo "<br>";
            echo "<a>
                    <button class='btn btn-success mr-3' onclick='confirmArchive(" . $row['InstructorID'] . ")' title='Archive Instructor'>
                        <i class='fa fa-archive'></i>
                    </button>
                </a>";

           
            echo    "</div>";
            echo   "</td>"; // You can add actions for each row here
            echo "</tr>";

            $count++;
        }

        echo "</tbody></table></div>";

        // End capturing the content within the table-responsive div
        $tableContent = ob_get_clean();

        // Send the captured HTML content as a response
        echo $tableContent;
    } else {
        // If no data is found in the table
        echo "<div class='table-responsive'><table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'><tbody>";
        echo "<tr><td colspan='11'>No data available</td></tr>";
        echo "</tbody></table></div>";
    }

    $stmt->close();
} else {
    // Invalid request
    echo "Invalid request";
}
?>


<script>
    function confirmArchive(instructorID) {
        console.log('Instructor ID:', instructorID);
        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure you want to archive?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                archive(instructorID); // Call the function to archive the instructor with the given ID
            }
        });
    }

    function archive(instructorID) {
        // You can use AJAX to send a request to the server to perform the archive action
        // Example AJAX call to a PHP file that handles the archive process
        $.ajax({
            url: 'Archive/archive_istructor.php',
            method: 'POST',
            data: { instructorID: instructorID },
            
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Archived Instructor',
                    text: 'The account has been successfully archived!'
                }).then(function() {
                    location.reload(); // Reload the page after locking
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to archive instructor. Please try again.'
                });
                console.error(error);
            }
        });
    }
</script>
