<?php
// DataGet/get_roomTypeName.php

require('../../config/db_connection.php');

$sqlRoomTypes = "SELECT * FROM roomtype";
$resultRoomTypes = $conn->query($sqlRoomTypes);

// Create an empty array to store the room types
$roomTypes = array();

// Fetch room types and add them to the array
if ($resultRoomTypes->num_rows > 0) {
    while ($row = $resultRoomTypes->fetch_assoc()) {
        $roomTypes[] = array(
            'RoomTypeName' => $row['RoomTypeName']
        );
    }
}

// Close the database connection
$conn->close();

// Return the room types as a JSON response
echo json_encode($roomTypes);

?>
