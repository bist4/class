<?php

// Include your database connection code here
require('../../config/db_connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the Active column and set DeletedOn to the current timestamp
$sql = "UPDATE classschedule SET Active = 3, DeletedOn = NOW() WHERE Active = 1";

if ($conn->query($sql) === TRUE) {
    // If the update is successful, send a success response
    echo json_encode(["success" => true]);
} else {
    // If there's an error, send an error response
    echo json_encode(["success" => false, "error" => $conn->error]);
}

// Close the database connection
$conn->close();
?>
