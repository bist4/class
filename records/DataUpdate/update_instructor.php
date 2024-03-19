<?php
require('../../config/db_connection.php');
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $status = $_POST['status'];
    $is_primary = isset($_POST['primary']) ? 1 : 0;
    $is_juniorhigh = isset($_POST['juniorhighschool']) ? 1 : 0;
    $is_seniorhigh = isset($_POST['seniorhighschool']) ? 1 : 0;

    // $specializationsArray = isset($_POST['specializations']) ? $_POST['specializations'] : [];
    $instructorIDs = $_POST['InstructorID'];

   

    // Update instructors table
    foreach ($instructorIDs as $index => $instructorID) {
        $instructorID = $conn->real_escape_string($instructorID); // Escape special characters
        $instructor_sql = "UPDATE instructors SET Status = '$status', is_Primary = $is_primary, is_JuniorHighSchool = $is_juniorhigh, is_SeniorHighSchool = $is_seniorhigh WHERE InstructorID = $instructorID";
        if ($conn->query($instructor_sql) !== TRUE) {
            $response['error'] = "Error updating instructor record: " . $conn->error;
            echo json_encode($response);
            $conn->close();
            exit;
        }
    }
 
    // foreach($instructorSpecializationsIDs as $index => $instructorSpecializationsID){
    //     foreach($specializationsArray as $index => $specialization){
    //     $specialization = $conn->real_escape_string($specialization); // Escape special characters
    //     // $instructorSpecializationsID = $index; // Assuming the index matches the ID in the database
        
    //         $specializations_sql = "UPDATE instructorspecializations SET SpecializationName = '$specialization' WHERE InstructorSpecializationsID = $instructorSpecializationsID";
        
    //         // Debugging
    //         echo "SQL Query: $specializations_sql <br>";
            
    //         if ($conn->query($specializations_sql) === TRUE) {
    //             $response['success'] = "New instructor specialization(s) record updated successfully";
    //         } else {
    //             $response['error'] = "Error: " . $specializations_sql . "<br>" . $conn->error;
    //         }
    //     }
        
    // }








    // foreach ($specializations as $id => $values) {
    //     // Sanitize the ID to prevent SQL injection
    //     $id = mysqli_real_escape_string($conn, $id);
        
    //     // Extract the fields from the $values array
    //     $specializationName = mysqli_real_escape_string($conn, $values['SpecializationName']);
    //     // Add other fields as needed
        
    //     // Construct and execute the SQL query to update the specialization fields
    //     $sql = "UPDATE instructorspecializations SET SpecializationName = '$specializationName' WHERE InstructorSpecializationsID = $id";
    //     // Add other fields to the SET clause as needed
        
    //     $result = mysqli_query($conn, $sql);
        
    //     // Check if the query was successful
    //     if ($result) {
    //         echo "Specialization with ID $id updated successfully.<br>";
    //     } else {
    //         echo "Error updating specialization with ID $id: " . mysqli_error($conn) . "<br>";
    //     }
    // }

    // Return success response
    $response['success'] = "Records updated successfully";
    echo json_encode($response);

    // Close connection
    $conn->close();
}
?>


