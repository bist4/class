<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../../config/db_connection.php'); // Adjust the path to your database connection file

    if (isset($_POST['roomIDs'])) {
        $roomIDs = $_POST['roomIDs'];

        $updatesql = "UPDATE rooms SET Active = 0 WHERE RoomID = ?";
        $stmt = $conn->prepare($updatesql);

        if ($stmt) {
            foreach ($roomIDs as $roomID) {
                $stmt->bind_param("i", $roomID);
                $stmt->execute();

                if ($stmt->affected_rows <= 0) {
                    echo "Failed to deactivate rooms.";
                    exit; // Stop further processing if any update fails
                }

                // if (isset($_SESSION['UserID'])) {
                //     $loggedInUserID = $_SESSION['UserID'];

                //     $sqlGetRoomInfo = "SELECT RoomNumber, Capacity, RoomType FROM rooms WHERE RoomID = ?";
                //     $stmtGetRoomInfo = $conn->prepare($sqlGetRoomInfo);
                //     $stmtGetRoomInfo->bind_param("i", $roomID);
                //     $stmtGetRoomInfo->execute();
                //     $resultGetRoomInfo = $stmtGetRoomInfo->get_result();
                //     $row = $resultGetRoomInfo->fetch_assoc();

                //     $roomNoToDelete = isset($row['RoomNumber']) ? $row['RoomNumber'] : '';
                //     $roomCapacity = isset($row['Capacity']) ? $row['Capacity'] : '';
                //     $RoomType = isset($row['RoomType']) ? $row['RoomType'] : '';

                //     $activity = 'Delete Room: ' . $roomNoToDelete . ' (Room Capacity: ' . $roomCapacity . ')' . ' (RoomType: ' . $RoomType . ')';
                //     $currentDateTime = date('Y-m-d H:i:s');
                //     $active = 1;

                //     $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                //     $stmtLog = $conn->prepare($sqlLog);
                //     $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                //     $resultLog = $stmtLog->execute();

                //     if (!$resultLog) {
                //         echo "Failed to log the deletion activity.";
                //         exit; // Stop further processing if logging fails
                //     }
                // } else {
                //     echo "User not logged in.";
                //     exit; // Stop further processing if user is not logged in
                // }
            }

            echo '<script>alert("Room(s) Deleted Successfully");</script>';
            header("Location: ../file_room.php");
            exit();
        } else {
            echo "Error in preparing SQL statement: " . $conn->error;
        }
    } else {
        echo "No Room IDs provided!";
    }
}
?>
