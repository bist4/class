<?php
// Include your database connection file
require "../config/db_connection.php";

if (isset($_GET['departmentValue'])) {
    $departmentValue = $_GET['departmentValue'];

    // Modify the SQL query to fetch instructors associated with the selected DepartmentTypeName
    $sqlInst = "SELECT * FROM instructor WHERE DepartmentID = ?";
    
    // Prepare and bind the parameter to prevent SQL injection
    $stmt = $conn->prepare($sqlInst);
    $stmt->bind_param("s", $departmentValue);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['InstructorID'] . '">' . $row['Fname'] . ' ' . $row['Mname'] . ' ' . $row['Lname'] . '</option>';
        }
    } else {
        echo '<option value="" disabled>No instructors found</option>';
    }
}
?>
