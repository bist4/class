<?php
require('../../config/db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get data from AJAX request
    $username = $_POST['username'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];

    // Retrieve hashed password from the database based on the username
    $selectQuery = "SELECT Password FROM userinfo WHERE Username='$username'";
    $result = mysqli_query($conn, $selectQuery);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPasswordFromDB = $row['Password'];

        // Check if the provided current password matches the hashed password from the database
        if (password_verify($currentPassword, $hashedPasswordFromDB)) {
            // Hash the new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the user's profile in the database with the new hashed password
            $updateQuery = "UPDATE userinfo SET Password='$hashedNewPassword' WHERE Username='$username'";
            
            if (mysqli_query($conn, $updateQuery)) {
                $response = array("status" => "success", "message" => "Password updated successfully.");
            } else {
                $response = array("status" => "error", "message" => "Error updating profile: " . mysqli_error($conn));
            }
        } else {
            $response = array("status" => "error", "message" => "Invalid current password.");
        }
    } else {
        $response = array("status" => "error", "message" => "User not found.");
    }

    mysqli_close($conn);

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
