<?php
// Include your database connection file here
include('../../config/db_connection.php');

// Check if the 'department' parameter is set in the POST request
if (isset($_POST['department'])) {
    // Sanitize the input to prevent SQL injection
    $department = $_POST['department'];

    // Prepare a parameterized query to fetch instructors based on the selected department
    $query = "SELECT DISTINCT Instructor FROM classschedule WHERE Department = ? AND Active = 2";

    // Initialize the statement
    $stmt = mysqli_prepare($conn, $query);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "s", $department);

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Get the result set
        $result = mysqli_stmt_get_result($stmt);

        // Check if the query was successful
        if ($result) {
            // Build the HTML options for the 'instructor' dropdown
            $options = '<option value="" disabled selected>Select Instructor</option>';
            while ($row = mysqli_fetch_assoc($result)) {
                $options .= '<option value="' . $row['Instructor'] . '">' . $row['Instructor'] . '</option>';
            }
            // Send the HTML options back to the client-side script
            echo $options;
        } else {
            // Handle the error if the query fails
            echo 'Error fetching data';
        }

        // Close the result set
        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where the statement preparation fails
        echo 'Statement preparation error';
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Handle the case where 'department' parameter is not set
    echo 'Invalid request';
}
?>
