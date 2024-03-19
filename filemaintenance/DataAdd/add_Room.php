<?php
// DataAdd/add_Room.php
require('../../config/db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $DepartmentID = $_POST['DepartmentTypeID'];
    $rooms = $_POST["Rooms"];

    $existingRooms = [];
    $success = true;
    $hasDuplicates = false; // Flag to track duplicates

    foreach ($rooms as $room) {
        $roomNo = $room['RoomNo'];
        $capacity = $room['Capacity'];
        $roomTypeName = $room['RoomTypeName'];

        $active = 1;

        // Check if the room number already exists
        $checkRoomQuery = "SELECT COUNT(*) as count FROM rooms WHERE RoomNumber = ?";
        $stmtCheckRoom = $conn->prepare($checkRoomQuery);
        $stmtCheckRoom->bind_param("s", $roomNo);
        $stmtCheckRoom->execute();
        $resultCheckRoom = $stmtCheckRoom->get_result();
        $rowCheckRoom = $resultCheckRoom->fetch_assoc();

        if ($rowCheckRoom['count'] > 0) {
            $existingRooms[] = $roomNo; 
            $hasDuplicates = true;
            $success = false; // Set success to false on duplicate room numbers
            break;
        }

        // Insert data into the 'rooms' table using prepared statements
        $sql = "INSERT INTO rooms (DepartmentID, RoomNumber, Capacity, RoomTypeName, Active, CreatedAt) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isisi", $DepartmentID, $roomNo, $capacity, $roomTypeName, $active);
        $stmt->execute();

	
        if ($stmt->affected_rows === -1) {
            $success = false;
            break; // Exit loop if insertion fails
        }
    }

    if (!$success) {
        if (!empty($existingRooms)) {
            echo json_encode([
                "error" => "Room already exist.",
                "existingRooms" => $existingRooms
            ]);
        } else {
            echo json_encode(["error" => "Failed to insert data. Please try again."]);
        }
    } else {
        if ($hasDuplicates) {
            // Fetch department details based on DepartmentID
            $sqlDept = "SELECT DepartmentName FROM departmenttypename WHERE DepartmentTypeID = ?";
            $stmtDept = $conn->prepare($sqlDept);
            $stmtDept->bind_param("i", $DepartmentID);
            $stmtDept->execute();
            $resultDept = $stmtDept->get_result();

            if ($resultDept->num_rows > 0) {
                $row = $resultDept->fetch_assoc();
                $DepartmentName = $row['DepartmentName'];

                $departmentDetails = "Department Type: $DepartmentName";

                echo json_encode([
                    "error" => "Room already exists.",
                    "departmentDetails" => $departmentDetails
                ]);
            }
        } else {
            echo json_encode(["success" => "Room(s) added successfully"]);

            // Insert log entries for successful room additions
            if (isset($_SESSION['UserID'])) {
                $loggedInUserID = $_SESSION['UserID'];

                $sqlUserCheck = "SELECT UserInfoID FROM userinfo WHERE UserInfoID = ?";
                $stmtUserCheck = $conn->prepare($sqlUserCheck);
                $stmtUserCheck->bind_param("i", $loggedInUserID);
                $stmtUserCheck->execute();
                $resultUserCheck = $stmtUserCheck->get_result();

                if ($resultUserCheck->num_rows > 0) {
                    foreach ($rooms as $room) {
                        $roomNo = $room['RoomNo'];
                        $capacity = $room['Capacity'];
                        $roomTypeName = $room['RoomTypeName'];

                        $activity = 'Add Room: ' . $roomNo . ' (' . $roomTypeName . ', Capacity: ' . $capacity . ')';
                        $currentDateTime = date('Y-m-d H:i:s');
                        $active = 1;

                        $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                        $stmtLog = $conn->prepare($sqlLog);
                        $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                        $resultLog = $stmtLog->execute();
                    }
                }
            }
        }
    }
} else {
    $response = array("error" => "Invalid request");
    echo json_encode($response);
}

$conn->close();
?>
