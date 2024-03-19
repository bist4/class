<?php
session_start();
require('../../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Strands = $_POST['Strands'];

    $success = true;
    $existingStrands = [];

    foreach ($Strands as $strand) {
        $StrandCode = $strand['StrandCode'];
        $StrandName = $strand['StrandName'];
        $TrackTypeName = $strand['TrackTypeName'];
        $Specialization = $strand['Specialization'];

        $sqlCheck = "SELECT StrandCode, Active FROM strands WHERE StrandCode = ? AND Active =1";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("s", $StrandCode);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();

        if ($result->num_rows > 0) {
            $success = false;
            $existingStrands[] = $StrandCode; // Store existing StrandCodes for error reporting if needed
        } else {
            $active = 1;
            $sqlInsert = "INSERT INTO strands (StrandCode, StrandName, TrackTypeName, Specialization, Active, CreatedAt)
                          VALUES (?, ?, ?, ?, ?, NOW())";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("ssssi", $StrandCode, $StrandName, $TrackTypeName, $Specialization, $active);
            $resultInsert = $stmtInsert->execute();

            if (!$resultInsert) {
                $success = false;
                break;
            }

            $StrandID = $stmtInsert->insert_id;

            $departmentTypeNameID = 1;
            $yearLevels = [11, 11, 12, 12];
            $semesters = [1, 2, 1, 2];

            $sqlInsertDepartment = "INSERT INTO departments (DepartmentTypeNameID, GradeLevel, Semester, StrandID)
                                    VALUES (?, ?, ?, ?)";
            $stmtInsertDepartment = $conn->prepare($sqlInsertDepartment);

            for ($i = 0; $i < count($yearLevels); $i++) {
                $stmtInsertDepartment->bind_param(
                    "iiii",
                    $departmentTypeNameID,
                    $yearLevels[$i],
                    $semesters[$i],
                    $StrandID
                    
                );
                $resultInsertDepartment = $stmtInsertDepartment->execute();

                if (!$resultInsertDepartment) {
                    $success = false;
                    break;
                }
            }
        }
    }

    if ($success) {
        if (isset($_SESSION['UserID'])) {
           
            $loggedInUserID = $_SESSION['UserID'];

            $sqlUserCheck = "SELECT UserInfoID FROM userinfo WHERE UserInfoID = ?";
            $stmtUserCheck = $conn->prepare($sqlUserCheck);
            $stmtUserCheck->bind_param("i", $loggedInUserID);
            $stmtUserCheck->execute();
            $resultUserCheck = $stmtUserCheck->get_result();

            if ($resultUserCheck->num_rows > 0) {
                foreach ($Strands as $strand){
                    $StrandCode = $strand['StrandCode'];
                    $StrandName = $strand['StrandName'];
                    $TrackTypeName = $strand['TrackTypeName'];
                    $Specialization = $strand['Specialization'];         
        

                    $activity = 'Add Strand: ' . $StrandCode . ' (' . $StrandName . ', Track Type: ' . $TrackTypeName . '<br>Specialization:  ' .$Specialization.')';
                    $currentDateTime = date('Y-m-d H:i:s');
                    $active = 1;

                    $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                    $stmtLog = $conn->prepare($sqlLog);
                    $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                    $resultLog = $stmtLog->execute();
                }
            }
        }

        echo json_encode(["success" => "Strand(s) Added successfully"]);
    } else {
        echo json_encode(["error" => "Strand(s) already exist", "existingStrands" => $existingStrands]);
    }
}
?>
