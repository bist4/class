<?php
// Include your database connection
include('../config/db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $instructorID = $_POST['InstructorID'];
    $departments = $_POST['Department'];
    $fname = $_POST['Fname'];
    $mname = $_POST['Mname'];
    $lname = $_POST['Lname'];
    $gender = $_POST['Gender'];
    $birthday = $_POST['Birthday'];
    $address = $_POST['Address'];
    $contactNumber = $_POST['ContactNumber'];
    $email = $_POST['Email'];
    $specializations = $_POST['Specialization'];
    $status = $_POST['Status'];

    // Compute age from birthday (assuming date format YYYY-MM-DD)
    $birthdate = new DateTime($birthday);
    $today = new DateTime();
    $age = $birthdate->diff($today)->y;

    // Check if the combination of First Name and Last Name exists in the 'instructor' table
    $sqlCheckName = "SELECT * FROM instructor WHERE Fname = ? AND Lname = ?";
    $stmtCheckName = $conn->prepare($sqlCheckName);
    $stmtCheckName->bind_param("ss", $fname, $lname);
    $stmtCheckName->execute();
    $resultCheckName = $stmtCheckName->get_result();

    // Check if the email already exists for a different instructor
    $sqlCheckEmail = "SELECT * FROM instructor WHERE Email = ? AND (Fname != ? OR Lname != ?)";
    $stmtCheckEmail = $conn->prepare($sqlCheckEmail);
    $stmtCheckEmail->bind_param("sss", $email, $fname, $lname);
    $stmtCheckEmail->execute();
    $resultCheckEmail = $stmtCheckEmail->get_result();

    if ($resultCheckName->num_rows === 0 || $resultCheckEmail->num_rows === 0) {
        // Check if the data to be updated is different from the existing data in the database
        $checkExistingDataSql = "SELECT * FROM instructor WHERE InstructorID = ?";
        $stmtExistingData = $conn->prepare($checkExistingDataSql);
        $stmtExistingData->bind_param("i", $instructorID);
        $stmtExistingData->execute();
        $resultExistingData = $stmtExistingData->get_result();

        // Fetch the existing data
        $existingData = $resultExistingData->fetch_assoc();

        // Compare the existing data with the new data
        if ($existingData['Fname'] === $fname && $existingData['Lname'] === $lname && $existingData['Email'] === $email /* Add other relevant comparisons */) {
            echo json_encode(array("success" => true, "message" => "No changes detected. Data remains the same."));
            exit(); // Exit script, as no changes are needed
        }

        // Proceed with the update as the data is different
        $updateSql = "UPDATE instructor SET DepartmentID = ?, Fname = ?, Mname = ?, Lname = ?, Gender = ?, Age = ?, Birthday = ?, Address = ?, ContactNumber = ?, Email = ?, Specialization = ?, Status = ? WHERE InstructorID = ?";

        $stmt = mysqli_prepare($conn, $updateSql);

        // Ensure $departments and $specializations are arrays before imploding
        $departmentString = is_array($departments) ? implode(',', $departments) : $departments;
        $specializationString = is_array($specializations) ? implode(',', $specializations) : $specializations;

        mysqli_stmt_bind_param($stmt, "issssississsi", $departmentString, $fname, $mname, $lname, $gender, $age, $birthday, $address, $contactNumber, $email, $specializationString, $status, $instructorID);

        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($conn));
        }

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo json_encode(array("success" => true, "message" => "Instructor Updated Successfully"));
            } else {
                echo json_encode(array("error" => true, "message" => "No changes made. Check if the provided ID exists or the data is the same as before."));
            }
        } else {
            echo json_encode(array("error" => true, "message" => "Error updating record: " . mysqli_error($conn)));
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(array("error" => true, "message" => "The provided name or email already exists. Please use different details."));
    }

    mysqli_close($conn);
}
?>
