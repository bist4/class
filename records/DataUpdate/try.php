<?php
// Check if the form has been submitted
if (isset($_POST['update_btn'])) {
    require('../../config/db_connection.php');

    // Get the subject details from the form submission
    $subjectID = $_POST['subjectID'];
    $departmentTypeName = $_POST['Department'];
    $subjectCode = $_POST['SubjectCode'];
    $subjectDescription = $_POST['SubjectDescription'];
    $units = $_POST['Units'];

    // Check if the Department exists in the departmenttypename table
    $stmtCheckDepartmentTypeName = $conn->prepare("SELECT DepartmentTypeNameID FROM departmenttypename WHERE DepartmentTypeName = ?");
    $stmtCheckDepartmentTypeName->bind_param("s", $departmentTypeName);
    $stmtCheckDepartmentTypeName->execute();
    $resultCheckDepartmentTypeName = $stmtCheckDepartmentTypeName->get_result();

    if ($resultCheckDepartmentTypeName->num_rows > 0) {
        $rowDepartmentTypeName = $resultCheckDepartmentTypeName->fetch_assoc();
        $departmentTypeNameID = $rowDepartmentTypeName['DepartmentTypeNameID'];

        // Check if the SubjectCode already exists in the subjects table (active and inactive records)
        $stmtCheckSubjectCode = $conn->prepare("SELECT SubjectCode FROM subjects WHERE SubjectCode = ?");
        $stmtCheckSubjectCode->bind_param("s", $subjectCode);
        $stmtCheckSubjectCode->execute();
        $resultCheckSubjectCode = $stmtCheckSubjectCode->get_result();

        if ($resultCheckSubjectCode->num_rows > 0) {
            // SubjectCode already exists, check if any of the existing records are active
            while ($row = $resultCheckSubjectCode->fetch_assoc()) {
                $existingSubjectCode = $row['SubjectCode'];

                // Check if any of the existing records have Active = 1
                $stmtCheckActiveSubject = $conn->prepare("SELECT SubjectCode FROM subjects WHERE SubjectCode = ? AND Active = 1");
                $stmtCheckActiveSubject->bind_param("s", $existingSubjectCode);
                $stmtCheckActiveSubject->execute();
                $resultCheckActiveSubject = $stmtCheckActiveSubject->get_result();

                if ($resultCheckActiveSubject->num_rows > 0) {
                    // There is an active record with the same SubjectCode, display error message and redirect
                    echo '<script>alert("Subject Code ' . $subjectCode . ' already exists and is active.")
                          window.location = "../file_subject.php";
                      </script>';
                    exit();
                }
            }
        }

       
        // Prepare the update query
        $updateQuery = "UPDATE subjects 
                        SET DepartmentID = ?,
                            SubjectCode = ?, 
                            SubjectDescription = ?, 
                            Units = ?
                        WHERE SubjectID = ?";

        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Bind parameters to the statement
        $stmt->bind_param("issii", $departmentTypeNameID, $subjectCode, $subjectDescription, $units, $subjectID);

        // Execute the update query
        if ($stmt->execute()) {
            // Update successful
            // Log the activity
            session_start();
            $loggedInUserID = $_SESSION['UserID'];
            $activity = 'Update Subject: ' . $subjectCode . ' (';

            // Compare updated values with original values
            $originalSubjectData = array();
            $getOriginalDataQuery = "SELECT DepartmentID, SubjectCode, SubjectDescription, Units
                                     FROM subjects
                                     WHERE SubjectID = ?";
            $stmtGetOriginalData = $conn->prepare($getOriginalDataQuery);
            $stmtGetOriginalData->bind_param("i", $subjectID);
            $stmtGetOriginalData->execute();
            $resultGetOriginalData = $stmtGetOriginalData->get_result();

            if ($resultGetOriginalData->num_rows > 0) {
                $originalSubjectData = $resultGetOriginalData->fetch_assoc();
            }

            if ($originalSubjectData['DepartmentID'] !== $departmentTypeNameID) {
                $activity .= 'Department Type: ' . $originalSubjectData['DepartmentID'] . ' -> ' . $departmentTypeNameID . ', ';
            }
            if ($originalSubjectData['SubjectCode'] !== $subjectCode) {
                $activity .= 'Subject Code: ' . $originalSubjectData['SubjectCode'] . ' -> ' . $subjectCode . ', ';
            }
            if ($originalSubjectData['SubjectDescription'] !== $subjectDescription) {
                $activity .= 'Subject Description: ' . $originalSubjectData['SubjectDescription'] . ' -> ' . $subjectDescription . ', ';
            }
            if ($originalSubjectData['Units'] !== $units) {
                $activity .= 'Units: ' . $originalSubjectData['Units'] . ' -> ' . $units . ', ';
            }

            // Fetch the department type name based on the provided departmentTypeNameID
            $sqlGetDepartmentTypeName = "SELECT DepartmentTypeName FROM departmenttypename WHERE DepartmentTypeNameID = ?";
            $stmtGetDepartmentTypeName = $conn->prepare($sqlGetDepartmentTypeName);
            $stmtGetDepartmentTypeName->bind_param("i", $departmentTypeNameID);
            $stmtGetDepartmentTypeName->execute();
            $resultGetDepartmentTypeName = $stmtGetDepartmentTypeName->get_result();

            if ($resultGetDepartmentTypeName->num_rows > 0) {
                $rowDepartmentTypeName = $resultGetDepartmentTypeName->fetch_assoc();
                $departmentTypeName = $rowDepartmentTypeName['DepartmentTypeName'];
                $activity .= 'Department Type Name: ' . $originalSubjectData['DepartmentID'] . ' -> ' . $departmentTypeName . ', ';
            }

            // Remove the trailing comma and space
            $activity = rtrim($activity, ', ') . ')';

            $currentDateTime = date('Y-m-d H:i:s');
            $active = 1;

            $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active) VALUES (?, ?, ?, ?)";
            $stmtLog = $conn->prepare($sqlLog);
            $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
            $resultLog = $stmtLog->execute();
            $stmtLog->close();

            // Redirect back to the file_subject.php page
            header("Location: ../file_subject.php");
            exit();
        } else {
            // Update failed, handle the error (you can show an error message or log the error)
            echo "Error updating record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Subject Type does not exist, display an error message or handle it as per your application's requirement
        echo "Error: Invalid Department.";
    }

    // Close the database connection
    $conn->close();
}
?>
