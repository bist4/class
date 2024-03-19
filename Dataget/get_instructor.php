<?php
require('../config/db_connection.php');

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    $sqlInstructor = "SELECT * FROM instructor
                      WHERE DepartmentID = $departmentID AND Active = 1";
    $resultInstructor = $conn->query($sqlInstructor);

    if ($resultInstructor->num_rows > 0) {
        while ($row = $resultInstructor->fetch_assoc()) {
            echo '<option value="' . $row['InstructorID'] . '">' . $row['Fname'] . ' ' . $row['Lname'] . '</option>';
        }
    } else {
        echo '<option disabled>No instructors available for this department</option>';
    }
} else {
    echo '<option disabled selected>Select Instructor Name</option>';
}
?>
