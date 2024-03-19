<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../../config/db_connection.php');

    $successCount = 0;
    $hasChanges = false; // Flag to detect changes
    $errors = []; // Initialize an array to store errors

    foreach ($_POST['SubjectID'] as $key => $subjectID) {
        $subjectCode = $_POST['SubjectCode'][$key];
        $subjectDescription = $_POST['SubjectName'][$key];
        // $subjectClassification = $_POST['Classification'][$key];
        $subjectType = $_POST['Type'][$key];

        $units = $_POST['MinutesPerWeek'][$key];

        // Retrieve the original values before the update
        $stmtGetOriginalData = $conn->prepare("SELECT SubjectCode, SubjectName, Classification, Type, MinutesPerWeek, DepartmentID FROM subjects WHERE SubjectID = ?");
        $stmtGetOriginalData->bind_param("i", $subjectID);
        $stmtGetOriginalData->execute();
        $resultGetOriginalData = $stmtGetOriginalData->get_result();

        if ($resultGetOriginalData->num_rows > 0) {
            $originalSubjectData = $resultGetOriginalData->fetch_assoc();

            // Validate if the SubjectCode and SubjectName exist in the same DepartmentID
            $stmtValidation = $conn->prepare("SELECT SubjectID FROM subjects WHERE SubjectCode = ? AND SubjectName = ? AND DepartmentID = ? AND SubjectID != ?");
            $stmtValidation->bind_param("ssii", $subjectCode, $subjectDescription, $originalSubjectData['DepartmentID'], $subjectID);
            $stmtValidation->execute();
            $resultValidation = $stmtValidation->get_result();

            if ($resultValidation->num_rows > 0) {
                // The provided SubjectCode and SubjectName exist in the same DepartmentID
                $errors[] = "Subject with the same code and description already exists in this department.";
            } else {
                if (
                    $originalSubjectData['SubjectCode'] !== $subjectCode ||
                    $originalSubjectData['SubjectName'] !== $subjectDescription ||
                    // $originalSubjectData['Classification'] !== $subjectClassification ||
                    $originalSubjectData['Type'] !== $subjectType ||

                    $originalSubjectData['MinutesPerWeek'] !== $units
                ){
                    $hasChanges = true;

                    // Build the activity log by comparing original and updated values
                    $activity = 'Update Subject: ' . $subjectCode . ' (';

                    if ($originalSubjectData['SubjectCode'] !== $subjectCode) {
                        $activity .= 'Subject Code: ' . $originalSubjectData['SubjectCode'] . ' -> ' . $subjectCode . ', ';
                    }
                    if ($originalSubjectData['SubjectName'] !== $subjectDescription) {
                        $activity .= 'Subject Description: ' . $originalSubjectData['SubjectName'] . ' -> ' . $subjectDescription . ', ';
                    }
                    // if ($originalSubjectData['Classification'] !== $subjectClassification) {
                    //     $activity .= 'Subject Classification: ' . $originalSubjectData['Classification'] . ' -> ' . $subjectClassification . ', ';
                    // }
                    if ($originalSubjectData['Type'] !== $subjectType) {
                        $activity .= 'Subject Type: ' . $originalSubjectData['Type'] . ' -> ' . $subjectType . ', ';
                    }
                    if ($originalSubjectData['MinutesPerWeek'] !== $units) {
                        $activity .= 'MinutesPerWeek: ' . $originalSubjectData['MinutesPerWeek'] . ' -> ' . $units . ', ';
                    }

                    

                    // Perform the update excluding the DepartmentID field
                    $stmt = $conn->prepare("UPDATE subjects SET SubjectCode=?, SubjectName=?,  Type=?,  MinutesPerWeek=? WHERE SubjectID=?");
                    $stmt->bind_param("sssii", $subjectCode, $subjectDescription,  $subjectType, $units, $subjectID);
                    $stmt->execute();
                
                    // If the update was successful, set the flags accordingly
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

    if ($successCount > 0) {
        if ($hasChanges) {
            echo json_encode(["success" => "Subject updated successfully"]);
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
            echo json_encode(["error" => "No Subject updated"]);
            exit();
        }
    }
}
?>
