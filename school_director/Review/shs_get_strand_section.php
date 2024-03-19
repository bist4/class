<?php
require('../../config/db_connection.php');

if (isset($_POST['strand'])) {
    $strand = $_POST['strand'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT DISTINCT cs.SectionID, s.SectionName FROM classschedules cs
              INNER JOIN departments d ON cs.DepartmentID = d.DepartmentID
              INNER JOIN classsections s ON cs.SectionID = s.SectionID
              WHERE d.DepartmentID = ? 
              AND cs.Active = 2";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $strand);
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
