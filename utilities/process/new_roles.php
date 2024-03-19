<?php
require('../../config/db_connection.php');

if (isset($_POST['add_btn'])) {
    $userId = $_POST['User'];
    $roles = $_POST['Roles'];

    // Insert user and roles into userroles table
    foreach ($roles as $role) {
        $insertQuery = "INSERT INTO userroles (UserID, RoleID) VALUES ('$userId', '$role')";
        $conn->query($insertQuery);
    }

    // Additional processing or redirection can be done here
    header("Location: ../accounts.php");
    exit();
}
?>
