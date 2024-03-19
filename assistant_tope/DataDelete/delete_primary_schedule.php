<?php
require('../../config/db_connection.php');
include('../../security.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $classScheduleData = $_POST['classScheduleData'];
    error_log(print_r($classScheduleData, true)); // Log received data

    foreach ($classScheduleData as $classScheduleID) {
        $deleteQuery = "DELETE FROM classschedule WHERE ClasscheduleID = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $classScheduleID);
            $success = mysqli_stmt_execute($stmt);

            if (!$success) {
                echo "Error deleting record with ClasscheduleID: $classScheduleID";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing delete statement";
        }
    }

    mysqli_close($conn);
} else {
    echo "Invalid request method";
}
?>
