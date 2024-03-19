<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../assets/js/demo/datatables-demo.js"></script>


<?php
require "../../config/db_connection.php";

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    $sql = "SELECT SubjectID, SubjectCode, SubjectName, Classification, Type, MinutesPerWeek, DepartmentID FROM subjects WHERE DepartmentID = ? AND Active = 1";
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
                <th scope='col'>Subject Code</th>
                <th scope='col'>Subject Name</th>
                 
                <th scope='col'>Type</th>

                <th scope='col'>MinutesPerWeek</th>
                <th scope='col'>Action</th>
              </tr></thead>";
        echo "<tbody id='strandTable'>";

        while ($row = $result->fetch_assoc()) {
            // Outputting table rows with fetched data
            echo "<tr>";
            echo "<td>
                    <div class='form-check form-check-inline'>
                        <input class='form-check-input checkSingle' type='checkbox' name='selectedSection[]' id='check_" . $row['SubjectID'] . "' data-id='" . $row['SubjectID'] . "' value='" . $row['SubjectID'] . "'>
                    </div>
                </td>";

            echo "<td>" . $row['SubjectCode'] . "</td>";
            echo "<td>" . $row['SubjectName'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>";

            echo "<td>" . $row['MinutesPerWeek'] . "</td>";
            echo "<td>";
            echo  "<div class='d-flex justify-content-center'>";
            echo "<a href='EditData/edit_subject.php?subid=" . $row['SubjectID'] . "'>
                    <button class='btn btn-primary mr-3' title='Edit Strand'>
                        <i class='fa fa-edit'></i>
                    </button>
                </a>";
            echo "<a href='DeleteData/delete_subject.php?delid=" . $row['SubjectID'] . "'>
                    <button class='btn btn-danger' title='Delete Strand'>
                        <i class='fa fa-trash'></i>
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
        echo "<tr><td colspan='5'>No data available</td></tr>";
        echo "</tbody></table></div>";
    }

    $stmt->close();
} else {
    // Invalid request
    echo "Invalid request";
}
?>
