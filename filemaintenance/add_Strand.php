<?php
require('../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
        $StrandCode = $_POST['StrandCode'];
        $StrandName = $_POST['StrandName'];
        $TrackTypeName = $_POST['TrackType'];
        $specializationID = $_POST['Specialization'];

        // Set Active to 1
        $active = 1;

        // Check if the user is logged in and get the UserID
        session_start();
        if (isset($_SESSION['UserID'])) {
            $loggedInUserID = $_SESSION['UserID'];

            // Check if the selected Specialization exists in the specializations table
            $stmtCheckSpecialization = $conn->prepare("SELECT SpecializationID FROM specializations WHERE SpecializationID = ?");
            $stmtCheckSpecialization->bind_param("i", $specializationID);
            $stmtCheckSpecialization->execute();
            $resultCheckSpecialization = $stmtCheckSpecialization->get_result();

            if ($resultCheckSpecialization->num_rows > 0) {
                // Specialization exists, proceed with inserting the Strand into the strands table

                // Check if the selected StrandCode already exists
                $stmtCheckStrandCode = $conn->prepare("SELECT StrandCode FROM strands WHERE StrandCode = ?");
                $stmtCheckStrandCode->bind_param("s", $StrandCode);
                $stmtCheckStrandCode->execute();
                $resultCheckStrandCode = $stmtCheckStrandCode->get_result();

                if ($resultCheckStrandCode->num_rows > 0) {
                    // StrandCode already exists, check if it exists for the same specialization
                    while ($row = $resultCheckStrandCode->fetch_assoc()) {
                        // Check if the existing strand has the same specialization
                        $existingStrandCode = $row['StrandCode'];
                        $stmtCheckSpecializationMatch = $conn->prepare("SELECT SpecializationID FROM strands WHERE StrandCode = ? AND SpecializationID = ?");
                        $stmtCheckSpecializationMatch->bind_param("si", $existingStrandCode, $specializationID);
                        $stmtCheckSpecializationMatch->execute();
                        $resultCheckSpecializationMatch = $stmtCheckSpecializationMatch->get_result();

                        if ($resultCheckSpecializationMatch->num_rows > 0) {
                            // Strand with the same StrandCode and specialization already exists
                            // echo '<script>alert("Strand Code ' . $StrandCode . ' already exists with the same specialization.\nNote: If you want to update the record, use the edit button.")
                            // window.location = "../file_strand.php";
                            // </script>';
                            // $_SESSION['status'] =  "Strand Code ' . $StrandCode . ' already exists with the same specialization.\nNote: If you want to update the record, use the edit button.";
                            $response = array("error" => true, "message" => "Strand Code ' . $StrandCode . ' already exists with the same specialization.\nNote: If you want to update the record, use the edit button.");
                            echo json_encode($response);
                            exit();
                        }
                    }
                }

                // If you reach this point, the StrandCode either doesn't exist or exists with a different specialization, so insert the new strand
                insertStrand();
                exit();
            } else {
                echo '<script>alert("Invalid Specialization.")
                      window.location = "../file_strand.php";
                      </script>';
                $_SESSION['status'] =  "Invalid Specialization";
                header("Location: ../file_strand.php");
                exit();

            }
        } else {
            echo "User not logged in.";
        }
    
}

function insertStrand() {
    global $conn, $StrandCode, $StrandName, $TrackTypeName, $specializationID, $active, $loggedInUserID;

    $sqlInsert = "INSERT INTO strands (StrandCode, StrandName, TrackTypeName, SpecializationID, Active, CreatedAt) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("sssis", $StrandCode, $StrandName, $TrackTypeName, $specializationID, $active);
    $resultInsert = $stmtInsert->execute();

    if ($resultInsert) {
        if (isset($loggedInUserID)) {
            // Add corresponding records to the 'department' table
            $departmentTypeNameID = 1; // Replace with the appropriate DepartmentTypeNameID
            $StrandID = $stmtInsert->insert_id; // Get the inserted StrandID
            $yearLevels = [11, 11, 12, 12]; // Adjust this array as needed for YearLevels
            $semesters = [1, 2, 1, 2]; // Adjust this array as needed for Semesters

            $sqlInsertDepartment = "INSERT INTO department (DepartmentTypeNameID, YearLevel, Semester, StrandID, Active) VALUES (?, ?, ?, ?, ?)";
            $stmtInsertDepartment = $conn->prepare($sqlInsertDepartment);

            for ($i = 0; $i < count($yearLevels); $i++) {
                $stmtInsertDepartment->bind_param(
                    "iiiii",
                    $departmentTypeNameID,
                    $yearLevels[$i],
                    $semesters[$i],
                    $StrandID,
                    $active
                );
                $resultInsertDepartment = $stmtInsertDepartment->execute();

                if (!$resultInsertDepartment) {
                    // echo '<script>alert("Error adding records to department:' . $stmtInsertDepartment->error . '")
                    //       window.location = "../file_strand.php";
                    //       </script>';
                    // exit();
                   
                    $response = array("error" => true, "message" => "Error adding records to department:" . $stmtInsertDepartment->error);
                    echo json_encode($response);
                    exit();
                }
            }

            $activity = 'Added Strand: ' . $StrandCode;

            // Insert a log entry in the 'logs' table using prepared statements
            $currentDateTime = date('Y-m-d H:i:s');
            $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
            $stmtLog = $conn->prepare($sqlLog);
            $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
            $resultLog = $stmtLog->execute();

            if ($resultLog) {
                $response = array("success" => true, "message" => "Strand added successfully");
                echo json_encode($response);
                exit();
            } else {
                // Failed to add log entry
                // Handle the error as needed
                // echo "Error adding log entry: " . $conn->error;
                $response = array("error" => true, "message" => "Error adding log entry: " . $conn->error);
                echo json_encode($response);
            }
            // $_SESSION['status'] =  "Success";
            $response = array("success" => true, "message" => "Strand added successfully");
            echo json_encode($response);
            exit();
        }
    } else {
        // echo '<script>alert("Error adding strand: ' . $conn->error . '")
        //       window.location = "../file_strand.php";
        //       </script>';
        $response = array("error" => true, "message" => "Error adding strand: " . mysqli_stmt_error($stmt));
        echo json_encode($response);
        exit();
    }
}
?>
