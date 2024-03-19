<?php
require('../../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['InstructorID'])) {
        $instructorID = $_POST['InstructorID'];

        // Check if the Instructor with the given ID exists and if it's active
        $stmtCheckInstructor = $conn->prepare("SELECT Fname, Mname, Lname, Active FROM instructor WHERE InstructorID = ?");
        $stmtCheckInstructor->bind_param("i", $instructorID);
        $stmtCheckInstructor->execute();
        $resultCheckInstructor = $stmtCheckInstructor->get_result();

        if ($resultCheckInstructor->num_rows === 1) {
            $row = $resultCheckInstructor->fetch_assoc();
            $Fname = $row['Fname'];
            $Mname = $row['Mname'];
            $Lname = $row['Lname'];
            $isActive = $row['Active'];

            // Check if the Fname exists and is active
            if ($isActive == 1) {
                echo json_encode(["error" => "The data already exists and is active"]);
            } else {
                // Check if another record with the same Full Name is active
                $stmtCheckActiveInstructor = $conn->prepare("SELECT InstructorID FROM instructor WHERE Fname = ? AND Mname = ? AND Lname = ? AND Active = 1");
                $stmtCheckActiveInstructor->bind_param("sss", $Fname, $Mname, $Lname);
                $stmtCheckActiveInstructor->execute();
                $resultCheckActiveInstructor = $stmtCheckActiveInstructor->get_result();

                if ($resultCheckActiveInstructor->num_rows > 0) {
                    echo json_encode(["error" => "The data are already in File Maintenance."]);
                } else {
                    // Update the Active status in the instructor table
                    $sqlUpdateActive = "UPDATE instructor SET Active = 1 WHERE InstructorID = ?";
                    $stmtUpdateActive = $conn->prepare($sqlUpdateActive);
                    $stmtUpdateActive->bind_param("i", $instructorID);

                    if ($stmtUpdateActive->execute()) {
                        // Update was successful
                        echo json_encode(["success" => "Instructor retrieved successfully"]);
                    } else {
                        // Update failed
                        echo json_encode(["error" => "Error retrieving insgtructor: " . $conn->error]);
                    }

                    // Close the prepared statement
                    $stmtUpdateActive->close();
                }
            }
        } else {
            echo json_encode(["error" => "Error: Instructor does not exist"]);
        }
        // Close the prepared statements
        $stmtCheckInstructor->close();
        $stmtCheckActiveInstructor->close();
    }
} else {
    echo json_encode(["error" => "Invalid Request"]);
}
?>