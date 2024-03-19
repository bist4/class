<?php
require('../../config/db_connection.php');
 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if (isset($_POST['RoomID'])) {
        $roomID = $_POST['RoomID'];

        $newActiveStatus = 10;  // 10 means delete

        $sqlUpdate = "UPDATE rooms SET Active = ? WHERE RoomID = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ii", $newActiveStatus, $roomID);

        if ($stmtUpdate->execute()) {
            // Update was successful
            echo "Room deleted successfully.";

            // Log the activity
            $dateTime = date('Y-m-d H:i:s');
            $activity = "Deleted Room with ID: $roomID";
            $userID = 19; // Replace with the actual user ID
            $active = 1; // Assuming 1 means active in the logs

            $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active) VALUES (?, ?, ?, ?)";
            $stmtLog = $conn->prepare($sqlLog);
            $stmtLog->bind_param("ssii", $dateTime, $activity, $userID, $active);
            $stmtLog->execute();
        } else {
            // Update failed
            echo "Error deleting rooms: " . $conn->error;
        }

        // Close the prepared statement
        $stmtUpdate->close();
    }
    
    elseif(isset($_POST['StrandID'])){
        $strandID = $_POST['StrandID'];

        $newActiveStatus = 10;  //10 means delete

        $sqlUpdate = "UPDATE strands SET Active = ? WHERE StrandID = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ii", $newActiveStatus, $strandID);

        if ($stmtUpdate->execute()) {
            // Update was successful
            echo "Strand deleted successfully.";


            // Log the activity
            $dateTime = date('Y-m-d H:i:s');
            $activity = "Deleted Strand with ID: $strandID";
            $userID = 19; // Replace with the actual user ID
            $active = 1; // Assuming 1 means active in the logs

            $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active) VALUES (?, ?, ?, ?)";
            $stmtLog = $conn->prepare($sqlLog);
            $stmtLog->bind_param("ssii", $dateTime, $activity, $userID, $active);
            $stmtLog->execute();
        } else {
            // Update failed
            echo "Error deleting strand: " . $conn->error;
        }
            
         // Close the prepared statement
        $stmtUpdate->close();

    }
    elseif(isset($_POST['SubjectID'])){
        $subjectID = $_POST['SubjectID'];

        $newActiveStatus = 10;  //10 means delete

        $sqlUpdate = "UPDATE subjects SET Active = ? WHERE SubjectID = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ii", $newActiveStatus, $subjectID);

        if ($stmtUpdate->execute()) {
            // Update was successful
            echo "Subject deleted successfully.";

            // Log the activity
            $dateTime = date('Y-m-d H:i:s');
            $activity = "Deleted Subject with ID: $subjectID";
            $userID = 19; // Replace with the actual user ID
            $active = 1; // Assuming 1 means active in the logs

            $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active) VALUES (?, ?, ?, ?)";
            $stmtLog = $conn->prepare($sqlLog);
            $stmtLog->bind_param("ssii", $dateTime, $activity, $userID, $active);
            $stmtLog->execute();
        } else {
            // Update failed
            echo "Error deleting subject: " . $conn->error;
        }
            
         // Close the prepared statement
        $stmtUpdate->close();

    }

    elseif(isset($_POST['SectionID'])){
        $sectionID = $_POST['SectionID'];

        $newActiveStatus = 10;  //10 means delete

        $sqlUpdate = "UPDATE sections SET Active = ? WHERE SectionID = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ii", $newActiveStatus, $sectionID);

        if ($stmtUpdate->execute()) {
            // Update was successful
            echo "Section deleted successfully.";

            // Log the activity
            $dateTime = date('Y-m-d H:i:s');
            $activity = "Deleted Section with ID: $sectionID";
            $userID = 19; // Replace with the actual user ID
            $active = 1; // Assuming 1 means active in the logs

            $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active) VALUES (?, ?, ?, ?)";
            $stmtLog = $conn->prepare($sqlLog);
            $stmtLog->bind_param("ssii", $dateTime, $activity, $userID, $active);
            $stmtLog->execute();
        } else {
            // Update failed
            echo "Error deleting section: " . $conn->error;
        }
            
         // Close the prepared statement
        $stmtUpdate->close();

    }

    elseif(isset($_POST['InstructorID'])){
        $instructorID = $_POST['InstructorID'];

        $newActiveStatus = 10;  //10 means delete

        $sqlUpdate = "UPDATE instructor SET Active = ? WHERE InstructorID = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ii", $newActiveStatus, $instructorID);

        if ($stmtUpdate->execute()) {
            // Update was successful
            echo "Instructor deleted successfully.";
            // Log the activity
            $dateTime = date('Y-m-d H:i:s');
            $activity = "Deleted Instructor with ID: $instructorID";
            $userID = 19; // Replace with the actual user ID
            $active = 1; // Assuming 1 means active in the logs

            $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active) VALUES (?, ?, ?, ?)";
            $stmtLog = $conn->prepare($sqlLog);
            $stmtLog->bind_param("ssii", $dateTime, $activity, $userID, $active);
            $stmtLog->execute();
        } else {
            // Update failed
            echo "Error deleting instructor: " . $conn->error;
        }
            
         // Close the prepared statement
        $stmtUpdate->close();

    }
    

}else {
    echo "Invalid request.";
}
?>
