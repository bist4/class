<?php
session_start();
require('../../config/db_connection.php');

$loggedInUsername = $_SESSION['Username'];
$currentPassword = $_POST['current_password'];

$query = "SELECT Password FROM userinfo WHERE Username = '$loggedInUsername'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['Password'];

    if (password_verify($currentPassword, $storedPassword)) {
        echo "success";
    } else {
        echo "failure";
    }
} else {
    echo "error";
}

$conn->close();
?>
