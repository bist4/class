<?php

// Include your database connection code here
require('../../config/db_connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the POST request
    $yearLevel = mysqli_real_escape_string($conn, $_POST["yearLevel"]);
    $section = mysqli_real_escape_string($conn, $_POST["section"]);

    // Update the Active column in the database
    $updateSql = "UPDATE classschedule SET Active = 2 WHERE YearLevel = '$yearLevel' AND Section = '$section' AND Active = 0";

    if ($conn->query($updateSql) === TRUE) {
        // Set UserFrom and UserTo values
        $fromUser = 3; // Assuming UserFrom value is 2
        $toUser = 2;   // Assuming UserTo value is 3

        // Use NOW() to get the current timestamp
        $insertMessageSql = "INSERT INTO message (CreatedAt, UserFrom, UserTo, YearLevel, Section, Action) 
                             VALUES (NOW(), $fromUser, $toUser, '$yearLevel', '$section', 2)";

        if ($conn->query($insertMessageSql) === TRUE) {
            // If the message insertion is successful, send a success response
            echo json_encode(["success" => true]);
        } else {
            // If there's an error in message insertion, send an error response with debug information
            echo json_encode(["success" => false, "error" => $conn->error, "insertMessageSql" => $insertMessageSql]);
        }
    } else {
        // If there's an error in classschedule update, send an error response
        echo json_encode(["success" => false, "error" => $conn->error, "updateSql" => $updateSql]);
    }
}

// Close the database connection
$conn->close();
?>
