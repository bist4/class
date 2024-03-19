<?php
require('../../config/db_connection.php');
session_start();

// Check connection
if ($conn->connect_error) {
    $response['error'] = "Connection failed: " . $conn->connect_error;
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if data is set and not empty
    if (!isset($_POST['specializations']) || !isset($_POST['InstructorID'])) {
        $response['error'] = "Form data missing";
        echo json_encode($response);
        exit;
    }
    
    // Collect form data
    $specializations = $_POST['specializations'];
    $instructorIDs = $_POST['InstructorID'];

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO instructorspecializations (InstructorID, SpecializationName) VALUES (?, ?)");
    $stmt->bind_param("ss", $instructorID, $specialization);

    // Insert new records
    $response = array();
    foreach ($instructorIDs as $index => $instructorID) {
        // Escape special characters
        $instructorID = htmlspecialchars($instructorID);
        $specialization = htmlspecialchars($specializations[$index]);

        // Execute the statement
        if ($stmt->execute()) {
            $response['success'] = "Records inserted successfully";
        } else {
            $response['error'] = "Error inserting instructor record: " . $conn->error;
            echo json_encode($response);
            $stmt->close();
            $conn->close();
            exit;
        }
    }
    
    // Close statement
    $stmt->close();

    // Return success response
    echo json_encode($response);
}

// Close connection
$conn->close();
?>
