<?php
require('../../config/db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $TimeAvail = isset($_POST['TimeAvail']) ? $_POST['TimeAvail'] : [];
    $InstructorID = isset($_POST['InstructorID']) ? $_POST['InstructorID'] : null;

    if ($InstructorID !== null && !empty($TimeAvail)) {
        $existingInstructors = [];
        $success = true;
        $hasDuplicates = false;
        $conflictingDay = ""; // Variable to store conflicting day

        // Initialize an array to hold days' values
        $daysValues = [
            "Monday" => 0,
            "Tuesday" => 0,
            "Wednesday" => 0,
            "Thursday" => 0,
            "Friday" => 0
        ];

        foreach ($TimeAvail as $time) {
            $days = explode(",", $time['Day']); // Split days if provided as a comma-separated string

            $timeStart = date("H:i:s", strtotime($time['TimeStart']));
            $timeEnd = date("H:i:s", strtotime($time['TimeEnd']));

            // Reset daysValues array for each time slot
            foreach ($daysValues as $key => $value) {
                $daysValues[$key] = 0;
            }

            foreach ($days as $day) {
                // Set the value of the day to 1 if it's checked
                $daysValues[$day] = 1;

                // Check for overlapping time slots
                $checkOverlapQuery = "SELECT COUNT(*) as count FROM instructortimeavailabilities 
                                    WHERE is_$day = 1 AND InstructorID = ? AND 
                                    ((Time_Start <= ? AND Time_End >= ?) OR (Time_Start <= ? AND Time_End >= ?))";
                $stmtCheckOverlap = $conn->prepare($checkOverlapQuery);
                $stmtCheckOverlap->bind_param("issss", $InstructorID, $timeStart, $timeStart, $timeEnd, $timeEnd);
                $stmtCheckOverlap->execute();
                $resultCheckOverlap = $stmtCheckOverlap->get_result();
                $rowCheckOverlap = $resultCheckOverlap->fetch_assoc();

                if ($rowCheckOverlap['count'] > 0) {
                    $existingInstructors[] = $day;
                    $hasDuplicates = true;
                    $success = false;
                    $conflictingDay = $day; // Store conflicting day for the alert
                    break 2; // Break both loops
                }
            }

            // Insert the availability into the database
	    $active = 1;            
            $sql = "INSERT INTO instructortimeavailabilities (is_Monday, is_Tuesday, is_Wednesday, is_Thursday, is_Friday, InstructorID, Time_Start, Time_End, Active,CreatedAt) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?,  ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiiiiissi", $daysValues["Monday"], $daysValues["Tuesday"], $daysValues["Wednesday"], $daysValues["Thursday"], $daysValues["Friday"], $InstructorID, $timeStart, $timeEnd, $active);
            $stmt->execute();

            if ($stmt->affected_rows === -1) {
                $success = false;
                break; // Break the loop
            }
        }

        if (!$success) {
            if (!empty($existingInstructors)) {
                echo json_encode([
                    "error" => "Instructor availability for the same day and time already exists.",
                    "existingInstructors" => $existingInstructors
                ]);
            } else {
                echo json_encode(["error" => "Failed to insert data. Please try again."]);
            }
        } else {
            if ($hasDuplicates) {
                echo json_encode([
                    "error" => "Instructor availability for the same day and overlapping time already exists.",
                    "conflictingDay" => $conflictingDay // Include conflicting day in response
                ]);
            } else {
                echo json_encode(["success" => "Instructor Availability added successfully"]);

                // Logging
                if (isset($_SESSION['UserID'])) {
                    $loggedInUserID = $_SESSION['UserID'];

                    foreach ($TimeAvail as $time) {
                        $days = explode(",", $time['Day']); // Split days if provided as a comma-separated string

                        $timeStart = date("H:i:s", strtotime($time['TimeStart']));
                        $timeEnd = date("H:i:s", strtotime($time['TimeEnd']));

                        // Fetch Fname and Mname based on InstructorID from the Instructors table
                        $sqlInstructor = "SELECT usi.Fname, usi.Mname FROM instructor i 
                                          INNER JOIN userinfo usi ON i.UserInfoID = usi.UserInfoID
                                          WHERE i.InstructorID = ?";
                        $stmtInstructor = $conn->prepare($sqlInstructor);
                        $stmtInstructor->bind_param("i", $InstructorID); // Assuming $InstructorID is available in your code
                        $stmtInstructor->execute();
                        $resultInstructor = $stmtInstructor->get_result();
                        $instructorData = $resultInstructor->fetch_assoc();

                        $Fname = $instructorData['Fname'];
                        $Mname = $instructorData['Mname'];

                        $activity = 'Add Instructor Availability: ' . '<br>Instructor: ' . $Fname . ' ' . $Mname . ' <br>Day: (' . implode(", ", $days) . ')<br>Time Start: ' . $timeStart . ', Time End: ' . $timeEnd;
                        $currentDateTime = date('Y-m-d H:i:s');
                        $active = 1;

                        $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                        $stmtLog = $conn->prepare($sqlLog);
                        // Assuming $loggedInUserID is defined elsewhere in your code
                        $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                        $resultLog = $stmtLog->execute();
                    }
                }
            }
        }
    } else {
        echo json_encode(["error" => "Invalid InstructorID or TimeAvail data"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>
