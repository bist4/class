<?php
require('../../config/db_connection.php');

if (isset($_POST['academicYear'])) {
    $academicYear = $_POST['academicYear'];

    $sql = "SELECT 
    cs.InstructorID,
    cs.SubjectID,
    cs.Time_Start, cs.Time_End,
    cs.RoomID,
    cs.is_Monday, cs.is_Tuesday, cs.is_Wednesday, cs.is_Thursday, cs.is_Friday,
    cs.ClassScheduleID,
    d.GradeLevel,
    cs.SectionID,
    cs.ArchiveAt
    FROM archive_schedule cs
    INNER JOIN departments d ON cs.DepartmentID = d.DepartmentID 
    WHERE cs.AcademicYear = ?
    ORDER BY d.GradeLevel, cs.SectionID, cs.ArchiveAt"; // Ordering by GradeLevel, Section, and Archive Date
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $academicYear);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $currentGradeLevel = "";
        $currentSection = "";
        $currentArchiveDate = "";

        while ($row = $result->fetch_assoc()) {
            // Output the Year Level, Section, and Archive Date headers if they're different from the current ones
            if ($row['GradeLevel'] != $currentGradeLevel || $row['SectionID'] != $currentSection || $row['ArchiveAt'] != $currentArchiveDate) {
                // Close previous table if it's not the first iteration
                if ($currentGradeLevel != "") {
                    echo "</tbody></table></div>";
                }
                // Output the Year Level, Section, and Archive Date headers
                echo "<div class='year-section-archive-container' style='margin-bottom: 30px;'>"; // Increased margin-bottom
                echo "<h2 style='font-size: 18px; margin-bottom: 5px;'>"; 
                echo "<strong>Grade " . $row['GradeLevel'] . " - Section " . $row['SectionID'] . "</strong>"; 
                echo "<span style='float: right;'>Archive Date " . $row['ArchiveAt'] . "</span></h2>"; // Moved Archive Date to the right
                // Output the table structure for each Year Level, Section, and Archive Date
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered' width='100%' cellspacing='0'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th scope='col' style='width: 20%'>Subject</th>"; // Set the width of each column
                echo "<th scope='col' style='width: 20%'>Time</th>";
                echo "<th scope='col' style='width: 15%'>Day</th>";
                echo "<th scope='col' style='width: 25%'>Instructor</th>";
                echo "<th scope='col' style='width: 20%'>Room</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $currentGradeLevel = $row['GradeLevel'];
                $currentSection = $row['SectionID'];
                $currentArchiveDate = $row['ArchiveAt'];
            }

            // Outputting table rows with fetched data
            echo "<tr>";
            echo "<td>" . $row['SubjectID'] . "</td>";
            // Format time start
            $timeStart = date("h:i A", strtotime($row['Time_Start']));
            // Format time end
            $timeEnd = date("h:i A", strtotime($row['Time_End']));
            echo "<td>$timeStart - $timeEnd</td>";
            echo "<td>";
            if ($row['is_Monday'] == 1) echo "M ";
            if ($row['is_Tuesday'] == 1) echo "T ";
            if ($row['is_Wednesday'] == 1) echo "W ";
            if ($row['is_Thursday'] == 1) echo "TH ";
            if ($row['is_Friday'] == 1) echo "F ";
            echo "</td>";
            echo "<td>" . $row['InstructorID'] . "</td>";
            echo "<td>" . $row['RoomID'] . "</td>";
            echo "</tr>";
        }

        // Close the last table and its container
        echo "</tbody></table></div>";
        echo "</div>";
    } else {
        // If no data is found in the table
        echo "<div class='table-responsive'><table class='table table-bordered' width='100%' cellspacing='0'><tbody>";
        echo "<tr><td colspan='5'>No data available</td></tr>";
        echo "</tbody></table></div>";
    }

    $stmt->close();
} else {
    // Invalid request
    echo "Invalid request";
}
?>
