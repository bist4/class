<?php

// Include your database connection code here
require('../config/db_connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the POST request
    $yearLevel = $_POST["yearLevel"];
    $semester = $_POST["semester"];
    $track = $_POST["track"];
    $strand = $_POST["strand"];
    $section = $_POST["section"];

    // Update the Active column in the database
    $sql = "UPDATE classschedule SET Active = 1 WHERE YearLevel = '$yearLevel' AND Semester = '$semester' AND Strand = '$strand' AND Section = '$section'";

    if ($conn->query($sql) === TRUE) {
        // If the update is successful, send a success response
        echo json_encode(["success" => true]);
    } else {
        // If there's an error, send an error response
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
}

// Close the database connection
$conn->close();
?>

