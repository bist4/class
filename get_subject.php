<?php
require('config/db_connection.php');

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    // Fetch the DepartmentID based on the selected DepartmentTypeNameID
    $sqlDepartmentID = "SELECT DepartmentID FROM department WHERE DepartmentTypeNameID = $departmentID";
    $resultDepartmentID = $conn->query($sqlDepartmentID);

    if($resultDepartmentID->num_rows > 0){
        $row = $resultDepartmentID->fetch_assoc();
        $departmentID = $row['DepartmentID'];

         // Fetch subjects for the determined DepartmentID
        $sqlSubject = "SELECT * FROM subjects WHERE DepartmentID = $departmentID AND Active = 1";
        $resultSubject = $conn->query($sqlSubject);

        // $sqlSpecialization = "SELECT Specialization FROM instructor WHERE InstructorID = $instructorID";
        // $resultSpecialization = $conn->query($sqlSpecialization);

        if ($resultSubject->num_rows > 0) {
            echo '<option disabled selected>Select Subject</option>';
            while ($row = $resultSubject->fetch_assoc()) {
                echo '<option value="' . $row['SubjectID'] . '">' . $row['SubjectDescription'] . '</option>';
            }
        }  
        else {
            echo '<option disabled>No subjects available for this department</option>';
        }
    }
   
} else {
    echo '<option disabled selected>Select Subject</option>';
}
?>
