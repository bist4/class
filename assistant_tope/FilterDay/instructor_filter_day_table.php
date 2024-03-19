<?php
require('../../config/db_connection.php');

if (isset($_POST['filterDay']) && isset($_POST['instructor'])) {
    $instructor = $_POST['instructor'];
    $filterDay = $_POST['filterDay'];

    // Fetch subjects for the selected day, year level, and section
    $query = "SELECT * FROM classschedule 
          WHERE Day = '$filterDay' 
          AND Active = 1 
          AND Instructor = '$instructor'";

    $result = $conn->query($query);

    // Check for errors during the database operation
    if (!$result) {
        die("Error in fetching data: " . $conn->error);
    }

    echo '<thead>';
    echo '<tr>';
    echo '<th>Year Level</th>';
    echo '<th>Subject</th>';
    echo '<th>Time</th>';
    echo '<th>Instructor</th>';
    echo '<th>Room</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        // Convert time to AM/PM format
        $timeStart = date("h:i A", strtotime($row['Time_Start']));
        $timeEnd = date("h:i A", strtotime($row['Time_End']));

        // Generate HTML row based on the data
        echo '<tr>';
        echo '<td>' . $row['YearLevel'] . '</td>';
        echo '<td>' . $row['Subject'] . '</td>';
        echo '<td>' . $timeStart . ' - ' . $timeEnd . '</td>';
        echo '<td>' . $row['Instructor'] . '</td>';
        echo '<td>' . $row['Room'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';

    // Close the result set
    $result->close();
} else {
    echo '<tr><td colspan="4">Invalid request</td></tr>';
}

// Close the database connection
$conn->close();
?>
