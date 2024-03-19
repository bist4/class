<?php
// Include your database connection file here
include('../../config/db_connection.php');

// Check if the 'track', 'yearLevel', and 'semester' parameters are set in the POST request
if (isset($_POST['yearLevel']) && isset($_POST['semester'])) {
    $yearLevel = $_POST['yearLevel'];
    $semester = $_POST['semester'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT DISTINCT cs.DepartmentID, s.StrandName FROM classschedules cs
              INNER JOIN departments d ON cs.DepartmentID = d.DepartmentID
              INNER JOIN strands s ON s.StrandID = d.StrandID
              WHERE d.GradeLevel = $yearLevel AND d.Semester = $semester 
              AND cs.Active = 2";

    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Build the HTML options for the 'strand' dropdown
        $options = '<option value="" disabled selected>Select Strand</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $options .= '<option value="' . $row['DepartmentID'] . '">' . $row['StrandName'] . '</option>';
        }

        // Send the HTML options back to the client-side script
        echo $options;
    } else {
        // Handle the error if the query fails
        echo 'Error fetching data: ' . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Handle the case where 'track', 'yearLevel', or 'semester' parameters are not set
    echo 'Invalid request';
}
?>
