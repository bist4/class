<?php
require('../../config/db_connection.php');
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $is_Monday = isset($_POST['Monday']) ? 1 : 0;
    $is_Tuesday = isset($_POST['Tuesday']) ? 1 : 0;
    $is_Wednesday = isset($_POST['Wednesday']) ? 1 : 0;
    $is_Thursday = isset($_POST['Thursday']) ? 1 : 0;
    $is_Friday = isset($_POST['Friday']) ? 1 : 0;

    $timeStart = $_POST['Time_Start'];
    $timeEnd = $_POST['Time_End'];

    $InstructorTimeAvailabilitiesIDs = $_POST['InstructorTimeAvailabilitiesID'];

    // Check if the same instructor has a conflicting schedule
    foreach ($InstructorTimeAvailabilitiesIDs as $index => $InstructorTimeAvailabilitiesID) {
        $InstructorTimeAvailabilitiesID = $conn->real_escape_string($InstructorTimeAvailabilitiesID); // Escape special characters
        $timeStartValue = $conn->real_escape_string($timeStart[$index]); // Fetch corresponding time start value
        $timeEndValue = $conn->real_escape_string($timeEnd[$index]); // Fetch corresponding time end value

        // Query to check for conflicting schedules
        $conflict_query = "SELECT * FROM instructortimeavailabilities 
                          WHERE InstructorTimeAvailabilitiesID != '$InstructorTimeAvailabilitiesID' 
                          AND InstructorID = (SELECT InstructorID FROM instructortimeavailabilities WHERE InstructorTimeAvailabilitiesID = '$InstructorTimeAvailabilitiesID')
                          AND (
                              (Time_Start <= '$timeStartValue' AND Time_End >= '$timeStartValue') OR
                              (Time_Start <= '$timeEndValue' AND Time_End >= '$timeEndValue')
                          )
                          AND (
                              (is_Monday = 1 AND '$is_Monday' = 1) OR
                              (is_Tuesday = 1 AND '$is_Tuesday' = 1) OR
                              (is_Wednesday = 1 AND '$is_Wednesday' = 1) OR
                              (is_Thursday = 1 AND '$is_Thursday' = 1) OR
                              (is_Friday = 1 AND '$is_Friday' = 1)
                          )";

        $conflict_result = $conn->query($conflict_query);
        if ($conflict_result && $conflict_result->num_rows > 0) {
            $response['error'] = "The instructor has a conflicting schedule at this time.";
            echo json_encode($response);
            $conn->close();
            exit;
        }

     
                    


        // Update the instructor's availability if no conflicts found
        $instructor_sql = "UPDATE instructortimeavailabilities 
                           SET is_Monday = '$is_Monday', is_Tuesday = '$is_Tuesday', is_Wednesday = '$is_Wednesday', 
                               is_Thursday = '$is_Thursday', is_Friday = '$is_Friday', 
                               Time_Start = '$timeStartValue', Time_End = '$timeEndValue' 
                           WHERE InstructorTimeAvailabilitiesID = '$InstructorTimeAvailabilitiesID'";

        if ($conn->query($instructor_sql) !== TRUE) {
            $response['error'] = "Error updating instructor availability: " . $conn->error;
            echo json_encode($response);
            $conn->close();
            exit;
        }
    }

    // Return success response
    $response['success'] = "Instructor availability updated successfully";
    echo json_encode($response);

    // Close connection
    $conn->close();
}
?>
