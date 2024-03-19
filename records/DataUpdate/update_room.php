<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../../config/db_connection.php');

    $successCount = 0; 
    $hasChanges = false; // Flag to detect changes
    $errors = []; // Initialize an array to store errors

    foreach ($_POST['RoomID'] as $key => $RoomID) {
        $roomNumber = $_POST['RoomNumber'][$key];
        $capacity = $_POST['Capacity'][$key];
        $roomTypeName = $_POST['RoomTypeName'][$key];



        $fetchOriginalValuesQuery = $conn->prepare("SELECT RoomNumber, Capacity, RoomTypeName FROM rooms WHERE RoomID = ?");
        $fetchOriginalValuesQuery->bind_param("i", $RoomID);
        $fetchOriginalValuesQuery->execute();
        $resultOriginalValues = $fetchOriginalValuesQuery->get_result();

        if ($resultOriginalValues->num_rows > 0) {
            $originalRoomData = $resultOriginalValues->fetch_assoc();

            $stmtValidation = $conn->prepare("SELECT RoomID FROM rooms WHERE RoomNumber = ? AND RoomID !=? AND Active = 1");
            $stmtValidation->bind_param("ii", $roomNumber,$RoomID);
            $stmtValidation->execute();
            $resultValidation = $stmtValidation->get_result();

            if ($resultValidation->num_rows > 0) {
                $errors[] = "Room already exist.";
            }else{

                if (
                    $originalRoomData['RoomNumber'] !== $roomNumber ||
                    $originalRoomData['Capacity'] !== $capacity ||
                    $originalRoomData['RoomTypeName'] !== $roomTypeName 
                ){
                    $hasChanges = true;

                    $activity = 'Update Room: ' . $roomNumber . ' (';
    
                    if ($originalRoomData['RoomNumber'] !== $roomNumber) {
                        $activity .= 'Room Number: ' . $originalRoomData['RoomNumber'] . ' -> ' . $roomNumber . ', ';
                    }
                    if ($originalRoomData['Capacity'] !== $capacity) {
                        $activity .= 'Capacity: ' . $originalRoomData['Capacity'] . ' -> ' . $capacity . ', ';
                    }
                    if ($originalRoomData['RoomTypeName'] !== $roomTypeName) {
                        $activity .= 'Room Type: ' . $originalRoomData['RoomTypeName'] . ' -> ' . $roomTypeName . ', ';
                    }
                   
    
                    

                    $stmt = $conn->prepare("UPDATE rooms SET RoomNumber=?, Capacity=?, RoomTypeName=? WHERE RoomID=?");
                    $stmt->bind_param("iisi", $roomNumber, $capacity, $roomTypeName, $RoomID);
                    $stmt->execute();
    
                     // Check if the update was successful for this iteration
                     if ($stmt->affected_rows > 0) {
                        $successCount++;
                        $hasChanges = true;
                    }

                }

            }
            $stmtValidation->close();   
        }
        $fetchOriginalValuesQuery->close();
    }

    $conn->close();

    if ($successCount > 0) {
        if ($hasChanges) {
            echo json_encode(["success" => "Rooms updated successfully!"]);
            exit(); 
        } else {
            echo json_encode(["info" => "No changes made"]);
            exit();
        }
    } else {
          // No updates were successful or validation errors occurred
        if (!empty($errors)) {
            echo json_encode(["error" => $errors]);
            exit();
        } else {
            echo json_encode(["error" => "No Room updated"]);
            exit();
        }
    }

    
}
?>
