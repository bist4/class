<?php
session_start();
require('../config/db_connection.php');

if (isset($_SESSION['UserID'])) {
    $loggedInUserID = $_SESSION['UserID'];

    // Check if the "Show All Notifications" link was clicked
    $showAll = isset($_GET['show_all']) && $_GET['show_all'] === 'true';

    // Retrieve and display notifications
    $sqlNotifications = "SELECT NotificationID, Message, CreatedAt FROM notifications WHERE UserID = ? ORDER BY CreatedAt DESC";
    
    if (!$showAll) {
        // Limit to displaying only the first 3 notifications
        $sqlNotifications .= " LIMIT 3";
    }

    $stmtNotifications = $conn->prepare($sqlNotifications);
    $stmtNotifications->bind_param("i", $loggedInUserID);
    $stmtNotifications->execute();
    $resultNotifications = $stmtNotifications->get_result();

    if ($resultNotifications->num_rows > 0) {
        while ($row = $resultNotifications->fetch_assoc()) {
            echo '<a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-bell text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">' . $row['CreatedAt'] . '</div>
                    ' . $row['Message'] . '
                </div>
            </a>';
        }

        // Show "Show All Notifications" link if there are more notifications to display
        if ($resultNotifications->num_rows > 3) {
            echo '<a class="dropdown-item text-center small text-gray-500" href="?show_all=true">Show All Notifications</a>';
        }
    } else {
        echo '<a class="dropdown-item d-flex align-items-center" href="#">No new notifications</a>';
    }
}
?>
