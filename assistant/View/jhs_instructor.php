<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../../config/db_connection.php');

    // Retrieve the selected instructor from the POST data
    $instructor = $_POST['instructor'];

    // Using a prepared statement to prevent SQL injection
    $sql = "SELECT * FROM classschedule WHERE Active = 1 AND Instructor = ? AND Department = 'Junior High School'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $instructor);
    $stmt->execute();

    $result = $stmt->get_result();

    $groupedRows = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Group the rows based on a unique key
            $key = $row["YearLevel"] . '_' . $row["Time_Start"] . '_' . $row["Time_End"] . '_' . $row["Subject"] . '_' . $row["Instructor"] . '_' . $row["Room"] . '_' . $row["Section"];

            if (!isset($groupedRows[$key])) {
                $groupedRows[$key] = [
                    'YearLevel' => $row["YearLevel"],
                    'Day' => [],
                    'Time_Start' => strtotime($row["Time_Start"]), // Convert time to a sortable format
                    'Time_End' => strtotime($row["Time_End"]), // Convert time to a sortable format
                    'Subject' => $row["Subject"],
                    'Instructor' => $row["Instructor"],
                    'Room' => $row["Room"],
                    'Section' => $row["Section"],
                ];
            }

            $groupedRows[$key]['Day'][] = $row["Day"];
        }

        // Custom sorting function
        usort($groupedRows, function ($a, $b) {
            // Compare Year Level
            $yearLevelComparison = strcmp($a['YearLevel'], $b['YearLevel']);
            if ($yearLevelComparison !== 0) {
                return $yearLevelComparison;
            }

            // Compare Time_Start
            if ($a['Time_Start'] !== $b['Time_Start']) {
                return $a['Time_Start'] - $b['Time_Start'];
            }

            // If Time_Start is the same, compare Time_End
            return $a['Time_End'] - $b['Time_End'];
        });

        foreach ($groupedRows as $groupedRow) {
            // Display the grouped data as table rows
            echo "<tr>";
            echo "<td>" . $groupedRow["YearLevel"] . "</td>";
            echo "<td>" . $groupedRow["Subject"] . "</td>";
            echo "<td>" . date("h:i A", $groupedRow["Time_Start"]) . ' - ' . date("h:i A", $groupedRow["Time_End"]) . "</td>";
            echo "<td>" . implode(', ', $groupedRow["Day"]) . "</td>";
            echo "<td>" . $groupedRow["Instructor"] . "</td>";
            echo "<td>" . $groupedRow["Room"] . "</td>";
            echo "<td>" . $groupedRow["Section"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // Handle cases where the request method is not POST
    echo "Invalid request method";
}
?>
