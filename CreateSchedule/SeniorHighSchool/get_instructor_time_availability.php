<?php
require('../../config/db_connection.php');

if (isset($_POST['instructor'])) {
    $instructor = $_POST['instructor'];

    // SQL query to select Specialization from specializations based on StrandCode
    $sql = "SELECT ta.DaysID, d.id, d.Days, ta.Time_Start, ta.Time_End, i.Fname, i.Active FROM instructortimeavailabilities ta
    INNER JOIN instructor i ON ta.InstructorID = i.InstructorID
    INNER JOIN day d ON ta.DaysID = d.id
    WHERE ta.InstructorID = ? AND ta.Active =1 AND i.Active=1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $instructor);
    $stmt->execute();

    $result = $stmt->get_result();
 
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $days = explode(',', $row['Days']);
            
            foreach ($days as $day) {
                // Format the time in AM/PM
                $timeStart = date("h:i A", strtotime($row['Time_Start']));
                $timeEnd = date("h:i A", strtotime($row['Time_End']));
                
                echo '<option value="' . $row['id'] . '" data-min-time="' . $row['Time_Start'] . '" data-max-time="' . $row['Time_End'] . '">' . $day . ' ' . $timeStart . ' - ' . $timeEnd . '</option>';
            }
        }
    } 
    else {
        echo '<option value="1">Monday: 08:00am - 05:00pm </option>';
        echo '<option value="2">Tuesday: 08:00am - 05:00pm </option>';
        echo '<option value="3">Wednesday: 08:00am - 05:00pm </option>';
        echo '<option value="4">Thursday: 08:00am - 05:00pm </option>';
        echo '<option value="5">Friday: 08:00am - 05:00pm </option>';
    }

    $stmt->close();
} else {
    echo '<option disabled>Select Subject first</option>';
}
?>
