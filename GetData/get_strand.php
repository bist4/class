<?php
require('../config/db_connection.php');

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    // Fetch Strand for the determined DepartmentTypeNameID
    $sqlYearLevel = "SELECT DISTINCT StrandCode, StrandName FROM department WHERE DepartmentTypeNameID = $departmentID AND Active = 1";
    $resultYearLevel = $conn->query($sqlYearLevel);

    if ($resultYearLevel->num_rows > 0) {
        echo '<option disabled selected>Select Strand</option>';
        while ($row = $resultYearLevel->fetch_assoc()) {
            echo '<option value="' . $row['StrandCode'] . '">' . $row['StrandName'] . '</option>';
        }
    } else {
        echo '<option disabled>No Strand available for this department</option>';
    }
} else {
    echo '<option disabled selected>Select Department first</option>';
}
?>
