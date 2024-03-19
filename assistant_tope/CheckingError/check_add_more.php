<?php
require('../../config/db_connection.php');

function isSectionAvailable($conn, $section, $day, $timeStart, $timeEnd) {
    $sql = "SELECT * FROM classschedule WHERE Section = ? AND Day = ? AND Active != 3
            AND ((Time_Start >= ? AND Time_Start < ?) OR (Time_End > ? AND Time_End <= ?) OR (Time_Start <= ? AND Time_End >= ?))";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssssss', $section, $day, $timeStart, $timeEnd, $timeStart, $timeEnd, $timeStart, $timeEnd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $numRows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);

        return $numRows === 0;
    } else {
        return false; // Error in statement preparation
    }
}

function isInstructorAvailable($conn, $instructor, $day, $timeStart, $timeEnd) {
    $sql = "SELECT * FROM classschedule WHERE Instructor = ? AND Day = ? AND Active != 3
            AND ((Time_Start >= ? AND Time_Start < ?) OR (Time_End > ? AND Time_End <= ?) OR (Time_Start <= ? AND Time_End >= ?))";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssssss', $instructor, $day, $timeStart, $timeEnd, $timeStart, $timeEnd, $timeStart, $timeEnd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $numRows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);

        return $numRows === 0;
    } else {
        return false; // Error in statement preparation
    }
}

function isRoomAvailable($conn, $room, $day, $timeStart, $timeEnd) {
    $sql = "SELECT * FROM classschedule WHERE Room = ? AND Day = ? AND Active != 3
            AND ((Time_Start >= ? AND Time_Start < ?) OR (Time_End > ? AND Time_End <= ?) OR (Time_Start <= ? AND Time_End >= ?))";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssssss', $room, $day, $timeStart, $timeEnd, $timeStart, $timeEnd, $timeStart, $timeEnd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $numRows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);

        return $numRows === 0;
    } else {
        return false; // Error in statement preparation
    }
}

function calculateTotalHours($startTime, $endTime) {
    $start = strtotime($startTime);
    $end = strtotime($endTime);

    $diff = $end - $start;

    return $diff / (60 * 60);
}

function getExistingTotalHours($conn, $section, $subject) {
    $sql = "SELECT SUM(TIME_TO_SEC(TIMEDIFF(Time_End, Time_Start)))/3600 AS total_hours 
            FROM classschedule 
            WHERE Section = ? AND Subject = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $section, $subject);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $totalHours);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        return ($totalHours) ? $totalHours : 0;
    } else {
        return 0;
    }
}

function mapDayCodeToFullDay($code) {
    switch ($code) {
        case 'M':
            return 'Monday';
        case 'T':
            return 'Tuesday';
        case 'W':
            return 'Wednesday';
        case 'TH':
            return 'Thursday';
        case 'F':
            return 'Friday';
        // Add more cases as needed for other days
        default:
            return $code; // Return the original code if not recognized
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $scheduleDataArray = $_POST['data'];
    $response = array();
    $insertionStatus = 'success'; // Default status

    $canInsert = true; // Track if insertion is allowed

    foreach ($scheduleDataArray as $scheduleData) {
        if ($canInsert) { // Check if insertion is allowed
            $academicYear = $scheduleData['AcademicYear'];
            $department = $scheduleData['Department'];
            $yearLevel = $scheduleData['YearLevel'];
            $days = explode(",", $scheduleData['Day']);
            $timeStart = date("H:i:s", strtotime($scheduleData['Time_Start']));
            $timeEnd = date("H:i:s", strtotime($scheduleData['Time_End']));
            $subject = $scheduleData['Subject'];
            $section = $scheduleData['Section'];
            $instructor = $scheduleData['Instructor'];
            $room = $scheduleData['Room'];
            $active = 0;


            foreach ($days as $day) {
                $fullDay = mapDayCodeToFullDay($day);
                $formattedStartTime = date("h:i A", strtotime($timeStart));
                $formattedEndTime = date("h:i A", strtotime($timeEnd));
                if (!isSectionAvailable($conn, $section, $day, $timeStart, $timeEnd)) {
                    $insertionStatus = 'warning'; // If section is not available, set status to warning
                    $response[] = array(
                        'status' => 'warning',
                        'message' => "The grade $yearLevel section $section is not available on $fullDay at $formattedStartTime to $formattedEndTime."
                    );
                    $canInsert = false; // Set the flag to prevent insertion
                    break 2; // Break both foreach loops
                }
                if (!isInstructorAvailable($conn, $instructor, $day, $timeStart, $timeEnd)) {
                    $insertionStatus = 'warning'; // If Instructor is not available, set status to warning
                    $response[] = array(
                        'status' => 'warning',
                        'message' => "Instructor $instructor is not available on $fullDay at $formattedStartTime to $formattedEndTime."
                    );
                    $canInsert = false; // Set the flag to prevent insertion
                    break 2; // Break both foreach loops
                }
                if (!isRoomAvailable($conn, $room, $day, $timeStart, $timeEnd)) {
                    $insertionStatus = 'warning'; // If Room is not available, set status to warning
                    $response[] = array(
                        'status' => 'warning',
                        'message' => "Room $room is not available on $fullDay at $formattedStartTime to $formattedEndTime."
                    );
                    $canInsert = false; // Set the flag to prevent insertion
                    break 2; // Break both foreach loops
                }

                $totalExistingHours = getExistingTotalHours($conn, $section, $subject);
                $totalScheduledHours = calculateTotalHours($timeStart, $timeEnd);
                $day = count($days);
                $totalHours = $totalExistingHours + $totalScheduledHours * $day;

                // units
                $sqlUnits = "SELECT s.Units 
                             FROM subjects s
                             INNER JOIN department d ON s.DepartmentID = d.DepartmentID
                             WHERE s.SubjectDescription = ? AND d.YearLevel = ?";

                $stmtUnits = $conn->prepare($sqlUnits);
                $stmtUnits->bind_param('si', $subject, $yearLevel);

                if ($stmtUnits->execute()) {
                    $stmtUnits->store_result();
                    $stmtUnits->bind_result($unit);

                    while ($stmtUnits->fetch()) {
                        $minutes = $totalHours * 60;
                        $exist = round($totalExistingHours * 60);
                        $left = $unit - $exist;

                        if ($minutes > $unit) {
                            $insertionStatus = 'warning';
                            $response[] = array(
                                'status' => 'warning',
                                'message' => "The $subject exceed $unit minutes per week. $left minutes left available"
                            );
                            $canInsert = false;
                            break 2;
                        }
                    }

                    $stmtUnits->close();
                } else {
                    // Handle the case where the query fails
                    $insertionStatus = 'warning';
                    $response[] = array(
                        'status' => 'warning',
                        'message' => 'Error executing query for retrieving Units.'
                    );
                    $canInsert = false;
                    break 2;
                }
            }

            // if ($canInsert) {
            //     $insertSql = "INSERT INTO classschedule (AcademicYear, Department, YearLevel, Day, Time_Start, Time_End, Subject, Section, Instructor, Room, Active, CreatedAt)
            //                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

            //     $stmt = mysqli_prepare($conn, $insertSql);

            //     if ($stmt) {
            //         foreach ($days as $day) {
            //             mysqli_stmt_bind_param($stmt, 'ssssssssssi', $academicYear, $department, $yearLevel, $day, $timeStart, $timeEnd, $subject, $section, $instructor, $room, $active);

            //             if (!mysqli_stmt_execute($stmt)) {
            //                 $insertionStatus = 'error'; // If any insertion fails, set status to error
            //                 break 2; // Break both foreach loops
            //             }
            //         }
            //         mysqli_stmt_close($stmt);
            //     } else {
            //         $insertionStatus = 'warning'; // If statement preparation fails, set status to warning
            //     }
            // }
        }
    }

    // if ($insertionStatus === 'success' && $canInsert) {
    //     $response[] = array(
    //         'status' => 'success',
    //         'message' => 'The schedules are added successfully.'
    //     );
    // }

    header('Content-Type: application/json');
    echo json_encode($response);

    mysqli_close($conn);
}
?>
