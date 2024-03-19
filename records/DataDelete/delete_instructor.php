<?php
// subject-delete.php
require('../../config/db_connection.php');

session_start();
if (isset($_SESSION['UserID'])) {
    $loggedInUserID = $_SESSION['UserID'];

    // Check if the form is submitted and InstructorID is set
    if (isset($_POST['InstructorID'])) {
        // Get the InstructorID from the form
        $instructorID = $_POST['InstructorID'];
        $FirstName = $_POST['Fname'];
        $Middlename = $_POST['Mname'];
        $LastName = $_POST['Lname'];
        

        // Retrieve the full name and subject code of the instructor before deletion
        $sqlGetSubjectInfo = "SELECT Fname, Mname, Lname FROM instructor WHERE InstructorID = ?";
        $stmtGetSubjectInfo = $conn->prepare($sqlGetSubjectInfo);
        $stmtGetSubjectInfo->bind_param("i", $instructorID);
        $stmtGetSubjectInfo->execute();
        $resultGetSubjectInfo = $stmtGetSubjectInfo->get_result();
        $row = $resultGetSubjectInfo->fetch_assoc();
        $fnameTodelete = isset($row['Fname']) ? $row['Fname'] : ' -> ' . $FirstName . ', ';
        $mnameTodelete = isset($row['Mname']) ? $row['Mname'] : ' -> ' . $MiddleName . ', ';
        $lnameTodelete = isset($row['Lname']) ? $row['Lname'] : ' -> ' . $FirstName . ', ';

        


        // Archive the selected instructor by updating the Active field to 0
        // Assuming you have a table called 'instructor' with a column 'Active'
        $sqlDelete = "UPDATE instructor SET Active = 0 WHERE InstructorID = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $instructorID);
        $resultDelete = $stmtDelete->execute();

        // Check if the query was successful and handle the response accordingly
        if ($resultDelete) {
            // Check if the UserID exists in the 'users' table
            $sqlUserCheck = "SELECT UserID FROM users WHERE UserID = ?";
            $stmtUserCheck = $conn->prepare($sqlUserCheck);
            $stmtUserCheck->bind_param("i", $loggedInUserID);
            $stmtUserCheck->execute();
            $resultUserCheck = $stmtUserCheck->get_result();
            // Redirect back to the file-subject.php page after successful deletion
            if ($resultUserCheck->num_rows > 0) {
                // Insert a log entry in the 'logs' table
                $activity = 'Delete Instructor: ' . $fnameTodelete . ' ' . $mnameTodelete . ' ' .$lnameTodelete. '';
                $currentDateTime = date('Y-m-d H:i:s');
                $active = 1;
                $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                $stmtLog = $conn->prepare($sqlLog);
                $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                $resultLog = $stmtLog->execute();

                if ($resultLog) {
                    echo '<script>
                        alert("Subject Deleted Successfully: ' . $fnameTodelete . ' (Subject Code: ' . $mnameTodelete . ')");
                        </script>';
                    header("Location: ../file_instructor.php");
                    exit();
                } else {
                    // Failed to add log entry
                    // Handle the error as needed
                    echo "Error adding log entry: " . $conn->error;
                }
            } else {
                // Invalid UserID, handle the error as needed
                echo "Invalid UserID.";
            }
        } else {
            // Handle the error if the query failed
            echo "Error: " . $stmtDelete->error;
        }
    }
}else {
    // If the user is not logged in, you can redirect them to a login page or display a message
    echo "User is not logged in.";
    // You might want to add a header("Location: login.php"); to redirect the user to a login page
}
?>
