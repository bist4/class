<?php
require('../config/db_connection.php');

if (isset($_POST['subject'])) {
    $subject = $_POST['subject'];

    // SQL query to select Specialization from specializations based on StrandCode
    $sql = "SELECT ps.*, i.Fname, i.Mname, i.Lname, i.Status, i.InstructorID
            FROM instructorpreferredsubject ps
            INNER JOIN instructor i ON ps.InstructorID = i.InstructorID
            INNER JOIN subjects s ON ps.SubjectID = s.SubjectID
            WHERE s.SubjectID = ? AND ps.Active=1 AND i.Active=1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $subject);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<option disabled selected>Select Instructor</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['InstructorID'] . '">' . $row['Fname'] . ' ' .$row['Lname'] .' - '.$row['Status'].'</option>';
        }
    } else {
        echo '<option disabled>Add Preferred Subject to Instructor</option>';
        // $sql2 = "SELECT i.InstructorID, i.Fname, i.Lname, i.Status
        // FROM instructor i
        // LEFT JOIN instructorpreferredsubject ps ON i.InstructorID = ps.InstructorID AND ps.SubjectID = ?
        // WHERE ps.InstructorID IS NULL OR ps.SubjectID IS NULL";

        // $stmt2 = $conn->prepare($sql2);
        // $stmt2->bind_param("s", $subject);
        // $stmt2->execute();

        // $result2 = $stmt2->get_result();

        // if ($result2->num_rows > 0) {
        //     echo '<option disabled selected>Select Instructor</option>';
        //     while ($row2 = $result2->fetch_assoc()) {
        //         echo '<option value="' . $row2['InstructorID'] . '">' . $row2['Fname'] . ' ' .$row2['Lname']. ' - ' .$row2['Status'].'</option>';
        //     }
        // } else {
        //     echo '<option disabled>No Instructor available for this selection</option>';
        // }

        // $stmt2->close();
    }

    $stmt->close();
} else {
    echo '<option disabled>Select Subject first</option>';
}

$conn->close();
?>
