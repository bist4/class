<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../../config/db_connection.php'); // Include your database conn file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_POST['UserID'][0];

    // Extracting other form data
    $fname = $_POST['Fname'][0];
    $mname = $_POST['Mname'][0];
    $lname = $_POST['Lname'][0];
    $gender = $_POST['Gender'][0];
    $birthdate = $_POST['Birthday'][0];
    $address = $_POST['Address'][0];
    $contactNumber = $_POST['ContactNumber'][0];
    // $email = $_POST['Email'][0];
    $specializations = implode(', ', $_POST['Specialization']);
    $status = $_POST['Status'][0];

    // Calculate age based on birthdate
    $birthdateObj = new DateTime($birthdate);
    $currentDate = new DateTime();
    $age = $birthdateObj->diff($currentDate)->y;

    // $activity = "Update Instructor: " . '' .$fname. ' ' .$lname;
    // $loggedInUserID = $_SESSION['UserID'];
    // $currentDateTime = date('Y-m-d H:i:s');
    // $active = 1;

    // $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
    // $stmtLog = $conn->prepare($sqlLog);
    // $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
    // $resultLog = $stmtLog->execute();
    // $stmtLog->close();


    // Update query with prepared statement
    $updateQuery = "UPDATE userinfo SET
                    Fname = ?,
                    Mname = ?,
                    Lname = ?,
                    Gender = ?,
                    Age = ?,
                    BirthDate = ?,
                    Address = ?,
                    ContactNumber = ?,
                    
                    Specialization = ?,
                    Status = ?
                    WHERE UserID = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $updateQuery);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssisssssi", $fname, $mname, $lname, $gender, $age, $birthdate, $address, $contactNumber,  $specializations, $status, $userID);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Log the activity
         
        $response = ['success' => 'Instructor information updated successfully.'];
    } else {
        $response = ['error' => 'Failed to update instructor information.'];
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    // Return the response as JSON
    echo json_encode($response);
} else {
    // Handle the case where the request method is not POST
    $response = ['error' => 'Invalid request method.'];
    echo json_encode($response);
}

?>
