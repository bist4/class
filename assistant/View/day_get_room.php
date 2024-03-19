<?php
require('../../config/db_connection.php');

if (isset($_POST['day'])) {
    $day = $_POST['day'];

    // Fetch subjects for the selected day and active classes from the "classschedules" table
    $query = "SELECT classschedules.RoomID, rooms.RoomNumber, classschedules.Time_Start, classschedules.Time_End, classsections.SectionName
              FROM classschedules 
              INNER JOIN rooms ON classschedules.RoomID = rooms.RoomID 
              INNER JOIN classsections ON classschedules.SectionID = classsections.SectionID";

    $result = $conn->query($query);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Array to store time slots from 07:00 AM to 05:00 PM
        $timeSlots = array(
            '07:00:00' => '07:00 AM',
            '08:00:00' => '08:00 AM',
            '09:00:00' => '09:00 AM',
            '10:00:00' => '10:00 AM',
            '11:00:00' => '11:00 AM',
            '12:00:00' => '12:00 PM',
            '13:00:00' => '01:00 PM',
            '14:00:00' => '02:00 PM',
            '15:00:00' => '03:00 PM',
            '16:00:00' => '04:00 PM',
            '17:00:00' => '05:00 PM'
        );

        // Initialize an array to hold the schedule for each room
        $roomSchedule = array();

        // Initialize the room schedule array with empty slots
        foreach ($timeSlots as $time => $formattedTime) {
            foreach ($result as $row) {
                $roomId = $row['RoomID'];
                $roomSchedule[$roomId][$time] = '';
            }
        }

        // Populate the room schedule array with class information
        foreach ($result as $row) {
            $roomId = $row['RoomID'];
            $startTime = $row['Time_Start'];
            $endTime = $row['Time_End'];
            $sectionName = $row['SectionName'];

            $startSlot = array_search($startTime, array_keys($timeSlots));
            $endSlot = array_search($endTime, array_keys($timeSlots));

            for ($i = $startSlot; $i < $endSlot; $i++) {
                $time = array_keys($timeSlots)[$i];
                $roomSchedule[$roomId][$time] = $sectionName;
            }
        }

        // Display the table
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
        echo '<thead><tr><th scope="col" class="text-center">' . $day . '</th>';

        // Display time slots in the table header
        foreach ($timeSlots as $formattedTime) {
            echo '<th scope="col" class="text-center">' . $formattedTime . '</th>';
        }

        echo '</tr></thead>';
        echo '<tbody>';

        // Display data for each room
        foreach ($roomSchedule as $roomId => $schedule) {
            echo '<tr>';
            echo '<th scope="row" class="text-center">' . 'Room ' . $roomId . '</th>';

            // Display class schedule for each time slot
            foreach ($schedule as $class) {
                echo '<td class="text-center">' . $class . '</td>';
            }

            echo '</tr>';
        }

        echo '</tbody></table></div>';
    } else {
        echo '<div class="card shadow mb-4">';
        echo '<div class="card-body">';
        echo '<p>No classes available for ' . $day . '</p>';
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
