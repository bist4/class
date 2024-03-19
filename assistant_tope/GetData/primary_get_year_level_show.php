<?php
require('../../config/db_connection.php');

// Check if year level is set
if (isset($_POST['yearLevel'])) {
    // Sanitize and validate input
    $yearLevel = $conn->real_escape_string($_POST['yearLevel']);

    // SQL query to retrieve data based on the selected year level
    $query = "SELECT * FROM classschedule 
          WHERE YearLevel = '$yearLevel' 
          AND Active = 0 
          AND Department = 'Primary'";

    $result = $conn->query($query);

    // Check for errors during the database operation
    if (!$result) {
        die("Error in fetching data: " . $conn->error);
    }

    $instructors = [];

    while ($row = $result->fetch_assoc()) {
        $key = $row['Instructor'] . '_' . $row['Time_Start'] . '_' . $row['Time_End'];

        if (!isset($instructors[$key])) {
            $instructors[$key] = [
                'Days' => [],
                'Time_Start' => $row['Time_Start'],
                'Time_End' => $row['Time_End'],
                'Subject' => $row['Subject'],
                'Instructor' => $row['Instructor'],
                'Room' => $row['Room'],
            ];
        }

        $instructors[$key]['Days'][] = $row['Day'];
    }

    // Define the order of days
    $orderOfDays = ['M' => 1, 'T' => 2, 'W' => 3, 'TH' => 4, 'F' => 5];

    // Sort instructors based on the order of days
    uasort($instructors, function ($a, $b) use ($orderOfDays) {
        $dayA = reset($a['Days']);
        $dayB = reset($b['Days']);
        return $orderOfDays[$dayA] - $orderOfDays[$dayB];
    });

    foreach ($instructors as $instructor) {
        $days = $instructor['Days'];
        $mergedDays = implode(', ', $days);
    ?>
        <tr>
            <td>
                <?php echo $mergedDays; ?>
            </td>
            <td>
                <?php
                $timeStart = date("h:i A", strtotime($instructor['Time_Start']));
                $timeEnd = date("h:i A", strtotime($instructor['Time_End']));
                echo $timeStart . ' - ' . $timeEnd;
                ?>
            </td>
            <td>
                <?php echo $instructor['Subject']; ?>
            </td>
            <td>
                <?php echo $instructor['Instructor']; ?>
            </td>
            <td>
                <?php echo $instructor['Room']; ?>
            </td>
        </tr>
    <?php
    }

    // Close the result set
    $result->close();
    
} else {
    // Handle the case where year level is not set
    echo "<tr><td colspan='7'>Invalid input parameters</td></tr>";
}

// Close the database connection
$conn->close();
?>