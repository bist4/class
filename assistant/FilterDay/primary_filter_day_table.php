<?php
require('../../config/db_connection.php');

if (isset($_POST['section']) && isset($_POST['yearLevel']) && isset($_POST['selectedDays'])) {
    $yearLevel = $_POST['yearLevel'];
    $section = $_POST['section'];
    $selectedDays = $_POST['selectedDays'];

    // Construct the SQL query dynamically based on selected days
    $sql = "SELECT 
                sub.SubjectDescription,
                cs.Time_Start, cs.Time_End,
                CONCAT(usi.Fname, ' ', usi.Lname) AS InstructorName,
                r.RoomNumber
            FROM classschedule cs
            INNER JOIN department d ON cs.DepartmentID = d.DepartmentID
            INNER JOIN sections s ON cs.SectionID = s.SectionID 
            INNER JOIN subjects sub ON cs.SubjectID = sub.SubjectID
            INNER JOIN userroles usr ON cs.InstructorID = usr.UserRoleID
            INNER JOIN userinfo usi ON usr.UserID = usi.UserInfoID 
            INNER JOIN rooms r ON cs.RoomID = r.RoomID
            WHERE d.DepartmentID = ? AND s.SectionID = ?
            AND cs.Active = 1";

    // Prepare the condition for selected days
    $dayConditions = [];
    foreach ($selectedDays as $day) {
        // Append the condition for each selected day
        $dayConditions[] = "cs.$day = 1";
    }
    // Combine all day conditions with OR operator
    $dayCondition = implode(' OR ', $dayConditions);

    // Append the day condition to the SQL query
    if (!empty($dayCondition)) {
        $sql .= " AND ($dayCondition)";
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Log the SQL error if preparation fails
        echo "Error in SQL query: " . $conn->error;
        exit; // Terminate the script to prevent further execution
    }

    $stmt->bind_param('ii', $yearLevel, $section);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Rest of your code to handle the result
    } else {
        // Handle case when no data is found
    }

    $stmt->close();
} else {
    // Invalid request
    echo "Invalid request";
}
?>
