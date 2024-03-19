<?php
// Include your database connection file here
include('../../config/db_connection.php');

// Check if the 'yearLevel' and 'section' parameters are set in the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the inputs to prevent SQL injection
    $yearLevel = $_POST['yearLevel'];
    $section = $_POST['section'];
    $selectedSubject = $_POST['subject'];
    
    // Use prepared statements to prevent SQL injection
    $query = "SELECT DISTINCT s.SubjectID, s.SubjectName, s.MinutesPerWeek FROM subjects s
              INNER JOIN departments d ON s.DepartmentID = d.DepartmentID
              WHERE d.DepartmentID = ?";

    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "i", $yearLevel); // One integer parameter

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the result set
    $result = mysqli_stmt_get_result($stmt);

    // Check if the query was successful
    if ($result) {
        // Build the HTML options for the 'Subject' dropdown
        $options = '<option value="" disabled selected>Select Subject</option>';

        // Loop through the results
        while ($row = mysqli_fetch_assoc($result)) {
            // Retrieve subject ID
            $subjectID = $row['SubjectID'];

            // Query to calculate total duration for the subject
            $duration_query = "SELECT SUM(
                                    TIME_TO_SEC(TIMEDIFF(Time_End, Time_Start)) *
                                    (is_Monday + is_Tuesday + is_Wednesday + is_Thursday + is_Friday)
                                ) AS total_duration 
                               FROM classschedules 
                               WHERE SubjectID = ? AND SectionID = ?";

            $duration_stmt = mysqli_prepare($conn, $duration_query);

            // Bind parameter
            mysqli_stmt_bind_param($duration_stmt, "ii", $subjectID, $section);

            // Execute the query
            mysqli_stmt_execute($duration_stmt);

            // Get the result set
            $duration_result = mysqli_stmt_get_result($duration_stmt);

            // Fetch total duration for the subject
            $duration_row = mysqli_fetch_assoc($duration_result);
            $total_duration_minutes = floor($duration_row['total_duration'] / 60);
            $available = $row['MinutesPerWeek'] - $total_duration_minutes;

            // // Check if total duration exceeds or equals units
            // if ($total_duration_minutes < $row['MinutesPerWeek']) {
            //     // Append option to dropdown
            //     // $options .= '<option value="' . $row['SubjectID'] . '">' . $row['SubjectName'] . ' ' . '('.$available . $resulttotal .  'minutes available)</option>';
            //     $options .= '<option value="' . $row['SubjectID'] . '">' . $row['SubjectName'] . ' ('.$available . ' minutes available, '.$totalresult.' total minutes)</option>';
            // }
            if ($total_duration_minutes < $row['MinutesPerWeek']) {
                if ($_POST['subject'] == $subjectID) {
                    $options .= '<option value="' . $row['SubjectID'] . '">' . $row['SubjectName'] . ' ' . '('.$available .  'minutes available)</option>';
                } else {
                    $options .= '<option value="' . $row['SubjectID'] . '">' . $row['SubjectName'] . ' ' . '('.$available .  'minutes available)</option>';
                }
            }

            // Close the statement
            mysqli_stmt_close($duration_stmt);
        }

        // Send the HTML options back to the client-side script
        echo $options;
    } else {
        // Handle the error if the query fails
        echo 'Error fetching data';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Handle the case where 'yearLevel' or 'section' parameters are not set
    echo 'Invalid request';
}

// Close the database connection
mysqli_close($conn);
?>
