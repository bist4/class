
<?php
include('../../config/db_connection.php');

// Check if the required data is set in the POST request
if (isset($_POST['timeStart']) && isset($_POST['timeEnd']) && isset($_POST['selectedDays'])) {
    $timeStart = $_POST['timeStart'];
    $timeEnd = $_POST['timeEnd'];
    $selectedDays = $_POST['selectedDays'];

    // Convert input time to match the database format
    $inputTimeStart = date('H:i:s', strtotime($timeStart));
    $inputTimeEnd = date('H:i:s', strtotime($timeEnd));

    // Assuming rooms table structure has fields 'RoomNumber' and 'DepartmentID'
    $query = "SELECT RoomNumber, RoomID FROM rooms WHERE DepartmentID = 3";

    // Execute the query
    $result = $conn->query($query);

    // Fetch the data and send it back as options for the dropdown
    echo '<option value="" disabled selected>Select Room</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['RoomID'] . '">' . $row['RoomNumber'] . '</option>';
    }

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
if (isset($_POST['timeStart']) && isset($_POST['timeEnd']) && isset($_POST['selectedDays'])) {
    $timeStart = $_POST['timeStart'];
    $timeEnd = $_POST['timeEnd'];
    $selectedDays = $_POST['selectedDays'];

    // Convert input time to match the database format
    $inputTimeStart = date('H:i:s', strtotime($timeStart));
    $inputTimeEnd = date('H:i:s', strtotime($timeEnd));

    echo '<option value="" disabled selected>Select Room</option>';

    // Fetch rooms that do not have any entries in classschedule for the specified day and time
    $sqlRoom = "SELECT DISTINCT RoomNumber
                FROM rooms 
                WHERE DepartmentID = 3 
                AND Active = 1  
                AND NOT EXISTS (
                    SELECT 1
                    FROM classschedule cs
                    WHERE cs.Room = rooms.RoomNumber
                    AND cs.Day IN ('" . implode("','", $selectedDays) . "')
                    AND cs.Active != 3
                    AND (
                        ('$inputTimeStart' >= cs.Time_Start AND '$inputTimeStart' < cs.Time_End)
                        OR ('$inputTimeEnd' > cs.Time_Start AND '$inputTimeEnd' <= cs.Time_End)
                        OR ('$inputTimeStart' <= cs.Time_Start AND '$inputTimeEnd' >= cs.Time_End)
                    )
                )";

    $resultRoom = $conn->query($sqlRoom);

    if ($resultRoom->num_rows > 0) {
        while ($row = $resultRoom->fetch_assoc()) {
            echo '<option value="' . $row['RoomNumber'] . '">' . $row['RoomNumber'] . '</option>';
        }
    } else {
        echo '<option value="" disabled>No available rooms</option>';
    }
}
?> -->
