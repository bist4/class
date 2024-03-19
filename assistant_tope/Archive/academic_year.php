<?php
require('../../config/db_connection.php');

if (isset($_POST['academicYear'])) {
    $academicYear = $_POST['academicYear'];

    // Assuming your table name is "classschedule" and the columns are as mentioned
    $sql = "SELECT * FROM classschedule WHERE Active = 3 AND AcademicYear = '$academicYear'";
    $result = $conn->query($sql);

    $groupedRows = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $key = $row["Department"] . '_' . $row["YearLevel"] . '_' . $row["Semester"] . '_' . $row["Strand"] . '_' . $row["Time_Start"] . '_' . $row["Time_End"] . '_' . $row["Subject"] . '_' . $row["Instructor"] . '_' . $row["Room"] . '_' . $row["Section"];

            if (!isset($groupedRows[$key])) {
                $groupedRows[$key] = [
                    'Department' => $row["Department"],
                    'YearLevel' => $row["YearLevel"],
                    'Semester' => $row["Semester"],
                    'Strand' => $row["Strand"],
                    'Day' => [],
                    'Time' => date("h:i A", strtotime($row["Time_Start"])) . ' - ' . date("h:i A", strtotime($row["Time_End"])),
                    'Subject' => $row["Subject"],
                    'Instructor' => $row["Instructor"],
                    'Room' => $row["Room"],
                    'Section' => $row["Section"],
                    'CreatedAt' => $row["CreatedAt"],
                    'DeletedOn' => $row["DeletedOn"],
                ];
            }

            $groupedRows[$key]['Day'][] = $row["Day"];
        }

        // Custom sorting function
        function customSort($a, $b)
        {
            // First, convert YearLevel to numeric values for proper numerical sorting
            $yearLevelComparison = intval($a['YearLevel']) - intval($b['YearLevel']);
            if ($yearLevelComparison !== 0) {
                return $yearLevelComparison;
            }

            // If YearLevel is the same, compare Time as string
            $timeComparison = strcmp($a['Time'], $b['Time']);
            if ($timeComparison !== 0) {
                return $timeComparison;
            }

            // If Time is the same, sort by Day as string
            return strcmp(implode(',', $a['Day']), implode(',', $b['Day']));
        }

        // Sort the groupedRows array using the customSort function
        usort($groupedRows, 'customSort');

        foreach ($groupedRows as $groupedRow) {
            echo "<tr>";
            echo "<td>" . $groupedRow["Department"] . "</td>";
            echo "<td>" . $groupedRow["YearLevel"] . "</td>";
            echo "<td>" . $groupedRow["Semester"] . "</td>";
            echo "<td>" . $groupedRow["Strand"] . "</td>";
            echo "<td>" . implode(', ', $groupedRow["Day"]) . "</td>";
            echo "<td>" . $groupedRow["Time"] . "</td>";
            echo "<td>" . $groupedRow["Subject"] . "</td>";
            echo "<td>" . $groupedRow["Instructor"] . "</td>";
            echo "<td>" . $groupedRow["Room"] . "</td>";
            echo "<td>" . $groupedRow["Section"] . "</td>";
            echo "<td>" . $groupedRow["CreatedAt"] . "</td>";
            echo "<td>" . $groupedRow["DeletedOn"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No data found</td></tr>";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "<tr><td colspan='9'>Invalid request</td></tr>";
}
?>
