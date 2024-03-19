<?php
// Database connection
require('../../config/db_connection.php');

// Check if the selectedRoomID parameter is set in the GET request
if (isset($_GET['selectedRoomID'])) {
    // Get the selected room IDs from the GET request
    $selectedRoomIDs = $_GET['selectedRoomID'];

    // SQL query to fetch room information based on the selected room IDs
    $sql = "SELECT RoomID, RoomNumber FROM sections WHERE RoomID IN (" . implode(',', $selectedRoomIDs) . ")";
    $result = $conn->query($sql);

    // Initialize the $rooms array
    $rooms = array();

    // Fetch room information and add it to the array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rooms[] = array(
                'id' => $row['RoomID'],
                'name' => $row['RoomNumber']
            );
        }
    }

    // Close the database connection
    $conn->close();

    // Return the room information as a JSON response
    echo json_encode($rooms);
} else {
    // If selectedRoomID is not set, return an empty response or an error message
    echo json_encode(array('error' => 'Selected room ID not provided.'));
}
?>
