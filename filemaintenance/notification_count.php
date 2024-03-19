<?php
session_start();
require('../config/db_connection.php');

if (isset($_SESSION['UserID'])) {
    $loggedInUserID = $_SESSION['UserID'];

    // Query the database to get the count of notifications for the logged-in user
    $sql = "SELECT COUNT(*) AS notification_count FROM notifications WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $loggedInUserID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        echo $row['notification_count'];
    } else {
        echo "0";
    }
} else {
    echo "0";
}
?>
