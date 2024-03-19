<?php
// Include your database connection file here
include('../../config/db_connection.php');

// Check if the 'strandCode' parameter is set in the POST request
if (isset($_POST['strandCode'])) {
    // Sanitize the input to prevent SQL injection
    $strandCode = mysqli_real_escape_string($conn, $_POST['strandCode']);

    // Query to fetch strands based on the selected strandCode
    $query = "SELECT DISTINCT SpecializationID, Specialization, Code FROM specializations WHERE Code = '$strandCode'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Build the HTML options for the 'strand' dropdown
        $options = '<option value="" disabled selected>Select Strand</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $options .= '<option value="' . $row['Specialization'] . '">' . $row['Specialization'] . '</option>';
        }

        // Send the HTML options back to the client-side script
        echo $options;
    } else {
        // Handle the error if the query fails
        echo 'Error fetching data';
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Handle the case where 'strandCode' parameter is not set
    echo 'Invalid request';
}
?>

