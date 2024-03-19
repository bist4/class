<?php
include('../../config/db_connection.php');

// Check if the required data is set in the POST request
if (isset($_POST['subject']) && isset($_POST['timeStart']) && isset($_POST['timeEnd']) && isset($_POST['selectedDays'])) {
    $subject = $_POST['subject'];
    $timeStart = $_POST['timeStart'];
    $timeEnd = $_POST['timeEnd'];
    $selectedDays = $_POST['selectedDays'];


    // Convert input time to match the database format
    $inputTimeStart = date('H:i:s', strtotime($timeStart));
    $inputTimeEnd = date('H:i:s', strtotime($timeEnd));

    // Assuming userinfo table structure has fields 'Fname' and 'Lname'
    $query = "SELECT DISTINCT ur.UserRoleID, usi.Fname, usi.Lname 
            FROM userinfo usi
            INNER JOIN userroles ur ON usi.UserInfoID = ur.UserID
            WHERE ur.RoleID = 4
            AND NOT EXISTS (
                SELECT 1
                FROM classschedule cs
                WHERE cs.InstructorID = ur.UserRoleID                 
            )";


    // Execute the query
    $result = $conn->query($query);

    // Fetch the data and send it back as options for the dropdown
    $options = '';
    echo '<option value="" disabled selected>Select Instructor</option>';
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['UserRoleID'] . '">' . $row['Fname'] . ' ' . $row['Lname'] . '</option>';
    }

    echo $options;

    // Close the database connection
    $conn->close();
} else {
    // Handle invalid or missing parameters
    echo "Invalid or missing parameters";
}
?>

<!-- <php
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
    // AND NOT EXISTS (
    //     SELECT 1
    //     FROM classschedule cs
    //     WHERE cs.InstructorID = u.UserID
    //     AND Active != 3
    //     AND cs.Day IN ('" . implode("','", $selectedDays) . "')
    //     AND (
    //          ('$inputTimeStart' >= cs.Time_Start AND '$inputTimeStart' < cs.Time_End)
    //          OR ('$inputTimeEnd' > cs.Time_Start AND '$inputTimeEnd' <= cs.Time_End)
    //          OR ('$inputTimeStart' <= cs.Time_Start AND '$inputTimeEnd' >= cs.Time_End)
    //      )
    // )

    // Fetch distinct Full Time instructor names for the selected subject
    $sqlInstructorsFullTime = "SELECT DISTINCT u.*
                               FROM users u
                               WHERE s.SubjectID = '$subject' 
                               AND u.DepartmentID = 3 
                               AND u.Active = 1  
                               AND u.Status = 'Full Time'";

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
    AND i.DepartmentID = 3 
    AND i.Active = 1  
    AND i.Status = 'Part Time'
    AND ita.Day IN ('" . implode("','", $selectedDays) . "')
    AND (
        ('$inputTimeStart' >= ita.Time_Start AND '$inputTimeEnd' <= ita.Time_End  )
    )     
    AND NOT EXISTS (
        SELECT 1
        FROM classschedule cs
        WHERE cs.Instructor = CONCAT(i.Fname, ' ', i.Lname)
        AND cs.Day IN ('" . implode("','", $selectedDays) . "')
        AND Active != 3
        AND (
            ('$inputTimeStart' >= cs.Time_Start AND '$inputTimeStart' < cs.Time_End)
            OR ('$inputTimeEnd' > cs.Time_Start AND '$inputTimeEnd' <= cs.Time_End)
            OR ('$inputTimeStart' <= cs.Time_Start AND '$inputTimeEnd' >= cs.Time_End)
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
 -->











