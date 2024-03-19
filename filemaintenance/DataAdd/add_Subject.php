<?php
session_start();
require('../../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $DepartmentIDs = $_POST['DepartmentID'];

    $DepartmentIDs = isset($_POST['DepartmentID']) ? $_POST['DepartmentID'] : [];

    $Classification = $_POST['Classification'];

    $Subjects = $_POST['Subjects'];

    $success = true;
    $errors = []; // To hold errors for each row

    foreach ($DepartmentIDs as $DepartmentID){
    foreach ($Subjects as $subject) {
        $SubjectCode = $subject['SubjectCode'];
        $SubjectName = $subject['SubjectName'];
        $Type = $subject['Type'];

        $MinutesPerWeek = $subject['MinutesPerWeek'];

        // Check if the SubjectCode already exists for the given DepartmentID
        $sqlCodeCheck = "SELECT SubjectID FROM subjects WHERE DepartmentID = ? AND SubjectCode = ?";
        $stmtCodeCheck = $conn->prepare($sqlCodeCheck);
        $stmtCodeCheck->bind_param("is", $DepartmentID, $SubjectCode);
        $stmtCodeCheck->execute();
        $resultCodeCheck = $stmtCodeCheck->get_result();

        if ($resultCodeCheck->num_rows > 0) {
            // Subject with the same code exists for this department
            $errors[] = "Subject Code '{$SubjectCode}' already exists in this year level.";
            $success = false;
        } else {
            // Check if the SubjectName already exists for the given DepartmentID
            $sqlDescCheck = "SELECT SubjectID FROM subjects WHERE DepartmentID = ? AND SubjectName = ?";
            $stmtDescCheck = $conn->prepare($sqlDescCheck);
            $stmtDescCheck->bind_param("is", $DepartmentID, $SubjectName);
            $stmtDescCheck->execute();
            $resultDescCheck = $stmtDescCheck->get_result();

            if ($resultDescCheck->num_rows > 0) {
                // Subject with the same description exists for this department
                $errors[] = "Subject Name '{$SubjectName}' already exists in this year level.";
                $success = false;
            } else {
                // Insert the row if no duplicate is found
                $active = 1;

                $sqlInsert = "INSERT INTO subjects (DepartmentID, SubjectCode, SubjectName, Classification, Type, MinutesPerWeek, Active, CreatedAt)
                              VALUES (?, ?, ?, ?, ?, ?, ?,NOW())";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param("issssii", $DepartmentID, $SubjectCode, $SubjectName, $Classification, $Type, $MinutesPerWeek, $active);
                $resultInsert = $stmtInsert->execute();

                if (!$resultInsert) {
                    // Handle insertion error for this row
                    $errors[] = "Failed to insert Subject '{$SubjectCode}' with Description '{$SubjectName}'.";
                    $success = false;
                }
            }
        }
    }
}

    if (!$success) {
        // Return errors for the rows that encountered issues
        echo json_encode([
            "error" => implode('<br>', $errors),
        ]);
        exit(); // Exit the script after sending the error response
    }

    if (isset($_SESSION['UserID'])) {
        $loggedInUserID = $_SESSION['UserID'];

        $sqlUserCheck = "SELECT UserInfoID FROM userinfo WHERE UserInfoID = ?";
        $stmtUserCheck = $conn->prepare($sqlUserCheck);
        $stmtUserCheck->bind_param("i", $loggedInUserID);
        $stmtUserCheck->execute();
        $resultUserCheck = $stmtUserCheck->get_result();

        if ($resultUserCheck->num_rows > 0) {
            foreach ($Subjects as $subject) {
                $subjectCode = $subject['SubjectCode'];
                $subjectDescription = $subject['SubjectName'];
                $units = $subject['MinutesPerWeek'];

                $activity = 'Add Subject: ' . $subjectCode . ' (' . $subjectDescription . ', MinutesPerWeek: ' . $units . ')';
                $currentDateTime = date('Y-m-d H:i:s');
                $active = 1;

                $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                $stmtLog = $conn->prepare($sqlLog);
                $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                $resultLog = $stmtLog->execute();
            }
        }
    }

    // Insertion was successful for all rows
    echo json_encode(["success" => "Subject(s) Added successfully"]);
}
?>
