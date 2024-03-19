<?php

$servername= "localhost";
$username= "root";
$password = "ccbc-2025";
// $dbname = "classschedule";
// $dbname = "onlineclassschedule";
$dbname = "tope";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
