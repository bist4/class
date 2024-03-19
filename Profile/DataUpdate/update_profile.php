<?php
require('../../config/db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get data from AJAX request
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $bday = mysqli_real_escape_string($conn, $_POST['bday']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);

    // Update the user's profile in the database based on the username
    $updateQuery = "UPDATE userinfo SET Fname='$fname', Mname='$mname', Lname='$lname', Birthday='$bday', Address='$address', ContactNumber='$contactNumber' WHERE Username='$username'";
    
    if (mysqli_query($conn, $updateQuery)) {
        echo "success";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>