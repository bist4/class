<?php
// Your database connection code
require('../../config/db_connection.php');

// Perform the SQL query to empty the class schedule based on Year Level and Section
$sql = "DELETE FROM classschedule WHERE  Active = 0";
if ($conn->query($sql) === TRUE) {
    echo 'Class schedule successfully emptied.';
} else {
    echo 'Error emptying class schedule: ' . $conn->error;
}

// Close the database connection
$conn->close();
?>
