<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["role"])) {
        $role = $_POST["role"];

        // Redirect the user based on their selected role
        switch ($role) {
            case '1':
                header("Location: system_admin.php");
                exit();
            case '2':
                header("Location: school_director.php");
                exit();
            case '3':
                header("Location: assistant.php");
                exit();
            case '4':
                header("Location: instructor.php");
                exit();
            // Additional roles handling omitted for brevity
            default:
                // If an invalid role is selected, redirect to login_form.php
                header("Location: login_form.php?error=Invalid role selection");
                exit();
        }
    } else {
        // If role is not set, redirect to login_form.php with an error message
        header("Location: login_form.php?error=Role not selected");
        exit();
    }
} else {
    // If the request method is not POST, redirect to login_form.php with an error message
    header("Location: login_form.php?error=Invalid request method");
    exit();
}
?>
