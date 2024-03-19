<?php
require('../../config/db_connection.php');

if (isset($_POST['add_btn'])) {
    $userId = $_POST['User'];
    $specializations = $_POST['Specialization'];

    // Insert user and specializations into userspecialization table
    foreach ($specializations as $classificationId) {
        $insertQuery = "INSERT INTO userspecialization (UserID, ClassificationID) VALUES ('$userId', '$classificationId')";
        $conn->query($insertQuery);
    }

    // Additional processing or redirection can be done here
    header("Location: ../accounts.php");
    exit();
}
?>
