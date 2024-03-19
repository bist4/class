<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../../config/db_connection.php'); // Adjust the path to your database connection file

    if (isset($_POST['instructorID'])) {
        $instructorID = $_POST['instructorID'];

        $updatesql = "UPDATE instructor SET Active = 11 WHERE InstructorID = ?";
        $stmt = $conn->prepare($updatesql);

        if ($stmt) {
            foreach ($instructorID as $instructorID) {
                $stmt->bind_param("i", $instructorID);
                $stmt->execute();

                if ($stmt->affected_rows <= 0) {
                    echo "Failed to deactivate instructors.";
                    exit; // Stop further processing if any update fails
                }

                // if (isset($_SESSION['UserID'])) {
                //     $loggedInUserID = $_SESSION['UserID'];

                //     $sqlGetInstructorInfo = "SELECT Fname, Mname, Lname FROM instructor WHERE InstructorID = ?";
                //     $stmtGetInstructorInfo = $conn->prepare($sqlGetInstructorInfo);
                //     $stmtGetInstructorInfo->bind_param("i", $instructorID);
                //     $stmtGetInstructorInfo->execute();
                //     $resultGetInstructorInfo = $stmtGetInstructorInfo->get_result();
                //     $row = $resultGetInstructorInfo->fetch_assoc();

                //     $fnameToDelete = isset($row['Fname']) ? $row['Fname'] : '';
                //     $mnameToDelete = isset($row['Mname']) ? $row['Mname'] : '';
                //     $lnameToDelete = isset($row['Lname']) ? $row['Lname'] : '';

                //     $activity = 'Delete Instructor: ' . $fnameToDelete . ' ' . $mnameToDelete . ' ' . $lnameToDelete;
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

            echo '<script>alert("Instructor(s) Deleted Successfully");</script>';
            header("Location: ../file_instructor.php");
            exit();
        } else {
            echo "Error in preparing SQL statement: " . $conn->error;
        }
    } else {
        echo "No Instructor IDs provided!";
    }
}
?>
