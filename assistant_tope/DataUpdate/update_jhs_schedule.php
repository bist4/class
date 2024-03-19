<?php
include('../../config/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming these arrays are passed and populated in the POST data
    $classScheduleIDs = $_POST['classScheduleIDs'];
    $days = $_POST['days'];
    $timeStarts = $_POST['timeStarts'];
    $timeEnds = $_POST['timeEnds'];
    $subjects = $_POST['subjects'];
    $instructors = $_POST['instructors'];
    $rooms = $_POST['rooms'];

    // Prepare the UPDATE statement outside the loop
    $sql = "UPDATE classschedule SET Day = ?, Time_Start = ?, Time_End = ?, Subject = ?, Instructor = ?, Room = ? WHERE ClasscheduleID = ?";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => "Prepare failed: " . $conn->error));
        exit(); // Exit the script if the prepare fails
    }

    // Loop through the arrays to execute the update for each set of values
    $response = array(); // Initialize the response array

    foreach ($classScheduleIDs as $index => $classScheduleID) {
        $day = $days[$index];
        $timeStart = $timeStarts[$index];
        $timeEnd = $timeEnds[$index];
        $subject = $subjects[$index];
        $instructor = $instructors[$index];
        $room = $rooms[$index];

        // Bind parameters
        $stmt->bind_param("ssssssi", $day, $timeStart, $timeEnd, $subject, $instructor, $room, $classScheduleID);

        // Execute the statement inside the loop
        $stmt->execute();

        if ($stmt->errno) {
            $response[] = array(
                'status' => 'error',
                'message' => "Error updating record for ClassScheduleID: $classScheduleID. Error: " . $stmt->error
            );
        } else {
            $response[] = array(
                'status' => 'success',
                'message' => "Update successful for ClassScheduleID: $classScheduleID."
            );
        }
    }

    $stmt->close();

    // Output the response array as JSON
    echo json_encode($response);
} else {
    echo json_encode(array('status' => 'error', 'message' => "Invalid or missing data in the request"));
}
?>
