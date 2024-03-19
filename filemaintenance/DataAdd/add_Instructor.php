<?php
include('../../config/db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $departmentIDs = isset($_POST['Department']) ? $_POST['Department'] : [];
    $fname = $_POST['Fname'];
    $mname = $_POST['Mname'];
    $lname = $_POST['Lname'];
    $gender = $_POST['Gender'];
    $birthday = $_POST['Birthday'];
    $address = $_POST['Address'];
    $contactNumber = $_POST['ContactNumber'];
    $email = $_POST['Email'];
    // $specializations = is_array($_POST['Specialization']) ? implode(', ', $_POST['Specialization']) : $_POST['Specialization'];
    $specializations = isset($_POST['Specialization']) ? $_POST['Specialization'] : []; // Assuming $_POST['Specialization'] is a comma-separated string


    $othersSpecialization = isset($_POST['OthersSpecialization']) ? $_POST['OthersSpecialization'] : '';

    // Check if the selected specialization is "Others"
    if ($specializations === 'Others' && !empty($othersSpecialization)) {
        // Use the user's input for the specialization
        $specializations = $othersSpecialization;
    }
    $status = $_POST['Status'];
    $active = 1;
    $createdAt = date('Y-m-d H:i:s');

    $birthDate = new DateTime($birthday);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;

    // Check if the combination of First Name and Last Name exists in the 'instructor' table
    $sqlCheckName = "SELECT * FROM instructor WHERE Fname = ? AND Lname = ?";
    $stmtCheckName = $conn->prepare($sqlCheckName);
    $stmtCheckName->bind_param("ss", $fname, $lname);
    $stmtCheckName->execute();
    $resultCheckName = $stmtCheckName->get_result();

    if ($resultCheckName->num_rows > 0) {
        // First Name and Last Name combination already exists
        $row = $resultCheckName->fetch_assoc();
        $isActive = $row['Active'];
        $existingInstructorID = $row['InstructorID'];

        if ($isActive == 1) {
            echo json_encode(array("warning" => true, "message" => "Name combination ('$fname $lname') already exists."));
            exit();
        } else {
            echo json_encode(array("warning" => true, "message" => "Data with name combination ('$fname $lname') already exists in the trash. You can restore it from the trash."));
            exit();
        }
    }
    // Check if the email already exists for a different instructor
    $sqlCheckEmail = "SELECT * FROM instructor WHERE Email = ? AND (Fname != ? OR Lname != ?)";
    $stmtCheckEmail = $conn->prepare($sqlCheckEmail);
    $stmtCheckEmail->bind_param("sss", $email, $fname, $lname);
    $stmtCheckEmail->execute();
    $resultCheckEmail = $stmtCheckEmail->get_result();

    if ($resultCheckEmail->num_rows > 0) {
        // Email already exists for a different instructor
        echo json_encode(array("warning" => true, "message" => "Email ('$email') already exists for a different instructor."));
        $stmtCheckEmail->close();
        exit();
    }


    // Prepare and execute the insertion query
    $sql = "INSERT INTO instructor (DepartmentID, Fname, Mname, Lname, Gender, Age, Birthday, Address, ContactNumber, Email, Specialization, Status, Active, CreatedAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Adjust the number of placeholders to match the number of bound variables
        $stmt->bind_param("issssisssssss", $departmentID, $fname, $mname, $lname, $gender, $age, $birthday, $address, $contactNumber, $email, $spec, $status, $active);

        foreach ($departmentIDs as $departmentID) {
            // $stmt->execute();

            foreach($specializations as $spec){
                $stmt->execute();
            }
        }

        // Log the activity if the insertion was successful
        if ($stmt->affected_rows > 0) {
            if (isset($_SESSION['UserID'])) {
                $loggedInUserID = $_SESSION['UserID'];
                $activity = 'Added Instructor: ' . $fname . ' ' . $lname; 
                $currentDateTime = date('Y-m-d H:i:s');
                $active = 1;

                $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                $stmtLog = $conn->prepare($sqlLog);
                if ($stmtLog) {
                    $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                    $stmtLog->execute();
                    $stmtLog->close();
                } else {
                    // Handle log statement preparation error
                    echo json_encode(array("success" => false, "message" => "Failed to prepare log statement."));
                    exit;
                }
            }

            $stmt->close();
            $conn->close();

            echo json_encode(array("success" => true, "message" => "Instructor Added Successfully"));
            exit;
        } else {
            // Handle insert statement execution error
            echo json_encode(array("success" => false, "message" => "Failed to add instructor."));
            exit;
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Failed to prepare statement."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
    exit;
}
?>
