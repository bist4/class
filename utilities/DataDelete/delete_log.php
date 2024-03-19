<?php
require('../../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['LogID'])) {
    $logID = $_POST['LogID'];
    
    // Update the Active status in the logs table
    $sqlUpdateActive = "UPDATE logs SET Active = 0 WHERE LogID = ?";
    $stmtUpdateActive = $conn->prepare($sqlUpdateActive);
    $stmtUpdateActive->bind_param("i", $logID);

    if ($stmtUpdateActive->execute()) {
        // Update was successful
        echo "Log deleted successfully.";
        
    } else {
        // Update failed
        echo "Error deleting log " . $conn->error;
    }

    // Close the prepared statement
    $stmtUpdateActive->close();
} else {
    echo "Invalid request.";
}
?>
