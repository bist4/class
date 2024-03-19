<?php
require('config/db_connection.php');

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    // Fetch instructors for the selected DepartmentID
    $sqlInstructor = "SELECT i.InstructorID, i.Fname, i.Lname, i.Status
                      FROM instructor i
                      INNER JOIN departmenttypename dt ON i.DepartmentID = dt.DepartmentTypeNameID
                      WHERE i.DepartmentID = $departmentID AND i.Active = 1";

    $resultInstructor = $conn->query($sqlInstructor);

    if ($resultInstructor->num_rows > 0) {
        echo '<option disabled selected>Select Instructor Name</option>';
        while ($row = $resultInstructor->fetch_assoc()) {
            echo '<option value="' . $row['InstructorID'] . '">' . $row['Fname'] . ' ' . $row['Lname'] . '-' . $row['Status'] . '</option>';
        }
    } else {
        echo '<option disabled>No instructors available for this department</option>';
    }
} else {
    echo '<option disabled selected>Select Instructor Name</option>';
}
?>
