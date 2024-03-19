<?php
session_start();
include('config/db_connection.php');

if (isset($_POST['logout_btn'])) {
    if (isset($_SESSION['Username'])) {
        // Fetch the logout time from logs table
        $logUserID = $_SESSION['UserID'];
        $fetch_log_sql = "SELECT DateTime FROM logs WHERE UserInfoID = '$logUserID' AND Activity LIKE '%logged out%' ORDER BY CreatedAt DESC LIMIT 1";
        $result = mysqli_query($conn, $fetch_log_sql);
        
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $logout_time = strtotime($row['DateTime']);
            $current_time = time();
            $time_difference = $current_time - $logout_time;

            // Display logout time dynamically
            $time_ago = "";
            if ($time_difference < 60) {
                $time_ago = "few seconds ago";
            } elseif ($time_difference >= 60 && $time_difference < 3600) {
                $minutes = floor($time_difference / 60);
                $time_ago = $minutes == 1 ? "1 minute ago" : "$minutes minutes ago";
            } elseif ($time_difference >= 3600 && $time_difference < 86400) {
                $hours = floor($time_difference / 3600);
                $time_ago = $hours == 1 ? "1 hour ago" : "$hours hours ago";
            } else {
                $days = floor($time_difference / 86400);
                $time_ago = $days == 1 ? "1 day ago" : "$days days ago";
            }

            // Log user logout activity with logout time displayed
            $logDateTime = date('Y-m-d H:i:s');
            $logActivity = 'User ' . $_SESSION['Username'] . ' logged out ' . $time_ago;
            $logUserID = $_SESSION['UserInfoID'];
            $logActive = 0; // Assuming '0' represents an inactive status in the logs

            // Prepare and execute the SQL statement to insert the log
            $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
            if ($stmt = mysqli_prepare($conn, $sqlLog)) {
                mysqli_stmt_bind_param($stmt, "ssii", $logDateTime, $logActivity, $logUserID, $logActive);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                // Handle the case where the log insertion fails
                // Example: echo "Error inserting log: " . mysqli_error($conn);
            }
        }

        // Update the login status to '0' (offline) in the database
        $user_id = $_SESSION['UserID'];
        $update_sql = "UPDATE userinfo SET is_Login = 0 WHERE UserInfoID = '$user_id'";
        mysqli_query($conn, $update_sql);
    }

    // Destroy the session and redirect to login page
    session_destroy();
    unset($_SESSION['Username']);
    header("Location: login_form.php");
    exit();
}
?>
