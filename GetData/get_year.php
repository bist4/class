<?php
require('../config/db_connection.php');

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    // Fetch Year Levels for the determined DepartmentTypeNameID
    $sqlYearLevel = "SELECT DISTINCT YearLevel FROM department WHERE DepartmentTypeNameID = $departmentID AND Active = 1";
    $resultYearLevel = $conn->query($sqlYearLevel);

    if ($resultYearLevel->num_rows > 0) {
        echo '<option disabled selected>Select Year Level</option>';
        while ($row = $resultYearLevel->fetch_assoc()) {
            echo '<option value="' . $row['YearLevel'] . '">' . $row['YearLevel'] . '</option>';
        }
    } else {
        echo '<option disabled>No Year Levels available for this department</option>';
    }
} else {
    echo '<option disabled selected>Select Department first</option>';
}
?>
