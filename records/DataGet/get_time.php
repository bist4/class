<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../assets/js/demo/datatables-demo.js"></script>


<?php
require "../../config/db_connection.php";

if (isset($_POST['instructorID'])) {
    $instructorID = $_POST['instructorID'];

    $sql = "SELECT InstructorTimeAvailabilitiesID, is_Monday, is_Tuesday, is_Wednesday, is_Thursday, is_Friday, Time_Start, Time_End, InstructorID FROM instructortimeavailabilities WHERE InstructorID = ? AND Active = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $instructorID);
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
            <th scope='col'>Days</th>
            <th scope='col'>Time</th>
 
            <th scope='col'>Action</th>
              </tr></thead>";
        echo "<tbody id='timeTable'>";

        

        $mergedRows = [];

while ($row = $result->fetch_assoc()) {
    $key = $row['Time_Start'] . $row['Time_End']; // Ipinabago ko ito mula sa orihinal na $row['Days'] . $row['Time_Start'] . $row['Time_End'];

    if (!isset($mergedRows[$key])) {
        $mergedRows[$key] = [];
    }

    $mergedRows[$key][] = $row;
}

$count = 1;
foreach ($mergedRows as $mergedRow) {
    // Convert time from 24-hour format to 12-hour format for the first row
    $startTime = date("g:ia", strtotime($mergedRow[0]['Time_Start']));
    $endTime = date("g:ia", strtotime($mergedRow[0]['Time_End']));

    $days = [];
    foreach ($mergedRow as $row) {
        // Check each day column and include it if its value is 1
        foreach (['is_Monday', 'is_Tuesday', 'is_Wednesday', 'is_Thursday', 'is_Friday'] as $day) {
            if ($row[$day] == 1) {
                $days[] = substr($day, 3);
            }
        }
    }
    $uniqueDays = implode(", ", array_unique($days));

    echo "<tr>";
    echo "<td rowspan='" . count($mergedRow) . "'><div class='form-check form-check-inline'>
        <input class='form-check-input checkSingle' type='checkbox' name='selectedSection[]' id='check_" . $mergedRow[0]['InstructorTimeAvailabilitiesID'] . "' data-id='" . $mergedRow[0]['InstructorTimeAvailabilitiesID'] . "' value='" . $mergedRow[0]['InstructorTimeAvailabilitiesID'] . "'>
    </div></td>";
    echo "<td rowspan='" . count($mergedRow) . "'>" . $uniqueDays . "</td>";
    echo "<td rowspan='" . count($mergedRow) . "'>" . $startTime . " - " . $endTime . "</td>";

    foreach ($mergedRow as $key => $row) {
        if ($key !== 0) {
            echo "<tr>";
        }

        echo "<td>";
        echo "<div class='d-flex justify-content-center'>";
        echo "<a href='EditData/edit_time.php?subid=" . $row['InstructorTimeAvailabilitiesID'] . "'>
            <button class='btn btn-primary mr-3' title='Edit Availability'><i class='fa fa-edit'></i></button>
        </a>";
        echo "<a href='DeleteData/delete_time.php?delid=" . $row['InstructorTimeAvailabilitiesID'] . "'>
            <button class='btn btn-danger' title='Delete Availability'><i class='fa fa-trash'></i></button>
        </a>";
        echo "</div>";
        echo "</td>";

        if ($key !== 0) {
            echo "</tr>";
        }
    }
    echo "</tr>";
    $count++;
}


        


        // Your code for handling no data found...


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
