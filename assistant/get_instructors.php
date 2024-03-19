<?php
// Include the database connection file
require('../config/db_connection.php');

// Fetch the list of instructors
$instructorQuery = "SELECT DISTINCT Fname, Lname FROM instructor WHERE Active = 1";
$instructorResult = $conn->query($instructorQuery);

if ($instructorResult->num_rows > 0) {
    echo '<select id="instructorDropdown">';
    echo '<option value="" disabled selected>Select Instructor</option>';

    while ($row = $instructorResult->fetch_assoc()) {
        // Echo the option for each instructor
        echo '<option value="' . $row['Fname'] . ' ' . $row['Lname'] . '">' . $row['Fname'] . ' ' . $row['Lname'] . '</option>';
    }

    echo '</select>';
} else {
    echo 'No instructors found.';
}

// Close the database connection
$conn->close();
?>
