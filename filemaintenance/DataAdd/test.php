<?php
require('../../config/db_connection.php');
session_start();

// I-assume na mayroon ka nang koneksyon sa database ($conn) dito.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // I-retrieve ang mga data mula sa form
    $departmentID = $_POST['Department'];
    $subjectCode = $_POST['SubjectCode'];
    $subjectDescription = $_POST['SubjectDescription'];
    $units = $_POST['Units'];

    // I-query para i-insert ang data sa table "subjects"
    $sql = "INSERT INTO subjects (DepartmentID, SubjectCode, SubjectDescription, Units, Active, CreatedAt)
            VALUES ('$departmentID', '$subjectCode', '$subjectDescription', '$units', 1, NOW())";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../file_subject.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // I-sarado ang koneksyon sa database
    $conn->close();
}
?>

