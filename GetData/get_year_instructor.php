<?php
require('../config/db_connection.php');

if (isset($_POST['yearLevel'])) {
    $yearLevel = $_POST['yearLevel'];

    // Fetch subjects for the selected year level from the "subjects" table based on "Year Level" from "department"
    $sqlInstructor = "SELECT * FROM instructor
                    INNER JOIN department ON instructor.DepartmentID = department.DepartmentID
                    WHERE department.YearLevel = '$yearLevel'";

    $resultInstructor = $conn->query($sqlInstructor);

    if ($resultInstructor->num_rows > 0) {
        echo '<option disabled selected>Select Subject</option>';
        while ($row = $resultInstructor->fetch_assoc()) {
            echo '<option value="' . $row['InstructorID'] . '">' . $row['Fname'] . ' ' . $row['Lname'] . '</option>';
        }
    } else {
        echo '<option disabled>No subjects available for this year level</option>';
    }
} else {
    echo '<option disabled selected>Select Year Level first</option>';
}
?>
