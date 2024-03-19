<?php
require('../../config/db_connection.php');

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    // Fetch Strands for the determined DepartmentTypeNameID
    $sqlYearLevel = "SELECT DISTINCT strands.StrandID, strands.StrandCode FROM department 
    INNER JOIN strands ON department.StrandID = strands.StrandID 
    WHERE department.DepartmentTypeNameID = $departmentID AND department.Active = 1";
    
    $resultYearLevel = $conn->query($sqlYearLevel);

    if ($resultYearLevel->num_rows > 0) {
        echo '<option disabled selected>Select</option>';
        while ($row = $resultYearLevel->fetch_assoc()) {
            echo '<option value="' . $row['StrandID'] . '">' . $row['StrandCode'] . '</option>';
        }
    } else {
        echo '<option disabled>No Strands available for this department</option>';
    }
} else {
    echo '<option disabled selected>Select Department first</option>';
}
?>
