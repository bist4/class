<?php
require('../../config/db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs to prevent SQL injection
    $UserInfoID = mysqli_real_escape_string($conn, $_POST['UserInfoID']);
    $Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
    $Lname = mysqli_real_escape_string($conn, $_POST['Lname']);
    $Mname = mysqli_real_escape_string($conn, $_POST['Mname']);
    $Bday = mysqli_real_escape_string($conn, $_POST['Bday']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $Cnumber = mysqli_real_escape_string($conn, $_POST['Cnumber']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Calculate age based on the provided birthday
    $dob = new DateTime($Bday);
    $now = new DateTime();
    $age = $dob->diff($now)->y;

    // Update data in the database
    $sql = "UPDATE userinfo SET Fname='$Fname', Lname='$Lname', Mname='$Mname', Age=$age, Birthday='$Bday', Gender='$gender', ContactNumber='$Cnumber', Address='$address' WHERE UserInfoID=$UserInfoID";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => true, "message" => "Account Updated Successfully"));
        exit;
    } else {
        echo json_encode(array("error" => true, "message" => "Error updating record: " . $conn->error));
        exit;
    }
}

$conn->close();
?>
