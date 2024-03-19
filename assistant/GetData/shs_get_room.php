
<?php
include('../../config/db_connection.php');

// Fetch the data and send it back as options for the dropdown
echo '<option value="" disabled selected>Select Room</option>';

// Check if the required data is set in the POST request
if (isset($_POST['timeStart']) && isset($_POST['timeEnd']) && isset($_POST['selectedDays'])) {
    $timeStart = $_POST['timeStart'];
    $timeEnd = $_POST['timeEnd'];
    $selectedDays = $_POST['selectedDays'];

    // Convert input time to match the database format
    $inputTimeStart = date('H:i:s', strtotime($timeStart));
    $inputTimeEnd = date('H:i:s', strtotime($timeEnd));

    // Assuming rooms table structure has fields 'RoomNumber' and 'DepartmentID'
    $query = "SELECT RoomNumber, RoomID FROM rooms WHERE DepartmentID = 1
            AND NOT EXISTS (
                SELECT 1
                FROM classschedules cs
                WHERE cs.RoomID = rooms.RoomID
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

    // Execute the query
    $result = $conn->query($query);

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
