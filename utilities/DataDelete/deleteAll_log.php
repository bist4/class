<?php
require('../../config/db_connection.php');

// Update the Active status in the logs table
$sqlUpdateAllLogs = "UPDATE logs SET Active = 10 WHERE Active = 0";

if ($conn->query($sqlUpdateAllLogs) === TRUE) {
    // Update was successful
    echo "All logs updated successfully.";
} else {
    // Update failed
    echo "Error updating logs: " . $conn->error;
}
?>
