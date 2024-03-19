<?php
session_start();
require('../../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $DepartmentID = $_POST['DepartmentID'];
    $Sections = $_POST['Sections'];
    $hasDuplicates = false; // Flag to track duplicates

    foreach ($Sections as $section) {
        
        $SectionName = $section['SectionName'];

        // Check if the SectionName already exists in the 'classsections' table
        $sqlCheckSection = "SELECT SectionName FROM classsections WHERE SectionName = ?";
        $stmtCheckSection = $conn->prepare($sqlCheckSection);
        $stmtCheckSection->bind_param("s", $SectionName);
        $stmtCheckSection->execute();
        $resultCheckSection = $stmtCheckSection->get_result();

       // Check if the SectionNo already exists in the same Department
        $sqlCheckSectionNo = "SELECT SectionID FROM classsections WHERE DepartmentID = ? AND SectionNo = ?";
        $stmtCheckSectionNo = $conn->prepare($sqlCheckSectionNo);
        $stmtCheckSectionNo->bind_param("ii", $DepartmentID, $section['SectionNo']); // Assuming SectionNo is an integer
        $stmtCheckSectionNo->execute();
        $resultCheckSectionNo = $stmtCheckSectionNo->get_result();



        if ($resultCheckSection->num_rows > 0 || $resultCheckSectionNo->num_rows > 0) {
            // If duplicates found, set flag and break the loop
            $hasDuplicates = true;
            break;
        }
    }

    if ($hasDuplicates) {
        $duplicateError = "";
    
        if ($resultCheckSectionNo->num_rows > 0) {
            $duplicateError .= "Section No already exists in same Department. ";
        }

        
    
        if ($resultCheckSection->num_rows > 0) {
            $duplicateError .= "Section name already exists.";
        }
    
        // Return the specific error message based on the duplicates found
        echo json_encode(["error" => $duplicateError]);
    }else {
        // If no duplicates found, proceed with insertion
        foreach ($Sections as $section) {
      
            $SectionName = $section['SectionName'];
            $SectionNo = $section['SectionNo'];
            $active = 1;

            $sqlInsert = "INSERT INTO classsections (DepartmentID, SectionNo, SectionName, Active, CreatedAt)
                          VALUES (?, ?, ?, ?,NOW())";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("iisi", $DepartmentID, $SectionNo, $SectionName, $active);
            $resultInsert = $stmtInsert->execute();

            if (!$resultInsert) {
                // Handle insertion failure here
                echo json_encode(["error" => "Failed to insert data. Please try again."]);
                exit();
            }
        }

        // Insertion was successful
        echo json_encode(["success" => "Section(s) added successfully"]);

        // Insert log entry if the UserID exists in the 'users' table
        if (isset($_SESSION['UserID'])) {
            $loggedInUserID = $_SESSION['UserID'];

            $sqlUserCheck = "SELECT UserInfoID FROM userinfo WHERE UserInfoID = ?";
            $stmtUserCheck = $conn->prepare($sqlUserCheck);
            $stmtUserCheck->bind_param("i", $loggedInUserID);
            $stmtUserCheck->execute();
            $resultUserCheck = $stmtUserCheck->get_result();

            if ($resultUserCheck->num_rows > 0) {
                foreach ($Sections as $section) {
                    $SectionNo = $section['SectionNo'];
                    $SectionName = $section['SectionName'];
                    

                    $activity = 'Add Section ' . $SectionNo . ' ' . $SectionName;
                    $currentDateTime = date('Y-m-d H:i:s');
                    $active = 1;

                    $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                    $stmtLog = $conn->prepare($sqlLog);
                    $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                    $resultLog = $stmtLog->execute();
                }
            }
        }
    }
}
?>
