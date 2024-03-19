<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require('../../config/db_connection.php');

        // Retrieve the selected instructor from the POST data
        $room = $_POST['room'];

        // Using a prepared statement to prevent SQL injection
        $sql = "SELECT * FROM classschedule WHERE Active = 1 AND Room = ? AND Department = 'Primary'";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $room);
        $stmt->execute();

        $result = $stmt->get_result();

        $groupedRows = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Group the rows based on a unique key
                $key = $row["YearLevel"] . '_'. $row["Time_Start"] . '_' . $row["Time_End"] . '_' . $row["Subject"] . '_' . $row["Instructor"] . '_' . $row["Room"] . '_' . $row["Section"];

                if (!isset($groupedRows[$key])) {
                    $groupedRows[$key] = [
                        'YearLevel' => $row["YearLevel"],
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
















