<?php
require('../../config/db_connection.php');

if (isset($_POST['instructor'])) {
    $instructor = $_POST['instructor'];

    $sql = "SELECT 
                sub.SubjectName, 
                d.GradeLevel, 
                css.SectionName,
                cs.Time_Start, 
                cs.Time_End,
                r.RoomNumber,
                cs.is_Monday, 
                cs.is_Tuesday, 
                cs.is_Wednesday, 
                cs.is_Thursday, 
                cs.is_Friday
            FROM classschedules cs
            INNER JOIN departments d ON cs.DepartmentID = d.DepartmentID
            INNER JOIN subjects sub ON cs.SubjectID = sub.SubjectID
            INNER JOIN instructors i ON cs.InstructorID = i.InstructorID
            INNER JOIN classsections css ON cs.SectionID = css.SectionID 
            INNER JOIN rooms r ON cs.RoomID = r.RoomID
            WHERE i.InstructorID = ?
            AND cs.Active = 2 ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $instructor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch all rows at once
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Sort rows by time start (AM before PM)
        usort($rows, function($a, $b) {
            return strtotime($a['Time_Start']) - strtotime($b['Time_Start']);
        });

        // Start capturing the output in a variable
        ob_start();

        // Begin capturing the content within the table-responsive div
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
        echo "<tbody id='strandTable'>";

        foreach ($rows as $row) {
            // Outputting table rows with fetched data
            echo "<tr>";
            echo "<td>{$row['SubjectName']}</td>";
           
            // Format time start and end
            $timeStart = date("h:i A", strtotime($row['Time_Start']));
            $timeEnd = date("h:i A", strtotime($row['Time_End']));
            echo "<td>$timeStart - $timeEnd</td>";
          
            // Combine day abbreviations
            $days = '';
            $days .= $row['is_Monday'] ? 'M ' : '';
            $days .= $row['is_Tuesday'] ? 'T ' : '';
            $days .= $row['is_Wednesday'] ? 'W ' : '';
            $days .= $row['is_Thursday'] ? 'TH ' : '';
            $days .= $row['is_Friday'] ? 'F ' : '';
            echo "<td>$days</td>";
            
            echo "<td>Grade {$row['GradeLevel']} - {$row['SectionName']}</td>";
            echo "<td>{$row['RoomNumber']}</td>";
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

    $stmt->close();
} else {
    // Invalid request
    echo "Invalid request";
}
?>
