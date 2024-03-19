<?php
session_start();
include('security.php');
require('config/db_connection.php');

// Check if the user is already logged in
if (isset($_SESSION['Username'])) {
    // Fetch the RoleID from the users table for the logged-in user
    $username = $_SESSION['Username'];
    
    // $sql = "SELECT usr.RoleID FROM userroles usr
    // INNER JOIN userinfo usi ON usr.UserID = usi.UserInfoID 
    // WHERE Username = '$username'";

    $sql = "SELECT * FROM userinfo WHERE Username = '$username'";

 
    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $role = [
            $row['is_Instructor'],
            $row['is_SchoolDirector'],
            $row['is_SchoolDirectorAssistant']
        ];

        $positionRole = '';

        $admin = $row['UserTypeID'];

        $role = [
            $row['is_Instructor'],
            $row['is_SchoolDirector'],
            $row['is_SchoolDirectorAssistant']
        ];
        
        $admin = $row['UserTypeID'];
        
        if ($role[0] == 1) {
            header("Location: instructor.php");
            exit();
        } elseif ($role[1] == 1) {
            header("Location: school_director.php");
            exit();
        } elseif ($role[2] == 1) {
            header("Location: assistant.php");
            exit();
        } elseif ($admin == 2) {
            header("Location: system_admin.php");
            exit();
        } else {
            // Handle any other cases, or redirect to a default page
            header("Location: login_connection.php");
            exit();
        }
        

      
        exit();
    } else {
        // Handle query error
        header("Location: login_connection.php?error=Database error");
        exit();
    }
}
?>

