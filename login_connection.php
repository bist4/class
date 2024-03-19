<?php
session_start(); // Start the session

include('security.php');
require('config/db_connection.php');

if (isset($_POST['username']) && isset($_POST['password'])) {

    // Initialize a counter for failed login attempts
    $failedAttempts = 0;

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username) && empty($password)) {
        header("Location: login_form.php?error=Username and Password are required");
        exit();
    } elseif (empty($username)) {
        header("Location: login_form.php?error=Username is required");
        exit();
    } elseif (empty($password)) {
        header("Location: login_form.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM userinfo WHERE Username='$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['Password'])) {
                // Password is correct, proceed with the login logic.
                $failedAttempts = 0;

                // Check if the user has multiple roles
                if (($row['is_SchoolDirector'] == 1 && $row['is_Instructor'] == 1 && $row['is_SchoolDirectorAssistant'] == 1 && $row['UserTypeID'] == 1) ||
                    ($row['is_SchoolDirector'] == 1 && $row['is_Instructor'] == 1 && $row['is_SchoolDirectorAssistant'] == 1 && $row['UserTypeID'] == 2) ||
                    ($row['is_SchoolDirector'] == 1 && $row['is_Instructor'] == 1) ||
                    ($row['is_SchoolDirector'] == 1 && $row['is_SchoolDirectorAssistant'] == 1 && $row['UserTypeID'] == 1) ||
                    ($row['is_SchoolDirector'] == 1 && $row['is_SchoolDirectorAssistant'] == 1 && $row['UserTypeID'] == 2) ||
                    ($row['is_Instructor'] == 1 && $row['is_SchoolDirectorAssistant'] == 1 && $row['UserTypeID'] == 1) ||
                    ($row['is_Instructor'] == 1 && $row['is_SchoolDirectorAssistant'] == 1 && $row['UserTypeID'] == 2)) {
                    // User has multiple roles
                    $_SESSION['Username'] = $username;
                    $_SESSION['UserInfoID'] = $row['UserInfoID'];
                    $_SESSION['Active_Time'] = time();

                    // Update the login column in userinfo table
                    $updateLogin = "UPDATE userinfo SET is_Login = 1 WHERE UserInfoID = " . $row['UserInfoID'];
                    mysqli_query($conn, $updateLogin);

                    header("Location: dashboard.php");
                    exit();
                } 
                elseif ($row['UserTypeID'] == 3) {
                    // Administrator
                    $_SESSION['Username'] = $username;
                    $_SESSION['UserInfoID'] = $row['UserInfoID'];
                    $_SESSION['Active_Time'] = time();

                    // Log the login activity
                    $logActivity = "INSERT INTO logs (DateTime, Activity, UserInfoID, Active, CreatedAt) 
                        VALUES (NOW(), 'Login as Administrator', " . $row['UserInfoID'] . ", 1, NOW())";
                    mysqli_query($conn, $logActivity);

                    // Update the login column in userinfo table
                    $updateLogin = "UPDATE userinfo SET is_Login = 1 WHERE UserInfoID = " . $row['UserInfoID'];
                    mysqli_query($conn, $updateLogin);

                    header("Location: super_user.php");
                    exit();
                }
                elseif ($row['UserTypeID'] == 2) {
                    // Administrator
                    $_SESSION['Username'] = $username;
                    $_SESSION['UserInfoID'] = $row['UserInfoID'];
                    $_SESSION['Active_Time'] = time();

                    // Log the login activity
                    $logActivity = "INSERT INTO logs (DateTime, Activity, UserInfoID, Active, CreatedAt) 
                        VALUES (NOW(), 'Login as Administrator', " . $row['UserInfoID'] . ", 1, NOW())";
                    mysqli_query($conn, $logActivity);

                    // Update the login column in userinfo table
                    $updateLogin = "UPDATE userinfo SET is_Login = 1 WHERE UserInfoID = " . $row['UserInfoID'];
                    mysqli_query($conn, $updateLogin);

                    header("Location: system_admin.php");
                    exit();
                }
                 elseif ($row['is_SchoolDirector'] == 1) {
                    // Administrator
                    $_SESSION['Username'] = $username;
                    $_SESSION['UserInfoID'] = $row['UserInfoID'];
                    $_SESSION['Active_Time'] = time();

                    // Log the login activity
                    $logActivity = "INSERT INTO logs (DateTime, Activity, UserInfoID, Active, CreatedAt) 
                        VALUES (NOW(), 'Login as Administrator', " . $row['UserInfoID'] . ", 1, NOW())";
                    mysqli_query($conn, $logActivity);

                    // Update the login column in userinfo table
                    $updateLogin = "UPDATE userinfo SET is_Login = 1 WHERE UserInfoID = " . $row['UserInfoID'];
                    mysqli_query($conn, $updateLogin);

                    header("Location: school_director.php");
                    exit();
                } elseif ($row['is_Instructor'] == 1) {
                    // Instructor
                    $_SESSION['Username'] = $username;
                    $_SESSION['UserInfoID'] = $row['UserInfoID'];
                    $_SESSION['Active_Time'] = time();

                    // Log the login activity
                    $logActivity = "INSERT INTO logs (DateTime, Activity, UserInfoID, Active, CreatedAt) 
                        VALUES (NOW(), 'Login as Instructor', " . $row['UserInfoID'] . ", 1, NOW())";
                    mysqli_query($conn, $logActivity);

                    // Update the login column in userinfo table
                    $updateLogin = "UPDATE userinfo SET is_Login = 1 WHERE UserInfoID = " . $row['UserInfoID'];
                    mysqli_query($conn, $updateLogin);

                    header("Location: instructor.php");
                    exit();
                } elseif ($row['is_SchoolDirectorAssistant'] == 1) {
                    // School Director Assistant
                    $_SESSION['Username'] = $username;
                    $_SESSION['UserInfoID'] = $row['UserInfoID'];
                    $_SESSION['Active_Time'] = time();

                    // Log the login activity
                    $logActivity = "INSERT INTO logs (DateTime, Activity, UserInfoID, Active, CreatedAt) 
                        VALUES (NOW(), 'Login as School Director Assistant', " . $row['UserInfoID'] . ", 1, NOW())";
                    mysqli_query($conn, $logActivity);

                    // Update the login column in userinfo table
                    $updateLogin = "UPDATE userinfo SET is_Login = 1 WHERE UserInfoID = " . $row['UserInfoID'];
                    mysqli_query($conn, $updateLogin);

                    header("Location: assistant.php");
                    exit();
                }
            } else {
                // Incorrect password
                $failedAttempts++;

                // Check if the account should be locked
                if ($failedAttempts >= 3) {
                    // Lock the account for a specified duration (e.g., 5 minutes)
                    $lockDuration = 300; // 5 minutes in seconds
                    $lockTimestamp = time() + $lockDuration;
                    $updateLockSql = "UPDATE userinfo SET lock_account = 1, lock_timestamp = $lockTimestamp WHERE UserInfoID = " . $row['UserInfoID'];
                    mysqli_query($conn, $updateLockSql);

                    // Account is locked
                    header("Location: login_form.php?error=Account is locked for 5 minutes.");
                    exit();
                }
                header("Location: login_form.php?error=Incorrect User name or password");
                exit();
            }
        } else {
            // No user found with the given username
            header("Location: login_form.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("Location: login_form.php");
    exit();
}
?>
