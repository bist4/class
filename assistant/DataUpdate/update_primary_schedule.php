<?php
require('../../config/db_connection.php');
include('../../security.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $classScheduleData = $_POST['classScheduleData'];
    $response = array();

    // Array to store total minutes per subject
    $subjectMinutes = array();

    // Variable to track if there's an error
    $hasError = false;

    // Iterate through schedule data to calculate total minutes per subject
    foreach ($classScheduleData as $scheduleData) {
        $subjectID = mysqli_real_escape_string($conn, $scheduleData['Subject']);

        // Calculate total minutes for the current schedule entry
        $start = strtotime($scheduleData['TimeStart']);
        $end = strtotime($scheduleData['TimeEnd']);
        $totalMinutes = ($end - $start) / 60 * count(explode(',', $scheduleData['Day']));

        // Store the total minutes for the subject
        if (array_key_exists($subjectID, $subjectMinutes)) {
            $subjectMinutes[$subjectID] += $totalMinutes;
        } else {
            $subjectMinutes[$subjectID] = $totalMinutes;
        }
    }

    // Check if subjectMinutes is greater than MinutesPerWeek for each subject
    foreach ($subjectMinutes as $subjectID => $totalMinutes) {
        // Retrieve the MinutesPerWeek for the subject from the database
        $subjectID = mysqli_real_escape_string($conn, $subjectID);
        $query = "SELECT MinutesPerWeek, SubjectName FROM subjects WHERE SubjectID = '$subjectID'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $units = $row['MinutesPerWeek'];
            $subjectDescription = $row['SubjectName'];

            // Check if totalMinutes exceeds MinutesPerWeek
            if ($totalMinutes > $units) {
                // Error: totalMinutes exceeds MinutesPerWeek for the subject
                $hasError = true;
                $response[] = array(
                    'status' => 'warning',
                    'message' => $subjectDescription . ' exceeds ' . $units . ' minutes per week',
                );
            }
        }
    }
    foreach ($classScheduleData as $rowData) {
        // Retrieve selected days for the current row
        $selectedDays = explode(',', $rowData['Day']);
        
        // Flag to track if overlap has been found for this row
        $overlapFound = false;
    
        foreach ($selectedDays as $day) {
            // Determine the conflicting day based on user selection
            switch ($day) {
                case 'M':
                    $conflictingDay = 'Monday';
                    break;
                case 'T':
                    $conflictingDay = 'Tuesday';
                    break;
                case 'W':
                    $conflictingDay = 'Wednesday';
                    break;
                case 'TH':
                    $conflictingDay = 'Thursday';
                    break;
                case 'F':
                    $conflictingDay = 'Friday';
                    break;
                default:
                    $conflictingDay = '';
                    break;
            }
    
            $classScheduleID = $rowData['ClasscheduleID'];
            $sectionID = $rowData['SectionID'];
            $inputTimeStart = date("H:i:s", strtotime($rowData['TimeStart']));
            $inputTimeEnd = date("H:i:s", strtotime($rowData['TimeEnd']));
    
            // Construct selected IDs for exclusion
            $selectedIDs = array_map(function($rowData) {
                return $rowData['ClasscheduleID'];
            }, $classScheduleData);
            $selectedIDs = implode(',', $selectedIDs);
    
            // Query to check for overlapping time ranges
            $overlapQuery = "SELECT ClassScheduleID, SectionID FROM classschedules cs
                             WHERE (('$inputTimeStart' >= cs.Time_Start AND '$inputTimeStart' < cs.Time_End)
                                OR ('$inputTimeEnd' > cs.Time_Start AND '$inputTimeEnd' <= cs.Time_End)
                                OR ('$inputTimeStart' <= cs.Time_Start AND '$inputTimeEnd' >= cs.Time_End))
                                AND ClassScheduleID NOT IN ($selectedIDs)
                                AND SectionID = $sectionID
                                AND (
                                    (cs.is_Monday = '1' AND '$day' = 'M')
                                    OR (cs.is_Tuesday = '1' AND '$day' = 'T')
                                    OR (cs.is_Wednesday = '1' AND '$day' = 'W')
                                    OR (cs.is_Thursday = '1' AND '$day' = 'TH')
                                    OR (cs.is_Friday = '1' AND '$day' = 'F')
                                )";
    
            // Execute the query
            $overlapResult = mysqli_query($conn, $overlapQuery);
    
            if ($overlapResult && mysqli_num_rows($overlapResult) > 0 && !$overlapFound) {
                // Error: overlapping time ranges found
                $hasError = true;
                $overlapFound = true; // Set flag to true to avoid multiple messages
                $response[] = array(
                    'status' => 'warning',
                    'message' => date("h:iA", strtotime($rowData['TimeStart'])) . ' - ' . date("h:iA", strtotime($rowData['TimeEnd'])) . ' already taken on ' . $conflictingDay . '.',
                );
            }
        }
    }
    
    

    if ($hasError) {
        // Return the response containing warnings/errors
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        // No error, proceed with updating the schedule data
        $updateSuccess = true; // Flag to track if any update fails
        $updateMessages = array(); // Array to store update messages

        foreach ($classScheduleData as $rowData) {
            // Update the schedule data in the database
            $classScheduleID = $rowData['ClasscheduleID'];
            $roomID = $rowData['Room'];
            $subjectID = $rowData['Subject'];
            $instructorID = $rowData['Instructor'];
            $timeStart = $rowData['TimeStart'];
            $timeEnd = $rowData['TimeEnd'];

            // Convert time format
            $convertedTimeStart = date("H:i:s", strtotime($timeStart));
            $convertedTimeEnd = date("H:i:s", strtotime($timeEnd));

            $days = explode(',', $rowData['Day']);
            $monday = in_array('M', $days) ? 1 : 0;
            $tuesday = in_array('T', $days) ? 1 : 0;
            $wednesday = in_array('W', $days) ? 1 : 0;
            $thursday = in_array('TH', $days) ? 1 : 0;
            $friday = in_array('F', $days) ? 1 : 0;

            $updateQuery = "UPDATE classschedules SET InstructorID = $instructorID, RoomID = $roomID, SubjectID = $subjectID, Time_Start = '$convertedTimeStart', Time_End = '$convertedTimeEnd', is_Monday = $monday, is_Tuesday = $tuesday, is_Wednesday = $wednesday, is_Thursday = $thursday, is_Friday = $friday WHERE ClassScheduleID = $classScheduleID";

            $success = mysqli_query($conn, $updateQuery);

            if ($success) {
                // Add success message to update messages array
                $updateMessages[] = "Successfully updated schedule for ClassScheduleID: $classScheduleID";
            } else {
                $updateSuccess = false; // Set flag to false if update fails
                $response[] = array(
                    'status' => 'error',
                    'message' => "Error updating room for ClasscheduleID: $classScheduleID",
                );
            }
        }

        if ($updateSuccess) {
            // Add success message to response
            $response[] = array(
                'status' => 'success',
                'message' => 'Update successfully!',
            );
        } else {
            // Add update messages to response
            foreach ($updateMessages as $message) {
                $response[] = array(
                    'status' => 'success',
                    'message' => $message,
                );
            }
        }

        // Return the response
        header('Content-Type: application/json');
        echo json_encode($response);

        // Close database connection
        mysqli_close($conn);
    }
} else {
    // Invalid request method
    echo "Invalid request method";
}
?>
