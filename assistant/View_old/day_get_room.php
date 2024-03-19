<?php
require('../../config/db_connection.php');

if (isset($_POST['day'])) {
    $day = $_POST['day'];

    // Fetch subjects for the selected day and active classes from the "classschedule" table
    $query = "SELECT * FROM classschedule 
              WHERE Day = '$day' 
              AND Active = 1
              ORDER BY Room ASC, Time_Start ASC";

    $result = $conn->query($query);

    // Check if there are any results
    if ($result->num_rows > 0) {
        $rooms = array();  // Array to store unique rooms
        $times = array();  // Array to store unique time slots

        // Collect unique rooms and time slots
        while ($row = $result->fetch_assoc()) {
            $rooms[$row['Room']] = true;
            $times[$row['Time_Start']] = true;
        }

        // Define static time slots from 7 AM to 5 PM
        $staticTimes = array(
            '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00',
            '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00'
        );

        // Display the table headers     
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered" width="100%" cellspacing="0">';
        echo '<thead><tr><th scope="col" class="text-center">Room</th>';

        // Display static time slots as table headers
        foreach ($staticTimes as $time) {
            echo '<th scope="col" class="text-center">' . date('ga', strtotime($time)) . '</th>';
        }

        echo '</tr></thead><tbody>';

        // Display data for each room and time slot
        foreach ($rooms as $room => $value) {
            echo '<tr>';
            echo '<th scope="row" class="text-center">' . $room . '</th>';

            foreach ($staticTimes as $time) {
                $result->data_seek(0);  // Reset result set to the beginning

                // Find the data for the current room and time slot
                $found = false;
                while ($row = $result->fetch_assoc()) {
                    if ($row['Room'] == $room && $row['Time_Start'] == $time) {
                        // Display the data in the table cell without time
                        echo '<td class="text-center">';
                        echo $row['Instructor'];
                        echo '</td>';
                        $found = true;
                        break;
                    }
                }

                // If no data is found, display an empty cell and make it gray
                if (!$found) {
                    echo '<td class="text-center empty-cell"></td>';
                }
            }

            echo '</tr>';
        }

        echo '</tbody></table></div></div>'; // Removed an extra closing div here
    } else {
        echo '<div class="card shadow mb-4">';
        echo '<div class="card-body">';
        echo '<p>No classes available for the selected day</p>';
        echo '</div></div>';
    }

    // Close the result set
    $result->close();
} else {
    echo '<div class="card shadow mb-4">';
    echo '<div class="card-body">';
    echo '<p>Select Day first</p>';
    echo '</div></div>';
}

// Close the database connection
$conn->close();
?>

<style>
    .empty-cell {
        background-color: #f2f2f2; /* Light gray background */
        color: #777; /* Gray text color */
    }
</style>
