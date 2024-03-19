<?php
require('../../config/db_connection.php');

if (isset($_POST['section'])) {
    $section = $_POST['section'];

    // Fetch distinct sections for the selected parameters
    $query = "SELECT DISTINCT Room FROM classschedule 
              WHERE Section = '$section' 
              AND Active = 2 
              AND Department = 'Primary'";

    $result = $conn->query($query);

    // Check for errors during the database operation
    if (!$result) {
        die("Error in fetching section data: " . $conn->error);
    }

    // Build the HTML options for the "section" dropdown
    $options = '<option value="" disabled selected>Select Room</option>';
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['Room'] . '">' . $row['Room'] . '</option>';
    }

    // Send the HTML options back to the client-side script
    echo $options;

    // Close the result set
    $result->close();
} else {
    echo '<option disabled selected>Select Strand, Semester, and Year Level first</option>';
}
?>

