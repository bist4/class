<?php
// Include your database connection file here
include('../../config/db_connection.php');

// Check if the 'track', 'yearLevel', and 'semester' parameters are set in the POST request
if (isset($_POST['track']) && isset($_POST['yearLevel']) && isset($_POST['semester'])) {
    // Assign values directly
    $track = $_POST['track'];
    $yearLevel = $_POST['yearLevel'];
    $semester = $_POST['semester'];

    // Query to fetch DepartmentID based on the selected track, yearLevel, and semester
    $query = "SELECT d.DepartmentID, s.StrandName 
                FROM strands s
                INNER JOIN departments d ON s.StrandID = d.StrandID
                WHERE s.StrandID = $track AND d.GradeLevel = $yearLevel AND d.Semester = $semester AND s.Active = 1";

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
