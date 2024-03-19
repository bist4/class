<?php
require('../config/db_connection.php');

if (isset($_POST['semester']) && isset($_POST['yearLevel'])) {
    $semester = $_POST['semester'];
    $yearLevel = $_POST['yearLevel'];

    // Fetch subjects for the selected semester and year level from the "subjects" table
    $sqlSubjects = "SELECT * FROM subjects
                    INNER JOIN department ON subjects.DepartmentID = department.DepartmentID
                    WHERE department.Semester = '$semester' AND department.YearLevel = '$yearLevel'";

    $resultSubjects = $conn->query($sqlSubjects);

    if ($resultSubjects->num_rows > 0) {
        echo '<option disabled selected>Select Subject</option>';
        while ($row = $resultSubjects->fetch_assoc()) {
            echo '<option value="' . $row['SubjectID'] . '">' . $row['SubjectDescription'] . '</option>';
        }
    } else {
        echo '<option disabled>No subjects available for this selected semester and year level</option>';
    }
} else {
    echo '<option disabled selected>Select Semester and Year Level first</option>';
}
?>
