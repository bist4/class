<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

// Database connection and session start
require('../config/db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'saasisubicinc@gmail.com';
    $mail->Password = 'fxytjsahrwtyhdhb';

    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('saasisubicinc@gmail.com');

    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);

    $mail->Subject = "Smart Achiever Academy, Subic Inc: New user account";
    $message = "Hi " . $_POST["Fname"] . ' ' . $_POST["Mname"] . ' ' . $_POST["Lname"] . '!' . ",<br><br>" .
        "Your current login information is now:<br><br>" .
        "<strong>Username:</strong> " . $_POST["Username"] . "<br>" .
        "<strong>Password:</strong> " . $_POST["Password"] . "<br><br>" .
        "To start using 'Smart Achiever Academy, Subic Inc', login at the following link:<br><br>" .
        "http://class-scheduling.comteq.edu.ph/class/Schedule/login_form.php";

    $mail->Body = $message;

    try {
        $mail->send();
    } catch (Exception $e) {
        echo json_encode(array("error" => true, "message" => "Error sending email: " . $mail->ErrorInfo));
        exit;
    }

    $email = $_POST['email'];
    $Username = $_POST['Username'];

    // Check if email or username already exists
    $checkExisting = "SELECT * FROM userinfo WHERE Email = '$email' OR Username = '$Username'";
    $result = $conn->query($checkExisting);

    if ($result->num_rows > 0) {
        // If there are existing records with the same email or username
        $existingData = $result->fetch_assoc();
        if ($existingData['Email'] === $email) {
            echo json_encode(["error" => "Email already exists"]);

            // echo json_encode(array("error" => true, "message" => "Email already exists"));
        } else {
            echo json_encode(["error" => "Username already exists"]);

            // echo json_encode(array("error" => true, "message" => "Username already exists"));
        }
        exit;
    } else {
        // If email and username are unique, proceed with insertion
        $Fname = $_POST['Fname'];
        $Lname = $_POST['Lname'];
        $Mname = $_POST['Mname'];
        $Bday = $_POST['Bday'];
        $gender = $_POST['gender'];
        $Cnumber = $_POST['Cnumber'];
        $address = $_POST['address'];

        $Username = $_POST['Username'];
        $Password = $_POST['Password'];
        $position = $_POST['position'];

        // Calculate age based on the provided birthday
        $dob = new DateTime($Bday);
        $now = new DateTime();
        $age = $dob->diff($now)->y;

        // Determine the values of is_Instructor, is_SchoolDirector, and is_SchoolDirectorAssistant based on the selected position
        $is_Instructor = ($position == 'instructor') ? 1 : 0;
        $is_SchoolDirector = ($position == 'schoolDirector') ? 1 : 0;
        $is_SchoolDirectorAssistant = ($position == 'schoolDirectorAssistant') ? 1 : 0;

        // Assuming you have a function to hash passwords securely
        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

        // Insert new record into the database
        $sql = "INSERT INTO userinfo (Fname, Lname, Mname, Age, Birthday, Gender, ContactNumber, Address, Email, Username, Password, is_Instructor, is_SchoolDirector, is_SchoolDirectorAssistant, UserTypeID, is_Login, is_Lock_Account, CreatedAt, Active) 
        VALUES ('$Fname', '$Lname', '$Mname', $age, '$Bday', '$gender', '$Cnumber', '$address', '$email', '$Username', '$hashedPassword', $is_Instructor, $is_SchoolDirector, $is_SchoolDirectorAssistant, 1, 1, 0, NOW(), 1)";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["success" => "Account Added Successfully"]);
            
            // echo json_encode(array("success" => true, "message" => "Account Added Successfully"));
            exit;
        } else {
            echo json_encode(["error" => "Error inserting record: ". $conn->error]);

            // echo json_encode(array("error" => true, "message" => "Error inserting record: " . $conn->error));
            exit;
        }
    }
    $conn->close();
}
?>
