<?php
session_start();


// Check if the user is already logged in
if (isset($_SESSION['Username'])) {
    $role = [
        $row['is_Instructor'],
        $row['is_SchoolDirector'],
        $row['is_SchoolDirectorAssistant']
    ];

    $positionRole = '';

    $admin = $row['UserTypeID'];

    $role = [
        $row['is_Instructor'],
        $row['is_SchoolDirector'],
        $row['is_SchoolDirectorAssistant']
    ];
    
    $admin = $row['UserTypeID'];
    
    if ($role[0] == 1) {
        header("Location: instructor.php");
        exit();
    } elseif ($role[1] == 1) {
        header("Location: school_director.php");
        exit();
    } elseif ($role[2] == 1) {
        header("Location: assistant.php");
        exit();
    } elseif ($admin == 2) {
        header("Location: system_admin.php");
        exit();
    } else {
        // Handle any other cases, or redirect to a default page
        header("Location: redirect.php");
        exit();
    }
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo1.png">
    
    <title>Log In</title>
    <link rel="stylesheet" href="assets/style/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
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
            <header>Login</header>
            <form action="login_connection.php" method="post" onsubmit="showLoader()">
                <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
        
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" name="username" placeholder="Username" required autofocus>
                </div>
            
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" name="password" class="pass-key" required placeholder="Password">
                    <span class="show">SHOW</span>
                </div>
                <div class="pass">
                    <a href="search_email.php">Forgot Password?</a>
                </div>

                <div class="field">
					<input type="submit" value="LOGIN">
                </div>
            </form>
            <div class="loader"></div>
        </div>
    </div>

    <script>
        const pass_field = document.querySelector('.pass-key');
        const showBtn = document.querySelector('.show');
        showBtn.addEventListener('click', function(){
            if (pass_field.type === "password") {
                pass_field.type = "text";
                showBtn.textContent = "HIDE";
                showBtn.style.color = "#3498db";
            } else {
                pass_field.type = "password";
                showBtn.textContent = "SHOW";
                showBtn.style.color = "#222";
            }
        });

        function showLoader() {
            const loader = document.querySelector('.loader');
            loader.style.display = 'block';
        }

        function closeContent() {
            window.location.href = '../index.php';
        }
    </script>
    
</body>
</html>
