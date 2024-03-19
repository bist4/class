<?php
require('../config/db_connection.php');

if (isset($_POST['strand'])) {
    $strandCode = $_POST['strand'];

    // SQL query to select Specialization from specializations based on StrandCode
    $sql = "SELECT s.Specialization
            FROM specializations s
            INNER JOIN strands st ON s.SpecializationID = st.SpecializationID
            WHERE st.StrandCode = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $strandCode);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['SpecializationID'] . '">' . $row['Specialization'] . '</option>';
        }
    } else {
        echo '<option disabled>No Specialization available for this selection</option>';
    }

    $stmt->close();
} else {
    echo '<option disabled selected>Select StrandCode first</option>';
}
?>
