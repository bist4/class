<?php
include('../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from the form
    $departmentTypeNameID = $_POST['Department'];
    $yearLevel = $_POST['Year_Level'];
    $semester = isset($_POST['Semester']) ? $_POST['Semester'] : null;
    $strandCode = isset($_POST['Strand']) ? $_POST['Strand'] : null;
    $academicYear = date("Y") . "-" . (date("Y") + 1);

    $subjectID = $_POST['Subject'];
    $instructorID = $_POST['Instructor'];

    $selectedDays = $_POST['Day'];

    $timeStart = date("H:i:s", strtotime($_POST['Time_Start'])); // Convert to 24-hour format
    $timeEnd = date("H:i:s", strtotime($_POST['Time_End']));

    $roomID = $_POST['Room'];
    $sectionID = $_POST['Section'];

    $status = 0;
    $active = 1;

    // Convert StrandCode to StrandID
    if ($strandCode !== null) {
        $sqlStrandID = "SELECT StrandID FROM strands WHERE StrandCode = ? AND Active = 1";
        $stmtStrandID = $conn->prepare($sqlStrandID);
        $stmtStrandID->bind_param("s", $strandCode);
        $stmtStrandID->execute();
        $resultStrandID = $stmtStrandID->get_result();

        if ($resultStrandID->num_rows > 0) {
            $rowStrandID = $resultStrandID->fetch_assoc();
            $strandID = $rowStrandID['StrandID'];
        } else {
            echo "Invalid StrandCode or Strand is not active.";
            $stmtStrandID->close();
            $conn->close();
            exit();
        }

        $stmtStrandID->close();
    } else {
        $strandID = null;
    }

    // Check if the combination already exists in the department table
    $sqlCheckDepartmentExistence = "SELECT DepartmentID FROM department WHERE DepartmentTypeNameID = ? AND YearLevel = ? AND (Semester = ? OR Semester IS NULL) AND (StrandID = ? OR StrandID IS NULL)";
    $stmtCheckDepartmentExistence = $conn->prepare($sqlCheckDepartmentExistence);
    $stmtCheckDepartmentExistence->bind_param("iiii", $departmentTypeNameID, $yearLevel, $semester, $strandID);
    $stmtCheckDepartmentExistence->execute();
    $resultCheckDepartmentExistence = $stmtCheckDepartmentExistence->get_result();

    if ($resultCheckDepartmentExistence->num_rows > 0) {
        $row = $resultCheckDepartmentExistence->fetch_assoc();
        $existingDepartmentID = $row['DepartmentID'];

        foreach ($selectedDays as $selectedDay) {
            // Check if the instructor is available at the specified time and day
            $sqlCheckInstructorAvailability = "SELECT * FROM history h
                JOIN instructortimeavailabilities ita ON h.InstructorTimeAvailabilityID = ita.InstructorTimeAvailabilityID
                JOIN instructorpreferredsubject ips ON h.InstructorPreferredSubjectID = ips.InstructorPreferredSubjectID
                WHERE ips.InstructorID = ? 
                AND h.Day = ? 
                AND ((h.Time_Start <= ? AND h.Time_End >= ?) OR (h.Time_Start <= ? AND h.Time_End >= ?))";

            $stmtCheckInstructorAvailability = $conn->prepare($sqlCheckInstructorAvailability);
            $stmtCheckInstructorAvailability->bind_param("iissss", $instructorID, $selectedDay, $timeStart, $timeStart, $timeEnd, $timeEnd);
            $stmtCheckInstructorAvailability->execute();
            $resultCheckInstructorAvailability = $stmtCheckInstructorAvailability->get_result();

            if ($resultCheckInstructorAvailability->num_rows > 0) {
                echo "Instructor is not available at the specified time, day, and room. Please choose a different time, day, or room.";
                exit(); // Stop processing if instructor is not available for any selected day
            }

            // Retrieve Fname and Lname based on InstructorID
            $sqlGetInstructorDetails = "SELECT Fname, Lname FROM instructor WHERE InstructorID = ?";
            $stmtGetInstructorDetails = $conn->prepare($sqlGetInstructorDetails);
            $stmtGetInstructorDetails->bind_param("i", $instructorID);
            $stmtGetInstructorDetails->execute();
            $resultInstructorDetails = $stmtGetInstructorDetails->get_result();

            if ($resultInstructorDetails->num_rows > 0) {
                $rowInstructorDetails = $resultInstructorDetails->fetch_assoc();
                $instructorFname = $rowInstructorDetails['Fname'];
                $instructorLname = $rowInstructorDetails['Lname'];

                $instructorFullName = $instructorFname . ' ' . $instructorLname;

                // Retrieve SubjectDescription based on SubjectID
                $sqlGetSubjectDetails = "SELECT SubjectDescription FROM subjects WHERE SubjectID = ?";
                $stmtGetSubjectDetails = $conn->prepare($sqlGetSubjectDetails);
                $stmtGetSubjectDetails->bind_param("i", $subjectID);
                $stmtGetSubjectDetails->execute();
                $resultSubjectDetails = $stmtGetSubjectDetails->get_result();

                if ($resultSubjectDetails->num_rows > 0) {
                    $rowSubjectDetails = $resultSubjectDetails->fetch_assoc();
                    $subjectDescription = $rowSubjectDetails['SubjectDescription'];

                    // Check for overlapping schedules
                    $sqlCheckOverlap = "SELECT * FROM history 
                        WHERE RoomID = ? 
                        AND Day = ? 
                        AND ((Time_Start <= ? AND Time_End >= ?) OR (Time_Start <= ? AND Time_End >= ?))";
                    $stmtCheckOverlap = $conn->prepare($sqlCheckOverlap);
                    $stmtCheckOverlap->bind_param("ississ", $roomID, $selectedDay, $timeStart, $timeStart, $timeEnd, $timeEnd);
                    $stmtCheckOverlap->execute();
                    $resultCheckOverlap = $stmtCheckOverlap->get_result();

                    if ($resultCheckOverlap->num_rows > 0) {
                        echo "Schedule conflict. Please choose a different time or room.";
                        exit(); // Stop processing if there is a schedule conflict for any selected day
                    }

                    // Check if the combination already exists in the instructorpreferredsubject table
                    $sqlCheckInstructorSubjectExistence = "SELECT InstructorPreferredSubjectID FROM instructorpreferredsubject WHERE InstructorID = ? AND SubjectID = ?";
                    $stmtCheckInstructorSubjectExistence = $conn->prepare($sqlCheckInstructorSubjectExistence);
                    $stmtCheckInstructorSubjectExistence->bind_param("ii", $instructorID, $subjectID);
                    $stmtCheckInstructorSubjectExistence->execute();
                    $resultCheckInstructorSubjectExistence = $stmtCheckInstructorSubjectExistence->get_result();

                    if ($resultCheckInstructorSubjectExistence->num_rows > 0) {
                        $rowInstructorSubjectExistence = $resultCheckInstructorSubjectExistence->fetch_assoc();
                        $instructorPreferredSubjectID = $rowInstructorSubjectExistence['InstructorPreferredSubjectID'];

                        // Check if the combination already exists in the instructortimeavailabilities table
                        $sqlCheckInstructorTimeAvailability = "SELECT InstructorTimeAvailabilityID FROM instructortimeavailabilities WHERE InstructorID = ? AND DaysID = ?";

                        $stmtCheckInstructorTimeAvailability = $conn->prepare($sqlCheckInstructorTimeAvailability);
                        $stmtCheckInstructorTimeAvailability->bind_param("ii", $instructorID, $selectedDay);
                        $stmtCheckInstructorTimeAvailability->execute();
                        $resultCheckInstructorTimeAvailability = $stmtCheckInstructorTimeAvailability->get_result();

                        if ($resultCheckInstructorTimeAvailability->num_rows > 0) {
                            $rowInstructorTimeAvailability = $resultCheckInstructorTimeAvailability->fetch_assoc();
                            $instructorTimeAvailabilityID = $rowInstructorTimeAvailability['InstructorTimeAvailabilityID'];

                            // Check if the combination already exists in the rooms table
                            $sqlCheckRoom = "SELECT RoomID FROM rooms WHERE RoomID = ?";
                            $stmtCheckRoom = $conn->prepare($sqlCheckRoom);
                            $stmtCheckRoom->bind_param("i", $roomID);
                            $stmtCheckRoom->execute();
                            $resultCheckRoomAvailability = $stmtCheckRoom->get_result();

                            if ($resultCheckRoomAvailability->num_rows > 0) {
                                $rowRoomExistence = $resultCheckRoomAvailability->fetch_assoc();
                                $rooms = $rowRoomExistence['RoomID'];

                                $newTimeStart = date("H:i:s", strtotime($_POST['Time_Start'])); // Convert to 24-hour format
                                $newTimeEnd = date("H:i:s", strtotime($_POST['Time_End']));
                                
                                // Check if new time start is less than new time end
                                if ($newTimeStart < $newTimeEnd) {
                                    // Now, you can insert into the history table with YearLevel, Semester, Strand, Subject, Instructor, and InstructorTimeAvailability
                                    $sqlInsertHistory = "INSERT INTO history (DepartmentID, AcademicYear, YearLevel, Semester, Strand, InstructorPreferredSubjectID, Instructor, SubjectDescription, InstructorTimeAvailabilityID, Day, Time_Start, Time_End, RoomID, New_Time_Start, New_Time_End, SectionID, Status, Active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                    $stmtInsertHistory = $conn->prepare($sqlInsertHistory);
                                    $stmtInsertHistory->bind_param("isiisississsissiii", $existingDepartmentID, $academicYear, $yearLevel, $semester, $strandCode, $instructorPreferredSubjectID, $instructorFullName, $subjectDescription, $instructorTimeAvailabilityID, $selectedDay, $timeStart, $timeEnd, $roomID, $newTimeStart, $newTimeEnd, $sectionID, $status, $active);

                                    if ($stmtInsertHistory->execute()) {
                                        // Record inserted successfully for this day
                                    } else {
                                        echo "Error inserting data into history table for $selectedDay: " . $stmtInsertHistory->error;
                                    }

                                    $stmtInsertHistory->close();
                                } else {
                                    echo "New Time Start cannot be equal to New Time End.";
                                }
                            } else {
                                echo "Room not found with RoomID: " . $roomID;
                            }

                            $stmtCheckRoom->close();
                        } else {
                            echo "Instructor time availability not found.";
                        }

                        $stmtCheckInstructorTimeAvailability->close();
                    } else {
                        echo "Combination does not exist in the instructorpreferredsubject table. Cannot insert into history table.";
                    }

                    $stmtCheckInstructorSubjectExistence->close();
                } else {
                    echo "Subject not found with SubjectID: " . $subjectID;
                }

                $stmtGetSubjectDetails->close();
            } else {
                echo "Instructor not found with InstructorID: " . $instructorID;
            }

            $stmtGetInstructorDetails->close();
        }

        // After the loop, you can redirect or perform any other actions as needed
        header("Location: ../create_schedule.php");
        exit();
    } else {
        echo "Combination does not exist in the department table. Cannot insert into history table.";
    }

    $stmtCheckDepartmentExistence->close();
    $conn->close();
}
?>
