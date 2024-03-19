<?php
require('../../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['RoomID'])) {
        $roomID = $_POST['RoomID'];

        // Check if RoomNumber already exists in the rooms table
        $stmtCheckRoomNumber = $conn->prepare("SELECT RoomNumber, Active FROM rooms WHERE RoomID = ?");
        $stmtCheckRoomNumber->bind_param("i", $roomID);
        $stmtCheckRoomNumber->execute();
        $resultCheckRoomNumber = $stmtCheckRoomNumber->get_result();

        if ($resultCheckRoomNumber->num_rows === 1) {
            $row = $resultCheckRoomNumber->fetch_assoc();
            $roomNumber = $row['RoomNumber'];
            $isActive = $row['Active'];

            // Check if the RoomNumber exists and is active
            if ($isActive == 1) {
                // echo "Error: The data already exists and is active.";
                echo json_encode(["error" => "The data already exists and is active"]); 
            } else {
                // Check if another record with the same RoomNumber is active
                $stmtCheckActiveRoom = $conn->prepare("SELECT RoomID FROM rooms WHERE RoomNumber = ? AND Active = 1");
                $stmtCheckActiveRoom->bind_param("s", $roomNumber);
                $stmtCheckActiveRoom->execute();
                $resultCheckActiveRoom = $stmtCheckActiveRoom->get_result();

                if ($resultCheckActiveRoom->num_rows > 0) {
                    // echo "Error: Another active record with the same RoomNumber exists.";
                   echo json_encode(["error" => "The data are already in File Maintenance."]);  
                } else {
                    // Update the Active status in the rooms table
                    $sqlUpdateActive = "UPDATE rooms SET Active = 1 WHERE RoomID = ?";
                    $stmtUpdateActive = $conn->prepare($sqlUpdateActive);
                    $stmtUpdateActive->bind_param("i", $roomID);

                    if ($stmtUpdateActive->execute()) {
                        // Update was successful
                        // echo "Room retrieved successfully.";
                        echo json_encode(["success" => "Room retrieved successfully"]);
                    } else {
                        // Update failed
                        // echo "Error retrieving room: " . $conn->error;
                        echo json_encode(["error" => "Error retrieving room: " . $conn->error]);
                    }

                    // Close the prepared statement
                    $stmtUpdateActive->close();
                }
            }
        } else {
            echo json_encode(["success" => "Error: Room does not exist" . $conn->error]);
        }

        // Close the prepared statements
        $stmtCheckRoomNumber->close();
        $stmtCheckActiveRoom->close();
    }
    elseif(isset($_POST['SectionID'])){
        $sectionID = $_POST['SectionID'];

        $sqlUpdateActive = "UPDATE sections SET Active = 1 WHERE SectionID = ?";
        $stmtUpdateActive = $conn->prepare($sqlUpdateActive);
        $stmtUpdateActive->bind_param("i", $sectionID);

        if($stmtUpdateActive->execute()){
            echo "Section retrieved successfully";
        }
        else{
            echo "Error retreiving section" . $conn->error; 
        }
        // Close the prepared statement
        $stmtUpdateActive->close();
    }
    
    elseif (isset($_POST['InstructorID'])) {
        $instructorID = $_POST['InstructorID'];

        // Update the Active status in the instructor table
        $sqlUpdateActive = "UPDATE instructor SET Active = 1 WHERE InstructorID = ?";
        $stmtUpdateActive = $conn->prepare($sqlUpdateActive);
        $stmtUpdateActive->bind_param("i", $instructorID);

        if ($stmtUpdateActive->execute()) {
            // Update was successful
            echo "Instructor retrieved successfully";
        } else {
            // Update failed
            echo "Error retrieving instructor: " . $conn->error;
            
        }

        // Close the prepared statement
        $stmtUpdateActive->close();
    } else {
        echo json_encode(["error" => "Invalid Request"]);

    }
} else {
    echo json_encode(["error" => "Invalid Request"]);

}
?>
