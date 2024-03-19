<?php
// Include your database connection code here
require('../../config/db_connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Set UserFrom and UserTo values
    $fromUser = 3; // Assuming UserFrom value is 2
    $toUser = 2;   // Assuming UserTo value is 3

    // Use NOW() to get the current timestamp
    $insertMessageSql = "INSERT INTO message (CreatedAt, UserFrom, UserTo, Action, Request) 
                         VALUES (NOW(), $fromUser, $toUser, 9, 'Finish Revision')";

    // Perform insert operation
    if ($conn->query($insertMessageSql) === TRUE) {
        // If the message insertion is successful, update existing messages
        $updateMessageSql = "UPDATE message SET Action = 9 WHERE Request = 'Approved' AND Action = 5 AND UserFrom = 2";
        // Perform update operation
        if ($conn->query($updateMessageSql) === TRUE) {
            // If the update operation is successful, send a success response
            echo json_encode(["success" => true]);
        } else {
            // If there's an error in the update operation, send an error response with debug information
            echo json_encode(["success" => false, "error" => $conn->error, "updateMessageSql" => $updateMessageSql]);
        }
    } else {
        // If there's an error in message insertion, send an error response with debug information
        echo json_encode(["success" => false, "error" => $conn->error, "insertMessageSql" => $insertMessageSql]);
    }
}

// Close the database connection
$conn->close();
?>
