<?php
// update_schedule.php

// Assuming you have a database connection
require('../config/db_connection.php');

// Assuming you receive the data through a POST request
$data = json_decode(file_get_contents("php://input"), true);

if ($data && isset($data['data'])) {
    $selectedData = $data['data'];

    foreach ($selectedData as $scheduleData) {
        $classScheduleID = $scheduleData['ClassScheduleID'];
        $status = $scheduleData['Status'];

        // Update the status in the 'history' table
        $stmt = $conn->prepare("UPDATE history SET Status = ? WHERE ClassScheduleID = ?");
        $stmt->bind_param("ii", $status, $classScheduleID);

        if (!$stmt->execute()) {
            // Return error response if an update fails
            echo json_encode(['success' => false]);
            exit;
        }

        // Close the statement
        $stmt->close();
    }

    // Return success response if all updates are successful
    echo json_encode(['success' => true]);
} else {
    // Return error response if the data is not provided
    echo json_encode(['success' => false]);
}

// Close the database connection
$conn->close();
?>
