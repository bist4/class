<?php

require('../config/db_connection.php');
session_start();


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $fname = $_POST['fname'];
    $mname = isset($_POST['mname']) ? $_POST['mname'] : "";
    $lname = $_POST['lname'];
    $birthday = $_POST['birthday'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $is_instructor = isset($_POST['instructor']) ? 1 : 0;
    $is_school_director = isset($_POST['school_director']) ? 1 : 0;
    $is_school_director_assistant = isset($_POST['school_director_assistant']) ? 1 : 0;

    //Calculating the age according to the bday
    $dob = new DateTime($birthday);
    $now = new DateTime();
    $age = $dob->diff($now)->y;


    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into userinfo table
    $sql = "INSERT INTO userinfo (Fname, Mname, Lname, Age, Birthday, Gender, ContactNumber, Address, Email, Username, Password, is_Instructor, is_SchoolDirector, is_SchoolDirectorAssistant, UserTypeID, is_Login, is_Lock_Account, CreatedAt, Active)
            VALUES ('$fname', '$mname', '$lname', $age,'$birthday', '$gender','$contact', '$address','$email', '$username', '$hashedPassword', $is_instructor, $is_school_director, $is_school_director_assistant, 1, 0, 0, NOW(), 1)";

    if ($conn->query($sql) === TRUE) {
        $response['success'] = "New record created successfully";
    } else {
        $response['error'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    // If the user is an instructor, insert data into the instructors and instructorspecializations tables
    if ($is_instructor) {
        $status = $_POST['status'];
        $is_primary = isset($_POST['primary']) ? 1 : 0;
        $is_juniorhigh = isset($_POST['juniorhigh']) ? 1 : 0;
        $is_seniorhigh = isset($_POST['seniorhigh']) ? 1 : 0;
    
        $specializationsArray = isset($_POST['specializations']) ? $_POST['specializations'] : [];

        // $specializations = $_POST['specializations'];

        //Get the id for userinfo
        $userinfo_id = $conn->insert_id;

        // Insert data into instructors table
        $instructor_sql = "INSERT INTO instructors (UserInfoID, Status, is_Primary, is_JuniorHighSchool, is_SeniorHighSchool)
                        VALUES ('$userinfo_id', '$status', $is_primary, $is_juniorhigh, $is_seniorhigh)";
        if ($conn->query($instructor_sql) === TRUE) {
            $response['success'] = "New instructor record created successfully";
        } else {
            $response['error'] = "Error: " . $instructor_sql . "<br>" . $conn->error;
        }

        // Get the ID of the last inserted instructor record
        $instructor_id = $conn->insert_id;

        foreach($specializationsArray as $specialization){
            $specialization = $conn->real_escape_string($specialization); // Escape special characters
            $specializations_sql = "INSERT INTO instructorspecializations (InstructorID, SpecializationName)
            VALUES ($instructor_id, '$specialization')";
            if ($conn->query($specializations_sql) === TRUE) {
                $response['success'] = "New instructor specialization(s) record created successfully";
            } else {
                $response['error'] = "Error: " . $specializations_sql . "<br>" . $conn->error;
            }
        }
        // Insert data into instructorspecializations table
       
    }

    // Return JSON response
    echo json_encode($response);

    // Close connection
    $conn->close();
}
?>
