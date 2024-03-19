<?php
require '../config/db_connection.php';
include '../security.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have validated and sanitized the input before using it in the query
    $subjectDescription = $_POST['subjectDescription'];
    $yearLevel = $_POST['yearLevel'];

    $sqlUnits = "SELECT s.Units 
                 FROM subjects s
                 INNER JOIN department d ON s.DepartmentID = d.DepartmentID
                 WHERE s.SubjectDescription = '$subjectDescription' 
                 AND d.DepartmentTypeNameID = 3 
                 AND d.YearLevel = $yearLevel";

    if ($result = $conn->query($sqlUnits)) {
        if ($row = $result->fetch_assoc()) {
            echo $row['Units'];
        } else {
            echo "No result found";
        }
        $result->free_result();
    } else {
        echo "Error in query: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method";
}
?>
