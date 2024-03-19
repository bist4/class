<?php

require('../config/db_connection.php');
include('../security.php');

// Assuming POST request for simplicity, validate/sanitize input as needed
$yearLevel = $_POST['yearLevel'];
$section = $_POST['section'];

// SQL query to check if all subjects for the specified year level exist in classschedule
$sql = "SELECT COUNT(DISTINCT s.SubjectID) AS totalSubjectsCount
        FROM subjects s
        JOIN department d ON s.DepartmentID = d.DepartmentID
        WHERE d.YearLevel = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $yearLevel);
    $stmt->execute();
    $stmt->bind_result($totalSubjectsCount);
    $stmt->fetch();
    $stmt->close();

    // SQL query to count the number of distinct subjects for the specified year level in classschedule
    $sqlClassScheduleCount = "SELECT COUNT(DISTINCT c.Subject) AS classScheduleCount
                             FROM classschedule c
                             WHERE c.YearLevel = ? AND c.Section = ?";
    $stmtClassScheduleCount = $conn->prepare($sqlClassScheduleCount);

    if ($stmtClassScheduleCount) {
        $stmtClassScheduleCount->bind_param("ss", $yearLevel, $section);
        $stmtClassScheduleCount->execute();
        $stmtClassScheduleCount->bind_result($classScheduleCount);
        $stmtClassScheduleCount->fetch();
        $stmtClassScheduleCount->close();

        // Return a JSON response indicating whether all subjects exist in classschedule
        if ($classScheduleCount == $totalSubjectsCount) {
            echo json_encode(['complete' => true]);
        } else {
            echo json_encode(['complete' => false]);
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
