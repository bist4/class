<?php

require('../config/db_connection.php');

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    // Fetch instructors for the "Senior High School" department
    $sqlSubjects = "SELECT * FROM subjects
                     INNER JOIN department ON subjects.DepartmentID = department.DepartmentID
                     WHERE department.DepartmentTypeNameID = $departmentID";

    $resultSubjects = $conn->query($sqlSubjects);

    if ($resultSubjects->num_rows > 0) {
        echo '<option disabled selected>Select Subject</option>';
        while ($row = $resultSubjects->fetch_assoc()) {
            echo '<option value="' . $row['SubjectID'] . '">'  . ' ' . $row['SubjectDescription'] . '</option>';
        }
    } else {
        echo '<option disabled>No instructors available for this department</option>';
    }
} else {
    echo '<option disabled selected>Select Instructor Name</option>';
}
?>