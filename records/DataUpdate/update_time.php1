<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require('../../config/db_connection.php'); // Modify the path as per your file structure

    $successCount = 0;
    $errors = [];

    // Retrieve POST data
    $timeStart = $_POST['Time_Start'];
    $timeEnd = $_POST['Time_End'];
    // $instructorTimeAvailabilityIDs = $_POST['InstructorTimeAvailabilitiesID'];

    foreach ($instructorTimeAvailabilityIDs as $key => $instructorTimeAvailabilityID) {
        $startTime = $timeStart[$key];
        $endTime = $timeEnd[$key];
        $dayData = array(
            'Monday' => isset($_POST['is_Monday'][$key]) ? 1 : 0,
            'Tuesday' => isset($_POST['is_Tuesday'][$key]) ? 1 : 0,
            'Wednesday' => isset($_POST['is_Wednesday'][$key]) ? 1 : 0,
            'Thursday' => isset($_POST['is_Thursday'][$key]) ? 1 : 0,
            'Friday' => isset($_POST['is_Friday'][$key]) ? 1 : 0
        );

        // Prepare and execute the update query for each set of data
        $query = "UPDATE instructortimeavailabilities SET ";
        $params = array();
        foreach ($dayData as $day => $value) {
            $query .= "$day = ?, ";
            $params[] = $value;
        }
        $query .= "Time_Start = ?, Time_End = ? WHERE InstructorTimeAvailabilitiesID = ?";
        $params[] = $startTime;
        $params[] = $endTime;
        $params[] = $instructorTimeAvailabilityID;

        $stmt = $conn->prepare($query);
        $types = str_repeat('i', count($params)); // Assuming all parameters are integers
        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        // Check for successful update
        if ($stmt->affected_rows > 0) {
            $successCount++;
        } else {
            $errors[] = "Failed to update instructor time availability with ID $instructorTimeAvailabilityID";
        }
    }

    $conn->close();

    // Return appropriate JSON response based on update status
    if ($successCount > 0) {
        echo json_encode(["success" => "Instructor time availabilities updated successfully!"]);
    } elseif (!empty($errors)) {
        echo json_encode(["error" => $errors]);
    }

} else {
    // If not a POST request, handle accordingly (e.g., redirect or display error)
    echo json_encode(["error" => "Invalid request method"]);
}
?>
