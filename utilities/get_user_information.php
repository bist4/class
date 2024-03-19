<?php
require('../config/db_connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_GET['userId'];

$sql = "SELECT * FROM users WHERE UserID = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    echo json_encode($userData);
} else {
    echo json_encode(['error' => 'User not found']);
}

$conn->close();
?>