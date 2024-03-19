<?php
require('../../config/db_connection.php');

if (isset($_POST['add_btn'])) {
    $userId = $_POST['User'];
    $departments = $_POST['Department'];

    // Insert user and departments into userroles table
    foreach ($departments as $department) {
        $insertQuery = "INSERT INTO userdepartment (UserID, DepartmentID) VALUES ('$userId', '$department')";
        $conn->query($insertQuery);
    }

    // Additional processing or redirection can be done here
    header("Location: ../accounts.php");
    exit();
}
?>
