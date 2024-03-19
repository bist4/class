<?php
require('../../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['StrandID'])) {
        $strandID = $_POST['StrandID'];

        // Check if the Strand with the given ID exists and if it's active
        $stmtCheckStrand = $conn->prepare("SELECT StrandName, Active FROM strands WHERE StrandID = ?");
        $stmtCheckStrand->bind_param("i", $strandID);
        $stmtCheckStrand->execute();
        $resultCheckStrand = $stmtCheckStrand->get_result();

        if ($resultCheckStrand->num_rows === 1) {
            $row = $resultCheckStrand->fetch_assoc();
            $strandName = $row['StrandName'];
            $isActive = $row['Active'];

            if ($isActive == 1) {
                echo json_encode(["error" => "The data already exists and is active"]); 
            } else {
                //Check if another record with the same StrandCode is active
                $stmtCheckActiveStrand = $conn->prepare("SELECT StrandID FROM strands WHERE StrandName = ? AND Active = 1");
                $stmtCheckActiveStrand->bind_param("s", $strandName);
                $stmtCheckActiveStrand->execute();
                $resultCheckActiveStrand = $stmtCheckActiveStrand->get_result();

                if ($resultCheckActiveStrand->num_rows > 0) {
                    // echo "Error: Another active record with the same StrandName exists.";
                   echo json_encode(["error" => "The data are already in File Maintenance."]);
                } else {
                     // Update the active status in the strands table
                    $sqlUpdateActive = "UPDATE strands SET Active = 1 WHERE StrandID = ?";
                    $stmtUpdateActive = $conn->prepare($sqlUpdateActive);
                    $stmtUpdateActive->bind_param("i", $strandID);
                    

                    if ($stmtUpdateActive->execute()) {

                        $updateDepartmentSql = "UPDATE departments SET Active = 1 WHERE StrandID = ?";
                        $stmtDepartment = $conn->prepare($updateDepartmentSql);

                        if ($stmtDepartment) {
                            $stmtDepartment->bind_param("i", $strandID);
                            $stmtDepartment->execute();

                            // Check if the update in department table was successful
                            if ($stmtDepartment->affected_rows <= 0) {
                                echo "Failed to update department.";
                                exit; // Stop further processing if update fails
                            }
                        } else {
                            echo "Error in preparing department update SQL statement: " . $conn->error;
                            exit;
                        }

                        // Update was successful
                        echo json_encode(["success" => "Strand retrieved successfully"]);
                    } else {
                        // Update failed
                        echo json_encode(["error" => "Error retrieving strand: " . $conn->error]);
                    }

                    // Close the prepared statement
                    $stmtUpdateActive->close();
                }
            }
        } else {
            echo json_encode(["error" => "Strand not found or invalid ID"]);
        }

        // Close the prepared statement
        $stmtCheckStrand->close();
    } else {
        echo json_encode(["error" => "Invalid input"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
