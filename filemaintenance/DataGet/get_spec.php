<!-- <?php
// Database connection
require('../../config/db_connection.php');

// SQL query to fetch data
$sqlSpecializations = "SELECT DISTINCT Specialization FROM instructor"; // Assuming Specialization is the correct column name
$resultSpecializations = $conn->query($sqlSpecializations);

// Initialize the $specializations array
$specializations = array();

// Fetch the specializations and add them to the array
if ($resultSpecializations->num_rows > 0) {
    while ($row = $resultSpecializations->fetch_assoc()) {
        // Add each specialization to the array
        $specializations[] = $row['Specialization'];
    }
}

// Close the database connection
$conn->close();

// Return the specializations as a JSON response
echo json_encode($specializations);
?> -->
