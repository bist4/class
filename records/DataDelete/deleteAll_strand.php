<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../../config/db_connection.php'); // Adjust the path to your database connection file

    if (isset($_POST['strandIDs'])) {
        $strandIDs = $_POST['strandIDs'];

        // Prepare and execute the SQL update query for each StrandID
        $updatesql = "UPDATE strands SET Active = 0 WHERE StrandID = ?";
        $stmt = $conn->prepare($updatesql);

        if ($stmt) {
            foreach ($strandIDs as $strandID) {
                $stmt->bind_param("i", $strandID);
                $stmt->execute();

                // Check if the update was successful
                if ($stmt->affected_rows <= 0) {
                    echo "Failed to deactivate strands.";
                    exit; // Stop further processing if any update fails
                }

                //$updateDepartmentSql = "UPDATE departments SET Active = 0 WHERE StrandID = ?";
                //$stmtDepartment = $conn->prepare($updateDepartmentSql);

                //if ($stmtDepartment) {
                  //  $stmtDepartment->bind_param("i", $strandID);
                    //$stmtDepartment->execute();

                    // Check if the update in department table was successful
                    //if ($stmtDepartment->affected_rows <= 0) {
                      //  echo "Failed to update department.";
                        //exit; // Stop further processing if update fails
                    //}
                //} else {
                  //  echo "Error in preparing department update SQL statement: " . $conn->error;
                    //exit;
                //}

                // // Log the deletion activity for each deleted strand
                // if (isset($_SESSION['UserID'])) {
                //     $loggedInUserID = $_SESSION['UserID'];

                //     // Fetch StrandCode and StrandName for logging
                //     $sqlGetSubjectInfo = "SELECT StrandCode, StrandName FROM strands WHERE StrandID = ?";
                //     $stmtGetSubjectInfo = $conn->prepare($sqlGetSubjectInfo);
                //     $stmtGetSubjectInfo->bind_param("i", $strandID);
                //     $stmtGetSubjectInfo->execute();
                //     $resultGetSubjectInfo = $stmtGetSubjectInfo->get_result();
                //     $row = $resultGetSubjectInfo->fetch_assoc();
                //     $strandCodeToDelete = isset($row['StrandCode']) ? $row['StrandCode'] : '';
                //     $strandNameToDelete = isset($row['StrandName']) ? $row['StrandName'] : '';

                //     $activity = 'Delete Strand: ' . $strandCodeToDelete . ' ' . $strandNameToDelete;
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

            // Redirect after successful deletion and logging of all strands
            header("Location: ../file_strand.php");
            exit();
        } else {
            echo "Error in preparing SQL statement: " . $conn->error;
        }
    } else {
        echo "No strand IDs provided!";
    }
}
?>
