<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../../config/db_connection.php');

    $successCount = 0; 
    $hasChanges = false; // Flag to detect changes
    $errors = []; // Initialize an array to store errors

    foreach ($_POST['SectionID'] as $key => $sectionID) {
        $sectionNo = $_POST['SectionNo'][$key];
        $sectionName = $_POST['SectionName'][$key];
    
        
        // Retrieve the original values before the update
        $stmtGetOriginalData = $conn->prepare("SELECT SectionNo, SectionName FROM classsections WHERE SectionID = ?");
        $stmtGetOriginalData->bind_param("i", $sectionID);
        $stmtGetOriginalData->execute();
        $resultGetOriginalData = $stmtGetOriginalData->get_result();
        
        if ($resultGetOriginalData->num_rows > 0) {
            $originalSectionData = $resultGetOriginalData->fetch_assoc();


            $stmtValidation = $conn->prepare("SELECT SectionID FROM classsections WHERE SectionNo = ? AND SectionID !=? AND Active = 1");
            $stmtValidation->bind_param("ii", $sectionNo,$sectionID);
            $stmtValidation->execute();
            $resultValidation = $stmtValidation->get_result();

            $stmtValidationName = $conn->prepare("SELECT SectionID FROM classsections WHERE SectionName = ? AND SectionID !=? AND Active = 1");
            $stmtValidationName->bind_param("si", $sectionName, $sectionID);
            $stmtValidationName->execute();
            $resultValidationName = $stmtValidationName->get_result();

            if ($resultValidation->num_rows > 0 || $resultValidationName->num_rows > 0) {
                $errors[] = "Section already exist.";
            }else{

                if (
                    $originalSectionData['SectionNo'] !== $sectionNo ||
                    $originalSectionData['SectionName'] !== $sectionName
                )
                // Your existing logic for updating data...
                {

                    $hasChanges = true;
    
                    // Build the activity log by comparing original and updated values
                    $activity = 'Update Section: ' . $sectionNo . ' (';
    
                    if ($originalSectionData['SectionNo'] !== $sectionNo) {
                        $activity .= 'Section Code: ' . $originalSectionData['SectionNo'] . ' -> ' . $sectionNo . ', ';
                    }
                    if ($originalSectionData['SectionName'] !== $sectionName) {
                        $activity .= 'Section Description: ' . $originalSectionData['SectionName'] . ' -> ' . $sectionName . ', ';
                    }
                   
    
                     
                
                
                    // Perform the update
                    $stmt = $conn->prepare("UPDATE classsections SET SectionNo=?, SectionName=? WHERE SectionID=?");
                    $stmt->bind_param("ssi", $sectionNo, $sectionName, $sectionID);
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
        $stmtGetOriginalData->close();
    }

    $conn->close();


    if($successCount > 0){
        if ($hasChanges) {
            echo json_encode(["success" => "Section updated successfully"]);
            exit(); 
        }
        else {
            echo json_encode(["info" => "No changes made"]);
            exit();
        }
    } else {
        // No updates were successful
        // No updates were successful or validation errors occurred
        if (!empty($errors)) {
            echo json_encode(["error" => $errors]);
            exit();
        } else {
            echo json_encode(["error" => "No Section updated"]);
            exit();
        }
    }
    
}


?>
