<?php
require('../../config/db_connection.php');
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $specializations = isset($_POST['specializations']) ? $_POST['specializations'] : [];
    $instructorSpecializationsIDs = $_POST['InstructorSpecializationsID'];

    // Update instructors table
    foreach ($instructorSpecializationsIDs as $index => $instructorSpecializationID) {
        $instructorSpecializationID = $conn->real_escape_string($instructorSpecializationID); // Escape special characters
        $specialization = $conn->real_escape_string($specializations[$index]); // Get specialization for current ID

        $instructor_sql = "UPDATE instructorspecializations SET SpecializationName = '$specialization' WHERE InstructorSpecializationsID = $instructorSpecializationID";

        if ($conn->query($instructor_sql) !== TRUE) {
            $response['error'] = "Error updating instructor record: " . $conn->error;
            echo json_encode($response);
            $conn->close();
            exit;
        }
    }

    // Return success response
    $response['success'] = "Records updated successfully";
    echo json_encode($response);

    // Close connection
    $conn->close();
}
?>
