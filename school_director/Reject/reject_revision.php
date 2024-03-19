<?php
// Include your database connection code here
require('../../config/db_connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $rejectionReason = mysqli_real_escape_string($conn, $_POST["rejectionReason"]);

    // Set UserFrom and UserTo values
    $fromUser = 2; // Assuming UserFrom value is 2
    $toUser = 3;   // Assuming UserTo value is 3

    $insertMessageSql = "INSERT INTO message (CreatedAt, UserFrom, UserTo, Action, Request, Message) 
    VALUES (NOW(), $fromUser, $toUser, 7, 'Rejected', '$rejectionReason')";

    // Update the Action in the message table where Action = 3
    $updateActionSql = "UPDATE message SET Action = 7 WHERE Action = 3";

    // Execute the insert query to add the approval message
    if ($conn->query($insertMessageSql) === TRUE) {
        echo "Reject message added successfully. ";
    } else {
        echo "Error adding approval message: " . $conn->error;
    }

    // Execute the update query to update the action status
    if ($conn->query($updateActionSql) === TRUE) {
        echo "Action updated successfully";
    } else {
        echo "Error updating action: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
