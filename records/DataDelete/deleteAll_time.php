<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../../config/db_connection.php');

    if (isset($_POST['timeAvailIDs'])) {
        
        $timeAvailIDs = $_POST['timeAvailIDs'];

        $sqlDelete = "UPDATE instructortimeavailabilities SET Active = 0 WHERE InstructorTimeAvailabilitiesID = ?";
        $stmtDelete = $conn->prepare($sqlDelete);


// Prepare and execute the SQL update query for each SectionID
        $updatesql = "UPDATE instructortimeavailabilities SET Active = 0 WHERE InstructorTimeAvailabilitiesID = ?";
        $stmt = $conn->prepare($updatesql);

        if ($stmt) {
            foreach ($timeAvailIDs as $timeAvailID) {
                $stmt->bind_param("i", $timeAvailID);
                $stmt->execute();

                // Check if the update was successful
                if ($stmt->affected_rows <= 0) {
                    echo "Failed to deactivate classsections.";
                    exit; // Stop further processing if any update fails
                }

                // // Log the deletion activity for each deleted section
                // if (isset($_SESSION['UserID'])) {
                //     $loggedInUserID = $_SESSION['UserID'];

                //     // Fetch SectionNo, SectionName, and Adviser for logging
                //     $sqlGetSectionInfo = "SELECT s.SectionNo, s.SectionName, i.Fname, i.Mname, i.Lname 
                //                           FROM classsections s 
                //                           INNER JOIN instructor i ON s.Adviser = i.InstructorID 
                //                           WHERE s.SectionID = ?";
                //     $stmtGetSectionInfo = $conn->prepare($sqlGetSectionInfo);
                //     $stmtGetSectionInfo->bind_param("i", $timeAvailID);
                //     $stmtGetSectionInfo->execute();
                //     $resultGetSectionInfo = $stmtGetSectionInfo->get_result();
                //     $row = $resultGetSectionInfo->fetch_assoc();
                    
                //     $sectionNoToDelete = isset($row['SectionNo']) ? $row['SectionNo'] : '';
                //     $sectionNameToDelete = isset($row['SectionName']) ? $row['SectionName'] : '';
                //     $adviserToDelete = isset($row['Fname']) ? $row['Fname'] : '';
                //     $adviserToDelete .= isset($row['Mname']) ? ' ' . $row['Mname'] : '';
                //     $adviserToDelete .= isset($row['Lname']) ? ' ' . $row['Lname'] : '';

                //     $activity = 'Delete Section: ' . $sectionNoToDelete . ' (Section Name: ' . $sectionNameToDelete . ') (Adviser: ' . $adviserToDelete . ')';
                //     $currentDateTime = date('Y-m-d H:i:s');
                //     $active = 1;

                //     $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                //     $stmtLog = $conn->prepare($sqlLog);
                //     $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                //     $resultLog = $stmtLog->execute();

                //     if (!$resultLog) {
                //         echo "Failed to log the deletion activity.";
                //         exit; // Stop further processing if logging fails
                //     }
                // } else {
                //     echo "User not logged in.";
                //     exit; // Stop further processing if user is not logged in
                // }
            }

            // Redirect after successful deletion and logging of all classsections
            echo '<script>alert("Section Deleted Successfully");</script>';
            header("Location: ../file_section.php");
            exit();
        } else {
            echo "Error in preparing SQL statement: " . $conn->error;
        }
    } else {
        echo "No section IDs provided!";
    }
}
?>
