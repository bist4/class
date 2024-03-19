<?php
require('../../config/db_connection.php');

if (isset($_POST['instructor'])) {
    $instructor = $_POST['instructor'];

    // Fetch distinct sections for the selected parameters and order by the day of the week
    $query = "SELECT DISTINCT Day FROM classschedule 
              WHERE Instructor = '$instructor' 
              AND Active = 1 
              ORDER BY FIELD(Day, 'M', 'T', 'W', 'TH', 'F')";

    $result = $conn->query($query);

    // Check for errors during the database operation
    if (!$result) {
        die("Error in fetching section data: " . $conn->error);
    }

    // Map day abbreviations to full names
    $dayMapping = [
        'M' => 'Monday',
        'T' => 'Tuesday',
        'W' => 'Wednesday',
        'TH' => 'Thursday',
        'F' => 'Friday',
        // Add more as needed
    ];

    // Build the HTML options for the "section" dropdown
    $options = '<option value="" disabled selected>Select Day</option>';
    while ($row = $result->fetch_assoc()) {
        $dayAbbreviation = $row['Day'];
        $dayFullName = $dayMapping[$dayAbbreviation] ?? $dayAbbreviation; // Use the mapping or the abbreviation if not found
        $options .= '<option value="' . $dayAbbreviation . '">' . $dayFullName . '</option>';
    }

    // Send the HTML options back to the client-side script
    echo $options;

    // Close the result set
    $result->close();
} else {
    echo '<option disabled selected>Select Strand, Semester, and Year Level first</option>';
}
?>
