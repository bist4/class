<?php
// Assuming you have a database connection established already
session_start();
// Check if the request contains the required parameter
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require('../../config/db_connection.php'); // Adjust the path to your database connection file

if (isset($_POST['instructorID'])) {
    // Sanitize the input to prevent SQL injection
    $instructorID = $_POST['instructorID'];

    // Update the Active field in the instructors table
    $sql = "UPDATE instructors SET Active = 11 WHERE InstructorID = $instructorID";

    if ($conn->query($sql) === TRUE) {
        // Success response
        echo "Instructor archived successfully.";
    } else {
        // Error response
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If instructorID is not provided
    echo "Error: Instructor ID is not provided.";
}



// Close database connection
$conn->close();
}
?>
