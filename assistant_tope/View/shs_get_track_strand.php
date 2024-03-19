<?php
// Include your database connection file here
include('../../config/db_connection.php');

// Check if the 'track' parameter is set in the POST request
if (isset($_POST['track'])) {
    // Sanitize the input to prevent SQL injection
    $track = mysqli_real_escape_string($conn, $_POST['track']);

    // Query to fetch strands based on the selected track
    $query = "SELECT DISTINCT StrandCode, StrandName FROM strands WHERE TrackTypeName = '$track'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Build the HTML options for the 'strand' dropdown
        $options = '<option value="" disabled selected>Select Strand</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $options .= '<option value="' . $row['StrandName'] . '">' . $row['StrandName'] . '</option>';
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
    // Handle the case where 'track' parameter is not set
    echo 'Invalid request';
}
?>
