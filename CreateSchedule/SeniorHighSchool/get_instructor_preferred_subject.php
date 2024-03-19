<?php
require('../../config/db_connection.php');

if (isset($_POST['subject'])) {
    $subject = $_POST['subject'];

    $sql = "SELECT ps.*, i.Fname, i.Mname, i.Lname, i.Status, i.InstructorID, i.Specialization
            FROM instructorpreferredsubject ps
            INNER JOIN instructor i ON ps.InstructorID = i.InstructorID
            INNER JOIN subjects s ON ps.SubjectID = s.SubjectID
            WHERE s.SubjectID = ? AND ps.Active = 1 AND i.Active = 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $subject);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<option value="" disabled selected>Select Instructor</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['InstructorID'] . '">' . $row['Fname'] . ' ' . $row['Lname'] . ' - ' . $row['Specialization'] . '</option>';
        }
    } else {
        // If no instructors preferred for the subject, display instructors from the 'Senior High School' department
        $sql2 = "SELECT i.InstructorID, i.Fname, i.Lname, i.Specialization, d.DepartmentID, dt.DepartmentTypeName
                FROM instructor i
                INNER JOIN department d ON i.DepartmentID = d.DepartmentID
                INNER JOIN departmenttypename dt ON d.DepartmentTypeNameID = dt.DepartmentTypeNameID
                WHERE dt.DepartmentTypeName = 'Senior High School' AND i.Active = 1";

        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            echo '<option disabled selected>Select Instructor</option>';
            while ($row2 = $result2->fetch_assoc()) {
                echo '<option value="' . $row2['InstructorID'] . '">' . $row2['Fname'] . ' ' . $row2['Lname'] . ' - ' . $row2['Specialization'] . '</option>';
            }
        } else {
            echo '<option disabled>No Instructor available for this selection</option>';
        }
    }

    $stmt->close();
} else {
    echo '<option disabled>Select Subject first</option>';
}

$conn->close();

?>
