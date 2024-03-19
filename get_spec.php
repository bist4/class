<?php
require('config/db_connection.php');

if (isset($_POST['instructorID'])) {
    $instructorID = $_POST['instructorID'];

    // Fetch the specialization of the selected instructor
    $sqlSpecialization = "SELECT Specialization FROM instructor WHERE InstructorID = $instructorID";
    $resultSpecialization = $conn->query($sqlSpecialization);

    if ($resultSpecialization->num_rows > 0) {
        $row = $resultSpecialization->fetch_assoc();
        $specialization = $row['Specialization'];
        echo $specialization; 
    } else {
        echo "Specialization not found for this instructor.";
    }
} else {
    echo "Please select an instructor.";
}
?>
