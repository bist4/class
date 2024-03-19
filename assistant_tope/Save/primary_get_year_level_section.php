<?php
require('../../config/db_connection.php');

if (isset($_POST['yearLevel'])) {
    $yearLevel = $_POST['yearLevel'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT DISTINCT cs.SectionID, s.SectionName FROM classschedule cs
              INNER JOIN department d ON cs.DepartmentID = d.DepartmentID
              INNER JOIN sections s ON cs.SectionID = s.SectionID
              WHERE d.DepartmentID = ? 
              AND cs.Active = 0";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $yearLevel);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check for errors during the database operation
    if (!$result) {
        die("Error in fetching section data: " . $conn->error);
    }

    // Build the HTML options for the "section" dropdown
    $options = '<option value="" disabled selected>Select Section</option>';
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['SectionID'] . '">' . $row['SectionName'] . '</option>';
    }

    // Send the HTML options back to the client-side script
    echo $options;

    // Close the result set and statement
    $result->close();
    $stmt->close();
} else {
    echo '<option disabled selected>Select Strand, Semester, and Year Level first</option>';
}
?>
