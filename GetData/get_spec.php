<?php
require('../config/db_connection.php'); // Make sure to include your database connection

if (isset($_POST['strandCode'])) {
    $strandCode = $_POST['strandCode'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT specializations.SpecializationID, specializations.Specialization
        FROM strands
        INNER JOIN specializations ON strands.SpecializationID = specializations.SpecializationID
        WHERE strands.StrandCode = ? AND strands.Active = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $strandCode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If there are specializations for the provided StrandCode
        // you can display the options
        echo '<option disabled selected>Select Specialization</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['SpecializationID'] . '">' . $row['Specialization'] . '</option>';
        }
    } else {
        // If there are no specializations for the provided StrandCode
        // display an appropriate message
        echo '<option disabled>No Specializations available for this strand</option>';
    }
}
?>
