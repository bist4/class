<?php
require('../../config/db_connection.php');

if (isset($_POST['yearLevel'])) {
    $yearLevel = $_POST['yearLevel'];

    // Fetch subjects for the selected year level from the "subjects" table based on "Year Level" from "department"
    $sqlSubjects = "SELECT * FROM subjects
                    INNER JOIN department ON subjects.DepartmentID = department.DepartmentID
                    WHERE department.YearLevel = '$yearLevel'";

    $resultSubjects = $conn->query($sqlSubjects);

    if ($resultSubjects->num_rows > 0) {
        echo '<option disabled selected>Select Subject</option>';
        while ($row = $resultSubjects->fetch_assoc()) {
            echo '<option value="' . $row['SubjectID'] . '">' . $row['SubjectDescription'] . '</option>';
        }
    } else {
        echo '<option disabled>No subjects available for this year level</option>';
    }
} else {
    echo '<option disabled selected>Select Year Level first</option>';
}
?>
