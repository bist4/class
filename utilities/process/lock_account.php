<?php
require('../../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Update the lock_account field for the specified user
    $query = "UPDATE userinfo SET is_Lock_Account = 1 WHERE UserInfoID = ?";

    $stmt = $conn->prepare($query);

    if ($stmt) {    
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);

            // Logging the activity
            session_start(); // Ensure the session is started
            if (isset($_SESSION['UserID'])) {
                $loggedInUserID = $_SESSION['UserID'];

                $sqlUserCheck = "SELECT UserInfoID FROM userinfo WHERE UserInfoID = ?";
                $stmtUserCheck = $conn->prepare($sqlUserCheck);
                $stmtUserCheck->bind_param("i", $loggedInUserID);
                $stmtUserCheck->execute();
                $resultUserCheck = $stmtUserCheck->get_result();

                $lockStatus = 1; // Set the lock status to 1 (account locked)

                // Get the username of the user being locked
                $getUsernameQuery = "SELECT Username FROM userinfo WHERE UserInfoID = ?";
                $stmtUsername = $conn->prepare($getUsernameQuery);
                $stmtUsername->bind_param("i", $userId);
                $stmtUsername->execute();
                $resultUsername = $stmtUsername->get_result();
                $username = '';

                if ($resultUsername->num_rows > 0) {
                    $row = $resultUsername->fetch_assoc();
                    $username = $row['Username'];
                }

                if ($resultUserCheck->num_rows > 0) {
                    $activity = "Account locked for user: " . $username;
                    $insertLogQuery = "INSERT INTO logs (DateTime, Activity, UserInfoID, Active, CreatedAt) VALUES (NOW(), ?, ?, 1, NOW())";
                    $stmtInsertLog = $conn->prepare($insertLogQuery);
                    $stmtInsertLog->bind_param("si", $activity, $loggedInUserID); // Corrected binding
                    if ($stmtInsertLog->execute()) {
                        $stmtInsertLog->close();
                    } else {
                        echo json_encode(['success' => false, 'error' => $stmtInsertLog->error]);
                    }
                }
                // Insert activity log into logs table
                
            }
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>
