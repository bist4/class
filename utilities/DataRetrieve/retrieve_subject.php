<?php
    require('../../config/db_connection.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['SubjectID'])) {
            $subjectID = $_POST['SubjectID'];

            // Check if the Subject with the given ID exists and if it's active
            $stmtCheckSubject = $conn->prepare("SELECT SubjectDescription, Active FROM subjects WHERE SubjectID = ?");
            $stmtCheckSubject->bind_param("i", $subjectID);
            $stmtCheckSubject->execute();
            $resultCheckStrand = $stmtCheckSubject->get_result();

            if ($resultCheckStrand->num_rows === 1) {
                $row = $resultCheckStrand->fetch_assoc();
                $subjectDescription = $row['SubjectDescription'];
                $isActive = $row['Active'];

                // Check if the SubjectDescription exists and is active
                if ($isActive == 1) {
                    // echo "Error: The data already exists and is active.";
                    echo json_encode(["error" => "The data already exists and is active"]); 
                } else {
                    // Check if another record with the same SubjectDescription is active
                    $stmtCheckActiveSubject = $conn->prepare("SELECT SubjectID FROM subjects WHERE SubjectDescription = ? AND Active = 1");
                    $stmtCheckActiveSubject->bind_param("s", $subjectDescription);
                    $stmtCheckActiveSubject->execute();
                    $resultCheckActiveSubject = $stmtCheckActiveSubject->get_result();
    
                    if ($resultCheckActiveSubject->num_rows > 0) {
                        // echo "Error: Another active record with the same SubjectDescription exists.";
                       echo json_encode(["error" => "The data are already in File Maintenance."]);  
                    } else {
                        // Update the Active status in the subjects table
                        $sqlUpdateActive = "UPDATE subjects SET Active = 1 WHERE SubjectID = ?";
                        $stmtUpdateActive = $conn->prepare($sqlUpdateActive);
                        $stmtUpdateActive->bind_param("i", $subjectID);
    
                        if ($stmtUpdateActive->execute()) {
                            // Update was successful
                            echo json_encode(["success" => "Subject retrieved successfully"]);
                        } else {
                            // Update failed
                            echo json_encode(["error" => "Error retrieving subject: " . $conn->error]);
                        }
    
                        // Close the prepared statement
                        $stmtUpdateActive->close();
                    }
                }
            } else{
                echo json_encode(["success" => "Error: Subject does not exist" . $conn->error]);
            }
            // Close the prepared statements
            $stmtCheckSubject->close();
            $stmtCheckActiveSubject->close();
        }
    } else{
        echo json_encode(["error" => "Invalid Request"]);
    }
?>