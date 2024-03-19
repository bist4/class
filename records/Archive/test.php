<?php
// Establish database connection
require('../../config/db_connection.php');
session_start();

// Check if instructorIDs are set and not empty
if (isset($_POST['instructorIDs']) && !empty($_POST['instructorIDs'])) {
    $instructorIDs = $_POST['instructorIDs'];

    // Loop through each Instructor ID and perform archiving
    foreach ($instructorIDs as $instructorID) {
        // Example: Updating instructor record
        $sql = "UPDATE users SET Active = 11 WHERE UserID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $instructorID);

        if ($stmt->execute()) {
            // Example of logging the activity (modify as needed)
            $activity = 'Archived Instructor'; // Modify this line to include the instructor's name
            $currentDateTime = date('Y-m-d H:i:s');
            $active = 1;

            // Add instructor name to the activity log
            $instructorDetailsQuery = "SELECT Fname, Lname FROM users WHERE UserID = ?";
            $stmtDetails = $conn->prepare($instructorDetailsQuery);
            $stmtDetails->bind_param('i', $instructorID);
            $stmtDetails->execute();
            $result = $stmtDetails->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $fname = $row['Fname'];
                $lname = $row['Lname'];
                $activity .= ': ' . $fname . ' ' . $lname;
            }

            // Insert into logs
            $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
            $stmtLog = $conn->prepare($sqlLog);
            if ($stmtLog) {
                $loggedInUserID = isset($_SESSION['UserID']) ? $_SESSION['UserID'] : null;
                $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                $stmtLog->execute();
                $stmtLog->close();
            } else {
                // Handle log statement preparation error
                echo "error";
                exit;
            }
            $stmtDetails->close();
        } else {
            // If the update query fails
            echo "error"; // Send an error message back to AJAX call
            exit;
        }
    }

    // At the end, if all went well:
    echo "success";
} else {
    echo "error"; // Send an error message back to AJAX call if IDs are not received
}
?>
