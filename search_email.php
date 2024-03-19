<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo1.png">
    
    <title>Forgot Password</title>
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
        label{
          color: white;
          float: left;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="bg-img">
        <div class="content">
            <!-- Close button (X) -->
            <span class="close-button" onclick="closeContent()">&#10006;</span>
            <header>Forgot password?</header>
            <form action="forgot_password/send.php" method="POST" onsubmit="showLoader()">  
                <label for="email">Please enter your valid email...</label><br>   
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="email" name="email" id="email" placeholder="example: name@gmail.com" autofocus>
                </div>
                <div class="field space">
					<input type="submit" name="send" value="Search Email">
                </div>
            </form>
            <div class="loader"></div>
        </div>
    </div>

    <script>
        const pass_field = document.querySelector('.pass-key');
        function showLoader() {
            const loader = document.querySelector('.loader');
            loader.style.display = 'block';
        }

        function closeContent() {
            window.location.href = '../index.php';
        }
    </script>
    <script>

    // Function to show SweetAlert for an invalid email
    function showAlert() {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Email',
            text: 'The provided email is not registered.',
        });
    }

    // Check if a parameter 'error' exists in the URL, and show the alert if it does
    const urlParams = new URLSearchParams(window.location.search);
    const errorParam = urlParams.get('error');
    if (errorParam === 'EmailNotRegistered') {
        showAlert();
    }
</script>
    
</body>
</html>
