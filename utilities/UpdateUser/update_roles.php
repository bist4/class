<?php
// Add this code at the top of your PHP file
require_once '../../config/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if UserID is 1
    $userID = (isset($_POST['UserInfoID'])) ? $_POST['UserInfoID'] : null;
     
    if ($userID == 1) {
        $response = array("error" => "Cannot remove role for UserID 1.");
        echo json_encode($response);
        exit;
    }

    // Check if UserRoleID is set and remove it if it's not selected
    if (isset($_POST['Roles'])) {
        $selectedRoles = $_POST['Roles'];
        $sql = "DELETE FROM userroles WHERE UserID = $userID AND UserRoleID NOT IN (" . implode(",", $selectedRoles) . ")";
        if (!mysqli_query($conn, $sql)) {
            $response = array("error" => "Error removing roles: " . mysqli_error($conn));
            echo json_encode($response);
            exit;
        }
    } else {
        $sql = "DELETE FROM userroles WHERE UserID = $userID";
        if (!mysqli_query($conn, $sql)) {
            $response = array("error" => "Error removing roles: " . mysqli_error($conn));
            echo json_encode($response);
            exit;
        }
    }

    // Update UserRoleID
    foreach ($selectedRoles as $roleID) {
        $sql = "INSERT INTO userroles (UserID, UserRoleID) VALUES ($userID, $roleID) ON DUPLICATE KEY UPDATE UserRoleID = $roleID";
        if (!mysqli_query($conn, $sql)) {
            $response = array("error" => "Error updating roles: " . mysqli_error($conn));
            echo json_encode($response);
            exit;
        }
    }

    // If everything is successful, send success response
    $response = array("success" => "Roles updated successfully.");
    echo json_encode($response);
    exit;
}
?>
