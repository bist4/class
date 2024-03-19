<!-- <php
include('../../config/db_connection.php');

echo '<option value="" disabled selected>Select Instructor</option>';

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
    $query = "SELECT DISTINCT i.InstructorID, usi.Fname, usi.Lname 
              FROM userinfo usi
              INNER JOIN instructors i ON i.UserInfoID = usi.UserInfoID
              WHERE usi.is_Instructor = 1 
              AND i.is_SeniorHighSchool = 1
              AND NOT EXISTS (
                SELECT 1
                FROM classschedules cs
                WHERE cs.InstructorID = i.InstructorID
                AND (
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

            )
              ";

    // Execute the query
    $result = $conn->query($query);

    // Fetch the data and send it back as options for the dropdown
    $options = '';
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['InstructorID'] . '">' . $row['Fname'] . ' ' . $row['Lname'] . '</option>';
    }

    echo $options;

    // Close the database connection
    $conn->close();
} else {
    // Handle invalid or missing parameters
    echo "Invalid or missing parameters";
}
?> -->

<?php
include('../../config/db_connection.php');

echo '<option value="" disabled selected>Select Instructor</option>';

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
    $queryFullTime = "SELECT i.InstructorID, usi.Fname, usi.Lname
                      FROM userinfo usi
                      INNER JOIN instructors i ON i.UserInfoID = usi.UserInfoID
                      WHERE usi.is_Instructor = 1
                      AND Active = 1 
                      AND Status = 1 
                      AND i.is_SeniorHighSchool = 1
                      AND NOT EXISTS (
                          SELECT 1
                          FROM classschedules cs
                          WHERE cs.InstructorID = i.InstructorID
                          AND (
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

    // Execute the query for full-time instructors
    $resultFullTime = $conn->query($queryFullTime);

    // Fetch the data for full-time instructors
    $options = '<option value="" disabled>Full Time Instructor</option>';
    if ($resultFullTime->num_rows > 0) {
        while ($row = $resultFullTime->fetch_assoc()) {
            $options .= '<option value="' . $row['InstructorID'] . '">' . $row['Fname'] . ' ' . $row['Lname'] . '</option>';
        }
    } else {
        $options .= '<option value="" disabled>No Available</option>';
    }

    // Add title for part-time instructors
    $options .= '<option value="" disabled>Part Time Instructor</option>';

    // Check if there are part-time instructors available
    $queryPartTime = "SELECT i.InstructorID, usi.Fname, usi.Lname
                      FROM userinfo usi
                      INNER JOIN instructors i ON i.UserInfoID = usi.UserInfoID
                      JOIN instructortimeavailabilities ita ON i.InstructorID = ita.InstructorID
                      WHERE usi.is_Instructor = 1
                      AND ita.Active = 1  
                      AND Status = 0 
                      AND i.is_SeniorHighSchool = 1
                      AND (
                            ('$inputTimeStart' >= ita.Time_Start AND '$inputTimeEnd' <= ita.Time_End  )
                        )     
                      AND NOT EXISTS (
                          SELECT 1
                          FROM classschedules cs
                          WHERE cs.InstructorID = i.InstructorID
                          AND (
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
                      )
                      ";

    // Execute the query for part-time instructors
    $resultPartTime = $conn->query($queryPartTime);

    // Fetch the data for part-time instructors
    while ($row = $resultPartTime->fetch_assoc()) {
        $options .= '<option value="' . $row['InstructorID'] . '">' . $row['Fname'] . ' ' . $row['Lname'] . '</option>';
    }

    // If no part-time instructors available, display appropriate message
    if ($resultPartTime->num_rows == 0) {
        $options .= '<option value="" disabled>No Available</option>';
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











