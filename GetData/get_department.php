

<!-- try -->

<?php

require('../config/db_connection.php');

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    // Fetch instructors for the "Senior High School" department
    $sqlInstructor = "SELECT * FROM instructor 
                     INNER JOIN department ON instructor.DepartmentID = department.DepartmentID
                     WHERE department.DepartmentTypeNameID = $departmentID";

    $resultInstructor = $conn->query($sqlInstructor);

    if ($resultInstructor->num_rows > 0) {
        echo '<option disabled selected>Select Instructor</option>';
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





