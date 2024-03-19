<?php
require('../../config/db_connection.php');

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    // Fetch Semester for the determined DepartmentTypeNameID
    $sqlYearLevel = "SELECT DISTINCT Semester FROM department WHERE DepartmentTypeNameID = $departmentID AND Active = 1";
    $resultYearLevel = $conn->query($sqlYearLevel);

    if ($resultYearLevel->num_rows > 0) {
        echo '<option disabled selected>Select Semester</option>';
        while ($row = $resultYearLevel->fetch_assoc()) {
            echo '<option value="' . $row['Semester'] . '">' . $row['Semester'] . '</option>';
        }
    } else {
        echo '<option disabled>No Semester available for this department</option>';
    }
} else {
    echo '<option disabled selected>Select Department first</option>';
}
?>
