<?php
require('../config/db_connection.php');

if (isset($_POST['instructor'])) {
    $instructor = $_POST['instructor'];

    $sql = "SELECT d.GradeLevel, s.SectionName, cs.SectionID 
    FROM classschedules cs 
    INNER JOIN departments d ON cs.DepartmentID = d.DepartmentID 
    INNER JOIN classsections s ON cs.SectionID = s.SectionID 
    INNER JOIN instructors i On cs.InstructorID = i.InstructorID 
    WHERE i.InstructorID = ? AND cs.Active = 1
    GROUP BY d.DepartmentID, s.SectionID";
        
    // Prepare statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die('Error in preparing statement: ' . $conn->error);
    }
    
    // Bind parameters
    $bindResult = $stmt->bind_param('i', $instructor);
    if (!$bindResult) {
        die('Error in binding parameters: ' . $stmt->error);
    }

    // Execute statement
    $executeResult = $stmt->execute();
    if (!$executeResult) {
        die('Error in executing statement: ' . $stmt->error);
    }

    // Get result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Start capturing the output in a variable
        ob_start();

        // Begin capturing the content within the table-responsive div
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
        echo "<thead id='head'>
        <tr>
            <th></th>
            <th scope='col'>Year Level</th>
            <th scope='col'>Section</th>
        </tr>
    </thead>";
        echo "<tbody id='strandTable'>";

        while ($row = $result->fetch_assoc()) {
            // Outputting table rows with fetched data
            echo "<tr>";
            echo "<td><input type='checkbox'  class='checkSingle' name='selectedSchedule[]' id='check_" . $row['SectionID'] . "' data-id='" . $row['SectionID'] . "' value='" . $row['SectionID'] . "'></td>";
            echo "<td>Grade ".$row['GradeLevel']."</td>";
            echo "<td>" . $row['SectionName'] . "</td>";
            echo "</tr>";
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

    // Close statement
    $stmt->close();
} else {
    // Invalid request
    echo "Invalid request";
}
?>
