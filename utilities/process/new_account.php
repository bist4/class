<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../phpmailer/src/Exception.php';
require '../../phpmailer/src/PHPMailer.php';
require '../../phpmailer/src/SMTP.php';

// ... (existing code)
if (isset($_POST["add_btn"])) {
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
    $mail->send();
}

if (isset($_POST["add_btn"])) {
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
    $mail->send();
}

require('../../config/db_connection.php');
session_start();

if (isset($_POST['add_btn'])) {
    $email = $_POST['email'];

    // Check if the email is unique
    $stmtCheckEmail = $conn->prepare("SELECT COUNT(*) FROM userinfo WHERE Email = ?");
    $stmtCheckEmail->bind_param("s", $email);
    $stmtCheckEmail->execute();
    $resultCheckEmail = $stmtCheckEmail->get_result();
    $count = $resultCheckEmail->fetch_row()[0];

    // If the count is greater than 0, the email is not unique
    if ($count > 0) {
        $_SESSION['status'] = "Email is already registered. Please use a different email.";
        header("Location: ../accounts.php");
        exit();
    }

    // Continue with the rest of the insertion process if the email is unique
    $Fname = $_POST['Fname'];
    $Mname = $_POST['Mname'];
    $Lname = $_POST['Lname'];
    $bday = $_POST['Bday'];
    $cnumber = $_POST['Cnumber'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $status = $_POST['Status'];

    // $Roles = isset($_POST['Roles']) ? $_POST['Roles'] : [];
    // $Department = isset($_POST['Department']) ? $_POST['Department'] : [];

    // Set default values for roles and departments
    

    
    // Hash the password using password_hash
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    $active = 1;
    $login = 1;

    $dob = new DateTime($bday);
    $currentDate = new DateTime();
    $age = $currentDate->diff($dob)->y;

    // Set default value for lock_account
    $lock_account = 0;

    // Query for inserting data into the 'users' table
    $sqlInsert = "INSERT INTO userinfo (Fname, Mname, Lname, Age, BirthDate, Gender, Status, Address, ContactNumber, Email, Username, Password, login, CreatedAt, lock_account, Active) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
    // Prepare the statement
    $stmt = $conn->prepare($sqlInsert);

    if ($stmt) {
        // Bind the parameters and execute the statement for each department, specialization, and role
        // $stmt->bind_param("sssisssissssiiiiiiiii", $Fname, $Mname, $Lname, $age, $bday, $gender, $address, $cnumber, 
        // $status, $email, $Username, $hashedPassword, $login, $active, $instructor, $admin, $schoolDirector, $schoolDirectorAssistant, $primary, $juniorHighSchool, $seniorHighSchool);
        $stmt->bind_param("sssissssisssiii", $Fname, $Mname, $Lname, $age, $bday, $gender, $status, $address, $cnumber, 
 $email, $Username, $hashedPassword, $login, $active, $lock_account);


        if ($stmt->execute()) {
            // Successfully inserted the record

            header("Location: ../accounts.php");
            exit();
            // Log the activity
            if (isset($_SESSION['UserID'])) {
                $loggedInUserID = $_SESSION['UserID'];

                $activity = "Admin added new account $Username";
                $currentDateTime = date('Y-m-d H:i:s');
                $active = 1;

                $sqlLog = "INSERT INTO logs (DateTime, Activity, UserID, Active, CreatedAt) VALUES (?, ?, ?, ?, NOW())";
                $stmtLog = $conn->prepare($sqlLog);
                $stmtLog->bind_param("ssii", $currentDateTime, $activity, $loggedInUserID, $active);
                $stmtLog->execute();
            }
        } else {
            // Error occurred during insertion
            echo "Error: " . $stmt->error;
        }

        // Reset the statement for the next iteration
        $stmt->reset();

        // Close the statement
        $stmt->close();
    } else {
        // Handle the case where the statement couldn't be prepared
        echo "Error in preparing the statement.";
    }

    // Close the database connection
    $conn->close();
}
?>
