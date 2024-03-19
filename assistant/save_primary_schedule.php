<?php
require('../config/db_connection.php');
include('../security.php');

function existschedule($conn, $subjectID, $sectionID) {
    $query = "SELECT SUM(
                TIME_TO_SEC(TIMEDIFF(Time_End, Time_Start)) *
                (is_Monday + is_Tuesday + is_Wednesday + is_Thursday + is_Friday)
            ) AS total_duration 
            FROM classschedules 
            WHERE SubjectID = '$subjectID' AND SectionID = '$sectionID'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        // Convert seconds to minutes
        $totalDurationMinutes = $row['total_duration'] / 60;
        return $totalDurationMinutes;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $scheduleDataArray = $_POST['data'];
    $response = array();
    $insertionStatus = 'success'; // Default status

        // Array to store total minutes per subject
        $subjectMinutes = array();

        // Variable to track if there's an error
        $hasError = false;
    
        // Iterate through schedule data to calculate total minutes per subject
        foreach ($scheduleDataArray as $scheduleData) {
            $subjectID = mysqli_real_escape_string($conn, $scheduleData['Subject']);
    
            // Calculate total minutes for the current schedule entry
            $start = strtotime($scheduleData['Time_Start']);
            $end = strtotime($scheduleData['Time_End']);
            $totalMinutes = ($end - $start) / 60 * count(explode(',', $scheduleData['Day']));
    
            // Store the total minutes for the subject
            if (array_key_exists($subjectID, $subjectMinutes)) {
                $subjectMinutes[$subjectID] += $totalMinutes;
            } else {
                $subjectMinutes[$subjectID] = $totalMinutes;
            }
        }
    
        // Check if subjectMinutes is greater than MinutesPerWeek for each subject
        foreach ($subjectMinutes as $subject => $totalMinutes) {
            // Retrieve the MinutesPerWeek for the subject from the database
            $subjectID = mysqli_real_escape_string($conn, $subject);
            $sectionID = mysqli_real_escape_string($conn, $scheduleData['Section']);
            $query = "SELECT MinutesPerWeek, SubjectName FROM subjects WHERE SubjectID = '$subjectID'";
            $result = mysqli_query($conn, $query);

            // Get the total duration of the existing schedule
            $existingTotalDuration = existschedule($conn, $subjectID, $sectionID);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $units = $row['MinutesPerWeek'];
                $subjectName = $row['SubjectName'];
                // Check if totalMinutes exceeds MinutesPerWeek
                if ($existingTotalDuration + $totalMinutes > $units) {
                    // Error: totalMinutes exceeds MinutesPerWeek for the subject
                    $hasError = true;
                    $response[] = array(
                        'status' => 'warning',
                        'message' => $subjectName . ' exceeds ' . $units . ' minutes per week',
                    );
                }
            }
        }
    
        // If there's an error, return the response and exit
        if ($hasError) {
            header('Content-Type: application/json');
            echo json_encode($response);
            mysqli_close($conn);
            exit;
        }
    

    foreach ($scheduleDataArray as $scheduleData) {
        // Get the total duration of the existing schedule
 
        // Check for conflicting schedules
        $inputTimeStart = date('H:i:s', strtotime($scheduleData['Time_Start']));
        $inputTimeEnd = date('H:i:s', strtotime($scheduleData['Time_End']));
        $subjectID = mysqli_real_escape_string($conn, $scheduleData['Subject']);
        $sectionID = mysqli_real_escape_string($conn, $scheduleData['Section']);

        // Check for conflicting schedules with the same subject and time
        $conflictQuery = "SELECT cs.*, sj.SubjectName, s.SectionName, sj.MinutesPerWeek FROM classschedules cs
            INNER JOIN subjects sj ON cs.SubjectID = sj.SubjectID
            INNER JOIN classsections s ON cs.SectionID = s.SectionID
            WHERE cs.SubjectID = '$subjectID' AND 
            cs.SectionID = '$sectionID' AND (
                        ('$inputTimeStart' >= cs.Time_Start AND '$inputTimeStart' < cs.Time_End)
                        OR ('$inputTimeEnd' > cs.Time_Start AND '$inputTimeEnd' <= cs.Time_End)
                        OR ('$inputTimeStart' <= cs.Time_Start AND '$inputTimeEnd' >= cs.Time_End)
                    )";
        
        $conflictResult = mysqli_query($conn, $conflictQuery);

        if (mysqli_num_rows($conflictResult) > 0) {
            // Conflicting schedule found
            $conflictingSchedule = mysqli_fetch_assoc($conflictResult);
            $insertionStatus = 'error';
            $response[] = array(
                'status' => 'warning',
                'message' => 'The subject '. $conflictingSchedule['SubjectName'] . ' already exists in the schedule from ' . date('h:i A', strtotime($conflictingSchedule['Time_Start'])) . ' to ' . date('h:i A', strtotime($conflictingSchedule['Time_End'])) . '.'
            );
        } else {
            // No conflicting schedules with the same subject and time, proceed with checking section's schedule
            // No conflicting schedules with the same subject and time, proceed with checking section's schedule
$selectedDays = explode(',', $scheduleData['Day']);

// Determine the conflicting day based on user selection
$conflictingDay = '';
if (in_array('M', $selectedDays)) $conflictingDay = 'Monday';
elseif (in_array('T', $selectedDays)) $conflictingDay = 'Tuesday';
elseif (in_array('W', $selectedDays)) $conflictingDay = 'Wednesday';
elseif (in_array('TH', $selectedDays)) $conflictingDay = 'Thursday';
elseif (in_array('F', $selectedDays)) $conflictingDay = 'Friday';

// Build the SQL query to check for conflicting schedules
$conflictQuery = "SELECT cs.*, s.SectionName, d.GradeLevel FROM classschedules cs 
    JOIN classsections s ON cs.SectionID = s.SectionID
    JOIN departments d ON cs.DepartmentID = d.DepartmentID
    WHERE cs.SectionID = '$sectionID' AND
    (
        (
            ('$inputTimeStart' >= cs.Time_Start AND '$inputTimeStart' < cs.Time_End)
            OR ('$inputTimeEnd' > cs.Time_Start AND '$inputTimeEnd' <= cs.Time_End)
            OR ('$inputTimeStart' <= cs.Time_Start AND '$inputTimeEnd' >= cs.Time_End)
        )
        AND (
            (cs.is_Monday = '1' AND 'M' IN ('" . implode("','", $selectedDays) . "'))
            OR (cs.is_Tuesday = '1' AND 'T' IN ('" . implode("','", $selectedDays) . "'))
            OR (cs.is_Wednesday = '1' AND 'W' IN ('" . implode("','", $selectedDays) . "'))
            OR (cs.is_Thursday = '1' AND 'TH' IN ('" . implode("','", $selectedDays) . "'))
            OR (cs.is_Friday = '1' AND 'F' IN ('" . implode("','", $selectedDays) . "'))
        )
    )";

$conflictResult = mysqli_query($conn, $conflictQuery);

if (mysqli_num_rows($conflictResult) > 0) {
    // Conflicting schedule found
    $conflictingSchedule = mysqli_fetch_assoc($conflictResult);

    $insertionStatus = 'error';
    $response[] = array(
        'status' => 'warning',
        'message' => 'Grade ' . $conflictingSchedule['GradeLevel'] .  ' Section ' . $conflictingSchedule['SectionName'] . ' is already scheduled at ' . date('h:i A', strtotime($conflictingSchedule['Time_Start'])) . ' - ' . date('h:i A', strtotime($conflictingSchedule['Time_End'])) . ' on ' . $conflictingDay . '.'
    );
} else {
                // No conflict, proceed with insertion
                $academicYear = mysqli_real_escape_string($conn, $scheduleData['AcademicYear']);
                $departmentID = mysqli_real_escape_string($conn, $scheduleData['Department']);
                $sectionID = mysqli_real_escape_string($conn, $scheduleData['Section']);
                $subjectID = mysqli_real_escape_string($conn, $scheduleData['Subject']);
                // Adjust the time format to HH:MM:SS
                $timeStart = date('H:i:s', strtotime($scheduleData['Time_Start']));
                $timeEnd = date('H:i:s', strtotime($scheduleData['Time_End']));

                $monday = in_array('M', explode(',', $scheduleData['Day'])) ? 1 : 0;
                $tuesday = in_array('T', explode(',', $scheduleData['Day'])) ? 1 : 0;
                $wednesday = in_array('W', explode(',', $scheduleData['Day'])) ? 1 : 0;
                $thursday = in_array('TH', explode(',', $scheduleData['Day'])) ? 1 : 0;
                $friday = in_array('F', explode(',', $scheduleData['Day'])) ? 1 : 0;
                $instructorID = mysqli_real_escape_string($conn, $scheduleData['Instructor']);
                $roomID = mysqli_real_escape_string($conn, $scheduleData['Room']);

                // Build the SQL query for insertion
                $sql = "INSERT INTO classschedules (AcademicYear, DepartmentID, SectionID, SubjectID, Time_Start, Time_End, is_Monday, is_Tuesday, is_Wednesday, is_Thursday, is_Friday, InstructorID, RoomID, Active, CreatedAt) 
                        VALUES ('$academicYear', '$departmentID', '$sectionID', '$subjectID', '$timeStart', '$timeEnd', $monday, $tuesday, $wednesday, $thursday, $friday, '$instructorID', '$roomID', 0, NOW())";

                // Execute the SQL query
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    // Error in insertion
                    $insertionStatus = 'error';
                    $response[] = array(
                        'status' => 'error',
                        'message' => 'Error in inserting schedule: ' . mysqli_error($conn)
                    );
                }
            }
        }
    }

    if ($insertionStatus === 'success') {
        // Successful insertion
        $response[] = array(
            'status' => 'success',
            'message' => 'Schedules successfully moved to Draft Schedule.',
        );
    }

    // Return response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    // Close database connection
    mysqli_close($conn);
}
?>
