<!-- <php
include('../../config/db_connection.php');

// Check if the subject is set in the POST request
if(isset($_POST['subject'])) {
    $subject = $_POST['subject'];

    // Fetch distinct instructor names for the selected subject and DepartmentID 3 from the database
    $sqlInstructors = "SELECT DISTINCT i.Fname, i.Lname
                       FROM instructor i
                       JOIN subjects s ON i.Specialization = s.Classification
                       WHERE s.SubjectDescription = '$subject' AND i.DepartmentID = 1 AND i.Active = 1";

    $resultInstructors = $conn->query($sqlInstructors);

    // Output the default option with "Select Instructor"
    echo '<option value="" disabled selected>Select Instructor</option>';

    while ($instructorData = $resultInstructors->fetch_assoc()) {
        $fullName = $instructorData['Fname'] . ' ' . $instructorData['Lname'];
        echo '<option value="' . $fullName . '">' . $fullName . '</option>';
    }
}
?> -->
<?php
include('../../config/db_connection.php');

// Check if the subject is set in the POST request
if (isset($_POST['subject'])) {
    $subject = $_POST['subject'];
    $timeStart = $_POST['timeStart'];
    $timeEnd = $_POST['timeEnd'];
    $selectedDays = $_POST['selectedDays'];

    // Convert input time to match the database format
    $inputTimeStart = date('H:i:s', strtotime($timeStart));
    $inputTimeEnd = date('H:i:s', strtotime($timeEnd));
    
    echo '<option value="" disabled selected>Select Instructor</option>';
    echo '</optgroup>';

    // Fetch distinct Full Time instructor names for the selected subject
    $sqlInstructorsFullTime = "SELECT DISTINCT i.Fname, i.Lname
                               FROM instructor i
                               JOIN subjects s ON i.Specialization = s.Classification
                               WHERE s.SubjectDescription = '$subject' 
                               AND i.DepartmentID = 1 
                               AND i.Active = 1  
                               AND i.Status = 'Full Time'
                               AND NOT EXISTS (
                                   SELECT 1
                                   FROM classschedule cs
                                   WHERE cs.Instructor = CONCAT(i.Fname, ' ', i.Lname)
                                   AND cs.Day IN ('" . implode("','", $selectedDays) . "')
                                   AND Active != 3
                                   AND (
                                       (cs.Time_Start >= '$timeStart' AND cs.Time_Start < '$timeEnd') 
                                       OR (cs.Time_End > '$timeStart' AND cs.Time_End <= '$timeEnd') 
                                       OR (cs.Time_Start <= '$timeStart' AND cs.Time_End >= '$timeEnd')
                                   )
                               )";

    $resultInstructorsFullTime = $conn->query($sqlInstructorsFullTime);

    // Output the Full Time Instructors
    echo '<optgroup label="Full Time">';
    if ($resultInstructorsFullTime->num_rows > 0) {
        while ($instructorData = $resultInstructorsFullTime->fetch_assoc()) {
            $fullName = $instructorData['Fname'] . ' ' . $instructorData['Lname'];
            echo '<option value="' . $fullName . '">' . $fullName . '</option>';
        }
    } else {
        echo '<option value="" disabled>No instructor</option>';
    }
    echo '</optgroup>';

    // Fetch distinct Part Time instructor names for the selected subject, day, and time
    $sqlInstructorsPartTime = "SELECT DISTINCT i.Fname, i.Lname
    FROM instructor i
    JOIN subjects s ON i.Specialization = s.Classification
    JOIN instructortimeavailabilities ita ON i.InstructorID = ita.InstructorID
    WHERE s.SubjectDescription = '$subject' 
    AND i.DepartmentID = 1 
    AND i.Active = 1  
    AND i.Status = 'Part Time'
    AND ita.Day IN ('" . implode("','", $selectedDays) . "')
    AND Active != 3
    AND (
        ('$inputTimeStart' >= ita.Time_Start AND '$inputTimeEnd' <= ita.Time_End  )
    )     
    AND NOT EXISTS (
        SELECT 1
        FROM classschedule cs
        WHERE cs.Instructor = CONCAT(i.Fname, ' ', i.Lname)
        AND cs.Day IN ('" . implode("','", $selectedDays) . "')
        AND (
            (cs.Time_Start >= '$timeStart' AND cs.Time_Start < '$timeEnd') 
            OR (cs.Time_End > '$timeStart' AND cs.Time_End <= '$timeEnd') 
            OR (cs.Time_Start <= '$timeStart' AND cs.Time_End >= '$timeEnd')
        )
    )
    GROUP BY i.InstructorID
    HAVING COUNT(DISTINCT ita.Day) = " . count($selectedDays);

    $resultInstructorsPartTime = $conn->query($sqlInstructorsPartTime);

    // Output the Part Time Instructors
    echo '<optgroup label="Part Time">';
    if ($resultInstructorsPartTime->num_rows > 0) {
        while ($instructorData = $resultInstructorsPartTime->fetch_assoc()) {
            $fullName = $instructorData['Fname'] . ' ' . $instructorData['Lname'];
            echo '<option value="' . $fullName . '">' . $fullName . '</option>';
        }
    } else {
        echo '<option value="" disabled>No instructor</option>';
    }
    echo '</optgroup>';
}
?>





