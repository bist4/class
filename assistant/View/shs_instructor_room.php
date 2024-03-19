<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../../config/db_connection.php');

    if (isset($_POST['instructor']) && isset($_POST['room'])) {
        // When both instructor and room are selected
        $instructor = $_POST['instructor'];
        $room = $_POST['room'];

        // Prepare and execute SQL statement with both instructor and room filters
        $sql = "SELECT * FROM classschedule WHERE Active = 1 AND Instructor=? AND Room=? AND Department = 'Senior High School'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $instructor, $room);
    } elseif (isset($_POST['instructor'])) {
        // When only the instructor is selected
        $instructor = $_POST['instructor'];

        // Prepare and execute SQL statement with only the instructor filter
        $sql = "SELECT * FROM classschedule WHERE Active = 1 AND Instructor=? AND Department = 'Senior High School'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $instructor);
    } elseif (isset($_POST['room'])) {
        // When only the room is selected
        $room = $_POST['room'];

        // Prepare and execute SQL statement with only the room filter
        $sql = "SELECT * FROM classschedule WHERE Active = 1 AND Room=? AND Department = 'Senior High School'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $room);
    }

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch and display data based on the selected filters
    if ($result->num_rows > 0) {
        $groupedRows = [];
        while ($row = $result->fetch_assoc()) {
            // Group the rows based on a unique key
            $key = $row["YearLevel"] . '_' . $row["Semester"] . '_' . $row["Strand"] . '_' . $row["Time_Start"] . '_' . $row["Time_End"] . '_' . $row["Subject"] . '_' . $row["Instructor"] . '_' . $row["Room"] . '_' . $row["Section"];

            if (!isset($groupedRows[$key])) {
                $groupedRows[$key] = [
                    'YearLevel' => $row["YearLevel"],
                    'Semester' => $row["Semester"],
                    'Strand' => $row["Strand"],
                    'Day' => [],
                    'Time' => date("h:i A", strtotime($row["Time_Start"])) . ' - ' . date("h:i A", strtotime($row["Time_End"])),
                    'Subject' => $row["Subject"],
                    'Instructor' => $row["Instructor"],
                    'Room' => $row["Room"],
                    'Section' => $row["Section"],
                ];
            }

            $groupedRows[$key]['Day'][] = $row["Day"];
        }

        foreach ($groupedRows as $groupedRow) {
            // Display the grouped data as table rows
            echo "<tr>";
            echo "<td>" . $groupedRow["YearLevel"] . "</td>";
            echo "<td>" . $groupedRow["Semester"] . "</td>";
            echo "<td>" . $groupedRow["Strand"] . "</td>";
            echo "<td>" . implode(', ', $groupedRow["Day"]) . "</td>";
            echo "<td>" . $groupedRow["Time"] . "</td>";
            echo "<td>" . $groupedRow["Subject"] . "</td>";
            echo "<td>" . $groupedRow["Instructor"] . "</td>";
            echo "<td>" . $groupedRow["Room"] . "</td>";
            echo "<td>" . $groupedRow["Section"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No data found</td></tr>";
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // Handle cases where the request method is not POST
    echo "Invalid request method";
}
?>
