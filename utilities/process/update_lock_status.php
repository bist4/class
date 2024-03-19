<?php
require('../../config/db_connection.php');

// Get the user ID and lock status from the AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userID']) && isset($_POST['lockStatus'])) {
    $userID = $_POST['userID'];
    $lockStatus = $_POST['lockStatus'];

    // Prepare and execute the SQL statement to update the lock_account field
    $sql = "UPDATE userinfo SET is_Lock_Account = ? WHERE UserInfoID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ii", $lockStatus, $userID);
        if ($stmt->execute()) {
            // If the update is successful, send a success response
            echo "Account updated successfully!";
            
            // Logging the activity
            session_start(); // Ensure the session is started
            if (isset($_SESSION['UserID'])) {
                $loggedInUserID = $_SESSION['UserID'];
                
                // Fetch the username of the user being unlocked
                $sqlUsername = "SELECT Username FROM userinfo WHERE UserInfoID = ?";
                $stmtUsername = $conn->prepare($sqlUsername);
                $stmtUsername->bind_param("i", $userID);
                $stmtUsername->execute();
                $resultUsername = $stmtUsername->get_result();
                $username = '';

                if ($resultUsername->num_rows > 0) {
                    $row = $resultUsername->fetch_assoc();
                    $username = $row['Username'];
                }

                // Prepare and execute the SQL statement to log the activity
                $activity = ($lockStatus == 1) ? "Account Locked for user: $username" : "Account Unlocked for user: $username";
                $currentDateTime = date('Y-m-d H:i:s');
                $active = 1;

                $sqlLog = "INSERT INTO logs (DateTime, Activity, UserInfoID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                $stmtLog = $conn->prepare($sqlLog);
                if ($stmtLog) {
                    $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                    if ($stmtLog->execute()) {
                        // If the insertion is successful, do something if needed
                    } else {
                        // If there's an error in the SQL execution
                        echo "Error inserting log: " . $stmtLog->error;
                    }
                    $stmtLog->close(); // Close the statement
                } else {
                    echo "Error in log statement preparation: " . $conn->error;
                }

            }
        } else {
            // If there's an error in the SQL execution
            echo "Error updating account: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error in SQL statement preparation: " . $conn->error;
    }
} else {
    // If the POST data is not set properly
    echo "Invalid request";
}

// Close the database connection
$conn->close();
?>
