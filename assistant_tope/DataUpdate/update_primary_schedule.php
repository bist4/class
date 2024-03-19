<?php
require('../../config/db_connection.php');
include('../../security.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $classScheduleData = $_POST['classScheduleData'];

    foreach ($classScheduleData as $rowData) {
        $classScheduleID = $rowData['ClasscheduleID'];
        $roomID = $rowData['Room'];
        $subjectID = $rowData['Subject'];
        $instructorID = $rowData['Instructor'];
        $timeStart = $rowData['TimeStart'];
        $timeEnd = $rowData['TimeEnd'];

        // Convert time format
        $convertedTimeStart = date("H:i:s", strtotime($timeStart));
        $convertedTimeEnd = date("H:i:s", strtotime($timeEnd));

        $days = explode(',', $rowData['Day']);
        $monday = in_array('M', $days) ? 1 : 0;
        $tuesday = in_array('T', $days) ? 1 : 0;
        $wednesday = in_array('W', $days) ? 1 : 0;
        $thursday = in_array('TH', $days) ? 1 : 0;
        $friday = in_array('F', $days) ? 1 : 0;


        $updateQuery = "UPDATE classschedule SET InstructorID = ?, RoomID = ?, SubjectID = ?, Time_Start = ?, Time_End = ?, Monday = ?, Tuesday = ?, Wednesday = ?, Thursday = ?, Friday = ? WHERE ClasscheduleID = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iiissiiiiii", $instructorID, $roomID, $subjectID, $convertedTimeStart, $convertedTimeEnd, $monday, $tuesday, $wednesday, $thursday, $friday, $classScheduleID);
            $success = mysqli_stmt_execute($stmt);

            if (!$success) {
                echo "Error updating room for ClasscheduleID: $classScheduleID";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing update statement";
        }
    }

    mysqli_close($conn);
} else {
    echo "Invalid request method";
}
?>
