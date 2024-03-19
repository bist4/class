<?php
// strand-delete.php
require('../../config/db_connection.php');

session_start();

if(isset($_SESSION['UserID'])){
    $loggedInUserID = $_SESSION['UserID'];

    // Check if the form is submitted and StrandID is set
    if (isset($_POST['StrandID'])) {
        // Get the StrandID from the form
        $strandID = $_POST['StrandID'];

        // Retrieve the full name and strand code of the strands before deletion
        $sqlGetStrandInfo = "SELECT StrandName, StrandCode FROM strands WHERE StrandID = ?";
        $stmtGetStrandInfo = $conn->prepare($sqlGetStrandInfo);
        $stmtGetStrandInfo->bind_param("i", $strandID);
        $stmtGetStrandInfo->execute();
        $resultGetStrandInfo = $stmtGetStrandInfo->get_result();
        $row = $resultGetStrandInfo->fetch_assoc();
        $strandNameToDelete = isset($row['StrandName']) ? $row['StrandName'] : 'Unknown';
        $strandCodeToDelete = isset($row['StrandCode']) ? $row['StrandCode'] : 'Unknown';

        // Archive the selected strands by updating the Active field to 0
        $sqlDelete = "UPDATE strands SET Active = 0 WHERE StrandID = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $strandID);
        $resultDelete = $stmtDelete->execute();

        // Check if the DELETE operation was successful
        if ($resultDelete === TRUE) {
            echo "Records were successfully deleted.";
        } else {
            try {
                // Attempt to execute the DELETE statement directly
                $resultDelete = $conn->query($sqlStrandDep);

                if ($resultDelete === FALSE) {
                    throw new mysqli_sql_exception("Error: " . $conn->error);
                }
            } catch (mysqli_sql_exception $ex) {
                // Handle foreign key constraint violation error
                echo '<script>
                    alert("Cannot delete because it has child records!");
                    window.location.href = "../file_strand.php";
                </script>';
                exit();
            }

            echo "Error occurred while deleting records: " . $conn->error;
        }

        // Delete associated records from the 'department' table
        $sqlDeleteDepartment = "DELETE FROM department WHERE StrandID = ?";
        $stmtDeleteDepartment = $conn->prepare($sqlDeleteDepartment);
        $stmtDeleteDepartment->bind_param("i", $strandID);
        $resultDeleteDepartment = $stmtDeleteDepartment->execute();
    
        // Check if the DELETE operation was successful for the department
        if ($resultDeleteDepartment === FALSE) {
            echo "Error occurred while deleting associated department records: " . $conn->error;
            exit();
        }

        // Check if the query was successful and handle the response accordingly
        if ($resultDelete) {
            // $loggedInUserID = 19; // Replace with the actual value of the UserID

            // Check if the UserID exists in the 'users' table
            $sqlUserCheck = "SELECT UserID FROM users WHERE UserID = ?";
            $stmtUserCheck = $conn->prepare($sqlUserCheck);
            $stmtUserCheck->bind_param("i", $loggedInUserID);
            $stmtUserCheck->execute();
            $resultUserCheck = $stmtUserCheck->get_result();
            // Redirect back to the file_strand.php page after successful deletion
            if ($resultUserCheck->num_rows > 0) {
                // Insert a log entry in the 'logs' table
                $activity = 'Delete Strand: ' . $strandNameToDelete . ' (Strand Code: ' . $strandCodeToDelete . ')';
                $currentDateTime = date('Y-m-d H:i:s');
                $active = 1;
                $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                $stmtLog = $conn->prepare($sqlLog);
                $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                $resultLog = $stmtLog->execute();

                if ($resultLog) {
                    echo '<script>
                        alert("Strand Deleted Successfully: ' . $strandNameToDelete . ' (Strand Code: ' . $strandCodeToDelete . ')");
                        </script>';
                    header("Location: ../file_strand.php");
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
}else{
    echo "User is not logged in";
}
?>
