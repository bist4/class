<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../../config/db_connection.php');

    $hasChanges = false; // Flag to detect changes
    $successCount = 0; // Initialize the count for successful updates
    $errors = [];

    foreach ($_POST['StrandID'] as $key => $strandID) {
        $strandCode = $_POST['StrandCode'][$key];
        $strandName = $_POST['StrandName'][$key];
        $trackType = $_POST['TrackTypeName'][$key];
        $specialization = $_POST['Specialization'][$key];

        // Retrieve the original values before the update
        $stmtGetOriginalData = $conn->prepare("SELECT StrandCode, StrandName, TrackTypeName, Specialization FROM strands WHERE StrandID = ?");
        $stmtGetOriginalData->bind_param("i", $strandID);
        $stmtGetOriginalData->execute();
        $resultGetOriginalData = $stmtGetOriginalData->get_result();

        if ($resultGetOriginalData->num_rows > 0) {
            $originalStrandData = $resultGetOriginalData->fetch_assoc();

            // Validate if the StrandCode exists for a different StrandID or if the StrandName exists for a different StrandID
            $stmtValidationCode = $conn->prepare("SELECT StrandID FROM strands WHERE StrandCode = ? AND StrandID != ? AND Active = 1");
            $stmtValidationCode->bind_param("si", $strandCode, $strandID);
            $stmtValidationCode->execute();
            $resultValidationCode = $stmtValidationCode->get_result();

            $stmtValidationName = $conn->prepare("SELECT StrandID FROM strands WHERE StrandName = ? AND StrandID != ? AND Active = 1");
            $stmtValidationName->bind_param("si", $strandName, $strandID);
            $stmtValidationName->execute();
            $resultValidationName = $stmtValidationName->get_result();

            if ($resultValidationCode->num_rows > 0 || $resultValidationName->num_rows > 0) {
                // The provided StrandCode or StrandName exists in a different StrandID
                $errors[] = "Strand already exists.";
            } else {
                // Check for changes
                if (
                    $originalStrandData['StrandCode'] !== $strandCode ||
                    $originalStrandData['StrandName'] !== $strandName ||
                    $originalStrandData['TrackTypeName'] !== $trackType ||
                    $originalStrandData['Specialization'] !== $specialization
                ) {
                    $hasChanges = true;
                    // Build the activity log by comparing original and updated values
                    $activity = 'Update Strand: ' . $strandCode . ' (';

                    if ($originalStrandData['StrandCode'] !== $strandCode) {
                        $activity .= 'Strand Code: ' . $originalStrandData['StrandCode'] . ' -> ' . $strandCode . ', ';
                    }
                    if ($originalStrandData['StrandName'] !== $strandName) {
                        $activity .= 'Strand Name: ' . $originalStrandData['StrandName'] . ' -> ' . $strandName . ', ';
                    }
                    if ($originalStrandData['TrackTypeName'] !== $trackType) {
                        $activity .= 'Track Type: ' . $originalStrandData['TrackTypeName'] . ' -> ' . $trackType . ', ';
                    }
                    if ($originalStrandData['Specialization'] !== $specialization) {
                        $activity .= 'Specialization: ' . $originalStrandData['Specialization'] . ' -> ' . $specialization . ', ';
                    }

                   

                    // Log the activity (assuming you have a 'logs' table)
                    // session_start();
                     

                    // Update the strand
                    $stmt = $conn->prepare("UPDATE strands SET StrandCode=?, StrandName=?, TrackTypeName=?, Specialization=? WHERE StrandID=?");
                    $stmt->bind_param("ssssi", $strandCode, $strandName, $trackType, $specialization, $strandID);
                    $stmt->execute();

                    // Check if the update was successful for this iteration
                    if ($stmt->affected_rows > 0) {
                        $successCount++;
                    }
                }
            }
            $stmtValidationCode->close();
            $stmtValidationName->close();
        }
        $stmtGetOriginalData->close();
    }

    $conn->close();

    if ($successCount > 0) {
        if ($hasChanges) {
            // Updates were made
            echo json_encode(["success" => "Strand updated successfully"]);
            exit();
        } else {
            // No changes made in any updated strands
            echo json_encode(["info" => "No changes made"]);
            exit();
        }
    } else {
        // No updates were successful
        if (!empty($errors)) {
            echo json_encode(["error" => $errors]);
            exit();
        } else {
            echo json_encode(["error" => "No Strand updated"]);
            exit();
        }
    }
}
?>
