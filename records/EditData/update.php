<?php
require('../../config/db_connection.php');
include('../../security.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TimeAvail = isset($_POST['TimeAvail']) ? $_POST['TimeAvail'] : [];


    foreach ($TimeAvail as $rowData) {
        $instructorTimeAvailabilityID = $rowData['InstructorTimeAvailabilitiesID'];
        $timeStart = $rowData['TimeStart'];
        $timeEnd = $rowData['TimeEnd'];

        // Convert time format
        $convertedTimeStart = date("H:i:s", strtotime($timeStart));
        $convertedTimeEnd = date("H:i:s", strtotime($timeEnd));

        $days = explode(',', $rowData['Day']);
        $monday = in_array('Monday', $days) ? 1 : 0;
        $tuesday = in_array('Tuesday', $days) ? 1 : 0;
        $wednesday = in_array('Wednesday', $days) ? 1 : 0;
        $thursday = in_array('Thursday', $days) ? 1 : 0;
        $friday = in_array('Friday', $days) ? 1 : 0;

        $updateQuery = "UPDATE instructortimeavailabilities SET Time_Start = ?, Time_End = ?, is_Monday = ?, is_Tuesday = ?, is_Wednesday = ?, is_Thursday = ?, is_Friday = ? WHERE InstructorTimeAvailabilitiesID= ?";
        $stmt = mysqli_prepare($conn, $updateQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssiiiiii", $convertedTimeStart, $convertedTimeEnd, $monday, $tuesday, $wednesday, $thursday, $friday, $instructorTimeAvailabilityID);
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


