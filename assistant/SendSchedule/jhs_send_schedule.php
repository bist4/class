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
    $yearLevel = $_POST["yearLevel"];
    $section = $_POST["section"];

    // Update the Active column in the database
    $sql = "UPDATE classschedules SET Active = 2 WHERE DepartmentID = '$yearLevel' AND SectionID = '$section' AND Active = 0";

    // Initialize response array
    $response = [];

    if ($conn->query($sql) === TRUE) {
        // If the update is successful, set success to true
        $response["success"] = true;
        $response["message"] = "Update successful";
    } else {
        // If there's an error, set success to false and include the error message
        $response["success"] = false;
        $response["error"] = $conn->error;
    }

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    // Close the database connection
    $conn->close();
} else {
    // If it's not a POST request, handle accordingly (e.g., show an error message)
    echo json_encode(["success" => false, "error" => "Invalid request"]);
}
?>
