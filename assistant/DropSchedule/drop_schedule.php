<?php
// Include your database connection code here
require('../../config/db_connection.php');

// Function to handle message insertion and update
function handleMessages($conn, $fromUser, $toUser)
{
    // Use NOW() to get the current timestamp
    $insertMessageSql = "INSERT INTO message (CreatedAt, UserFrom, UserTo, Action, Request) 
                         VALUES (NOW(), ?, ?, 9, 'Finish Drop')";

    // Prepare and bind parameters
    $stmt = $conn->prepare($insertMessageSql);
    $stmt->bind_param("ii", $fromUser, $toUser);

    // Perform insert operation
    if ($stmt->execute()) {
        // If the message insertion is successful, update existing messages
        $updateMessageSql = "UPDATE message SET Action = 9 WHERE Request = 'Approved'";
        // Perform update operation
        if ($conn->query($updateMessageSql)) {
            // If the update operation is successful, return true
            return true;
        }
    }
    // Return false if any operation fails
    return false;
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Set UserFrom and UserTo values
    $fromUser = 3; // Assuming UserFrom value is 2
    $toUser = 2;   // Assuming UserTo value is 3

    // Use NOW() to get the current timestamp
    $archiveAt = date('Y-m-d H:i:s');

    // SQL statement to copy data from classschedule to archive_classschedule
    $copyDataSql = "INSERT INTO archive_schedule (ClassScheduleID, AcademicYear, DepartmentID, SectionID, SubjectID, Time_Start, Time_End, is_Monday, is_Tuesday, is_Wednesday, is_Thursday, is_Friday, InstructorID, RoomID, Active, CreatedAt, ArchiveAt)
                    SELECT cs.ClassScheduleID, cs.AcademicYear, cs.DepartmentID, css.SectionName, sub.SubjectName, cs.Time_Start, cs.Time_End, cs.is_Monday, cs.is_Tuesday, cs.is_Wednesday, cs.is_Thursday, cs.is_Friday, CONCAT(ui.Fname, ' ', ui.Lname) AS Instructor, rooms.RoomNumber, cs.Active, cs.CreatedAt, ?
                    FROM classschedules cs
                    INNER JOIN instructors i ON cs.InstructorID = i.InstructorID
                    INNER JOIN userinfo ui ON i.UserInfoID = ui.UserInfoID
                    INNER JOIN classsections css ON cs.SectionID = css.SectionID
                    INNER JOIN subjects sub ON cs.SubjectID = sub.SubjectID
                    INNER JOIN rooms ON cs.RoomID = rooms.RoomID";

    // Prepare and bind parameter for data copy operation
    $stmt = $conn->prepare($copyDataSql);
    $stmt->bind_param("s", $archiveAt);

    // Perform the data copy operation
    if ($stmt->execute()) {
        // If the copy operation is successful, handle message insertion and update
        if (handleMessages($conn, $fromUser, $toUser)) {
            // If message handling is successful, delete data from classschedule table
            $deleteDataSql = "DELETE FROM classschedules";
            if ($conn->query($deleteDataSql)) {
                // If data deletion is successful, send a success response
                echo json_encode(["success" => true]);
            } else {
                // If there's an error in data deletion, send an error response with debug information
                echo json_encode(["success" => false, "error" => $conn->error, "deleteDataSql" => $deleteDataSql]);
            }
        } else {
            // If there's an error in message handling, send an error response
            echo json_encode(["success" => false, "error" => "Error handling messages"]);
        }
    } else {
        // If there's an error in the copy operation, send an error response with debug information
        echo json_encode(["success" => false, "error" => $conn->error, "copyDataSql" => $copyDataSql]);
    }
} else {
    // Add your existing code here if needed
}
// Close the database connection
$conn->close();
?>
