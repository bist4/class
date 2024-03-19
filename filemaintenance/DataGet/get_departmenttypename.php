<?php
// Database connection
require('../../config/db_connection.php');

// SQL query to fetch data
$sqlDepartmentType = "SELECT * FROM departmenttypename";
$resultDepartmentType = $conn->query($sqlDepartmentType);

// Initialize the $DepartmentTypeName array
$DepartmentTypeName = array();

// Fetch the department type name and add them to the array
if ($resultDepartmentType->num_rows > 0) {
    while ($row = $resultDepartmentType->fetch_assoc()) {
        // Add each department type to the array
        $DepartmentTypeName[$row['DepartmentTypeNameID']] = $row['DepartmentTypeName'];
    }
}

// Close the database connection
$conn->close();

// Return the department type name as a JSON response
echo json_encode($DepartmentTypeName);
?>
