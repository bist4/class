<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../phpmailer/src/Exception.php';
require '../../phpmailer/src/PHPMailer.php';
require '../../phpmailer/src/SMTP.php';

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
    $stmtCheckEmail = $conn->prepare("SELECT COUNT(*) FROM users WHERE Email = ?");
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

    $RoleIDs = isset($_POST['Roles']) ? $_POST['Roles'] : [];
    $departmentIDs = isset($_POST['Department']) ? $_POST['Department'] : [];
    $specializations = isset($_POST['Specialization']) ? $_POST['Specialization'] : [];

    
// Echo the values for testing
echo "Fname: $Fname<br>";
echo "Mname: $Mname<br>";
echo "Lname: $Lname<br>";
echo "Bday: $bday<br>";
echo "Cnumber: $cnumber<br>";
echo "Address: $address<br>";
echo "Gender: $gender<br>";
echo "Username: $Username<br>";
echo "Password: $Password<br>";
echo "Status: $status<br>";
echo "RoleIDs: " . implode(', ', $RoleIDs) . "<br>";
echo "DepartmentIDs: " . implode(', ', $departmentIDs) . "<br>";
echo "Specializations: " . implode(', ', $specializations) . "<br>";
    // Hash the password using password_hash
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    $active = 1;
    $login = 0;

    $dob = new DateTime($bday);
    $currentDate = new DateTime();
    $age = $currentDate->diff($dob)->y;

    // Set default value for lock_account
    $lock_account = 0;

    // Query for inserting data into the 'users' table
    $sqlInsert = "INSERT INTO users (DepartmentID, Specialization, Status, Fname, Mname, Lname, BirthDate, Age, ContactNumber, Address, Gender, Username, Password, Email, RoleID, login, Active, lock_account, CreatedAt) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    // Prepare the statement
    $stmt = $conn->prepare($sqlInsert);

    if ($stmt) {
        foreach ($RoleIDs as $RoleID) {
        foreach ($departmentIDs as $departmentID) {
            foreach ($specializations as $spec) {
                
                    // Bind the parameters and execute the statement for each department, specialization, and role
                    $stmt->bind_param("issssssiisssssiiii", $departmentID, $spec, $status, $Fname, $Mname, $Lname, $bday, $age, $cnumber, $address, $gender, $Username, $hashedPassword, $email, $RoleID, $login, $active, $lock_account);

                    if ($stmt->execute()) {
                        // Successfully inserted the record

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
                }
            }
        }

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

