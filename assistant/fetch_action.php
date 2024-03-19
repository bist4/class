<?php
// Include your database connection code here
require('../config/db_connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the Action value from the database
$sql = "SELECT Action FROM message WHERE Action = 3 OR Action = 5 LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Return the Action value as JSON
    $row = $result->fetch_assoc();
    echo json_encode(["action" => $row["Action"]]);
} else {
    // If no row is found, return a default value
    echo json_encode(["action" => -1]); // or any default value as needed
}

// Close the database connection
$conn->close();
?>
