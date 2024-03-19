<?php
// Start a session if not already started
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_email'])) {
    // User is not authenticated, redirect to login page
    header('Location: ../../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo1.png">
    
    <title>Change Password</title>
    <link rel="stylesheet" href="../assets/style/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Add SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .bg-img {
            position: relative;
        }

        .loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            border: 5px solid #f47339;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .show-loader .loader {
            display: block;
        }
        /* Close button style */
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #3498db;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div class="bg-img">
        <div class="content">
            <!-- Close button (X) -->
            <span class="close-button" onclick="closeContent()">&#10006;</span>
            <header>New Password</header>
            <form action="forgot_password_connection.php" method="post" onsubmit="validatePasswords(event)">
                <div class="field">
                    <span class="fa fa-lock"></span>
                    <input type="password" id="password" name="password" class="pass-key" placeholder=" New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                </div>
            
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="pass-key" placeholder="Confirm Password">
                    <span class="show" onclick="togglePasswordVisibility()">SHOW</span>
                </div>
                <div class="field space">
                    <input type="submit" name="submit" value="Change Password">
                </div>
            </form>
            <div class="loader"></div>
        </div>
    </div>

    <!-- Add SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        function togglePasswordVisibility() {
            const inputs = [passwordInput, confirmPasswordInput];
            const showBtn = document.querySelector('.show');

            inputs.forEach(input => {
                if (input.type === 'password') {
                    input.type = 'text';
                } else {
                    input.type = 'password';
                }
            });

            if (showBtn.textContent === 'SHOW') {
                showBtn.textContent = 'HIDE';
                showBtn.style.color = '#3498db';
            } else {
                showBtn.textContent = 'SHOW';
                showBtn.style.color = '#222';
            }
        }

        function validatePasswords(event) {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Try Again',
                    text: 'Password and Confirm Password do not match.'
                });
                event.preventDefault(); // Prevent the form submission
            }
        }

        function showLoader() {
            const loader = document.querySelector('.loader');
            loader.style.display = 'block';
        }

        function closeContent() {
            window.location.href = '../login_form.php';
        }
    </script>
</body>
</html>
