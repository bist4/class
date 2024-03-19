<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Deactivated</title>
    <link rel="icon" href="assets/img/logo1.png">
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 50px;
            background: url('assets/img/bg.jpg');
            height: 100vh;
            background-size: cover;
            background-position: center;
        }
 
    </style>
</head>
<body>
 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Account Deactivated</h3>
                    </div>
                    <div class="card-body">
                        <p>Sorry, your account has been deactivated.</p>
                        <p>Reason: <?php echo isset($_GET['reason']) ? htmlspecialchars($_GET['reason']) : 'No reason specified'; ?></p>
                        <!-- You can replace $_GET['reason'] with the actual reason variable -->
                        <p>Please contact support for further assistance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</body>
</html>
