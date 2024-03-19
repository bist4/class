<?php
require('../config/db_connection.php');
include('../security.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $scheduleDataArray = $_POST['data'];
    $response = array();
    $insertionStatus = 'success'; // Default status

    $canInsert = true; // Track if insertion is allowed

    foreach ($scheduleDataArray as $scheduleData) {
        if ($canInsert) { // Check if insertion is allowed
            $academicYear = $scheduleData['AcademicYear'];
            $departmentID = $scheduleData['Department'];
            $sectionID = $scheduleData['Section'];
            $subjectID = $scheduleData['Subject'];
            // Adjust the time format to HH:MM:SS
            $timeStart = date('H:i:s', strtotime($scheduleData['Time_Start']));
            $timeEnd = date('H:i:s', strtotime($scheduleData['Time_End']));
    
            $monday = in_array('M', explode(',', $scheduleData['Day'])) ? 1 : 0;
            $tuesday = in_array('T', explode(',', $scheduleData['Day'])) ? 1 : 0;
            $wednesday = in_array('W', explode(',', $scheduleData['Day'])) ? 1 : 0;
            $thursday = in_array('TH', explode(',', $scheduleData['Day'])) ? 1 : 0;
            $friday = in_array('F', explode(',', $scheduleData['Day'])) ? 1 : 0;
            $instructorID = $scheduleData['Instructor'];
            $roomID = $scheduleData['Room'];

            // Build the SQL query
            $sql = "INSERT INTO classschedule (AcademicYear, DepartmentID, SectionID, SubjectID, Time_Start, Time_End, Monday, Tuesday, Wednesday, Thursday, Friday, InstructorID, RoomID, Active, CreatedAt) 
                    VALUES ('$academicYear', '$departmentID', '$sectionID', '$subjectID', '$timeStart', '$timeEnd', $monday, $tuesday, $wednesday, $thursday, $friday, '$instructorID', '$roomID', 0, NOW())";

            // Execute the SQL query
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                $insertionStatus = 'error';
                $response[] = array(
                    'status' => 'error',
                    'message' => 'Error in inserting schedule: ' . mysqli_error($conn)
                );
            }
        }
    }

    if ($insertionStatus === 'success' && $canInsert) {
        $response[] = array(
            'status' => 'success',
            'message' => 'Schedules successfully moved to Draft Schedule.',
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    mysqli_close($conn);
}
?>
