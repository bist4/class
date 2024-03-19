<?php

require('../config/db_connection.php');
include('../security.php');

// Assuming POST request for simplicity, validate/sanitize input as needed
$yearLevel = $_POST['yearLevel'];
$section = $_POST['section'];

// SQL query to check if all subjects for the specified year level exist in classschedule
$sql = "SELECT COUNT(DISTINCT s.SubjectID) AS totalSubjectsCount, SUM(s.MinutesPerWeek) AS totalMinutesPerWeek
        FROM subjects s
        WHERE s.DepartmentID = '$yearLevel'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $totalSubjectsCount = $row['totalSubjectsCount'];
    $totalMinutesPerWeek = $row['totalMinutesPerWeek'];

    // SQL query to count the number of distinct subjects for the specified year level in classschedule
    $sqlClassScheduleCount = "SELECT COUNT(DISTINCT c.SubjectID) AS classScheduleCount
                             FROM classschedules c
                             WHERE c.DepartmentID = '$yearLevel' AND c.SectionID = '$section'";
    $resultClassScheduleCount = $conn->query($sqlClassScheduleCount);

    if ($resultClassScheduleCount) {
        $row = $resultClassScheduleCount->fetch_assoc();
        $classScheduleCount = $row['classScheduleCount'];

        // SQL query to calculate the total duration for all subjects
        $sqlTotalDuration = "SELECT SUM(TIME_TO_SEC(TIMEDIFF(Time_End, Time_Start)) *
                                    (is_Monday + is_Tuesday + is_Wednesday + is_Thursday + is_Friday)) AS totalDuration
                             FROM classschedules
                             WHERE DepartmentID = '$yearLevel' AND SectionID = '$section'";
        $resultTotalDuration = $conn->query($sqlTotalDuration);

        if ($resultTotalDuration) {
            $totalDurationRow = $resultTotalDuration->fetch_assoc();
            $totalDuration = $totalDurationRow['totalDuration'] / 60;

            // Return a JSON response indicating whether all subjects exist in classschedule and total duration matches totalMinutesPerWeek
            if ($classScheduleCount == $totalSubjectsCount && $totalDuration == $totalMinutesPerWeek) {
                echo json_encode(['complete' => true]);
            } else {
                echo json_encode(['complete' => false]);
            }
        } else {
            // Handle the error
            echo json_encode(['error' => 'Error calculating total duration']);
        }
    } else {
        // Handle the error
        echo json_encode(['error' => 'Database query error']);
    }
} else {
    // Handle the error
    echo json_encode(['error' => 'Database query error']);
}

// Close the database connection
$conn->close();

?>
