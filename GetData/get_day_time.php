<?php
require('../config/db_connection.php');

if (isset($_POST['day'])) {
    $day = $_POST['day'];

    // SQL query to select Specialization from specializations based on StrandCode
    $sql = "SELECT InstructorTimeAvailabilityID, MIN(Time_Start) AS MinTime, MAX(Time_End) AS MaxTime
    FROM instructortimeavailability WHERE Day = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $day);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $minTime = $row['MinTime'];
        $maxTime = $row['MaxTime'];

        echo "MinTime : " . $minTime. "<br>";
        echo "MaxTime : " . $maxTime. "<br>";

        // echo '<option disabled selected>Select Time</option>';
        // while ($row = $result->fetch_assoc()) {
        //     // echo '<option value="' . $row['InstructorTimeAvailabilityID'] . '">' . $row['Time_Start'] . '</option>';
        // }
    } else {
        $sql2 = "SELECT i.*
        FROM instructor i
        LEFT JOIN instructorpreferredsubject ta ON i.InstructorID = ta.InstructorID
        WHERE ta.InstructorID IS NULL";

        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();

        $result2 = $stmt2->get_result();

        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                echo '<option value="' . $row2['InstructorID'] . '">' . $row2['Fname'] . '</option>';
            }
        } else {
            echo '<option disabled>No Instructor available for this selection</option>';
        }

        $stmt2->close();
    }

    $stmt->close();
} else {
    echo '<option disabled selected>Select Subject first</option>';
}
?>
