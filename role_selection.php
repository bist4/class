<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login_form.php");
    exit();
}

// Check if available roles are set in the session
if (!isset($_SESSION['AvailableRoles']) || empty($_SESSION['AvailableRoles'])) {
    header("Location: login_form.php?error=No roles available");
    exit();
}

// Retrieve available roles from session
$availableRoles = $_SESSION['AvailableRoles'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Selection</title>
</head>
<body>
    <h1>Choose Your Role</h1>
    <form action="login_process.php" method="post">
        <select name="selectedRole">
            <?php foreach ($availableRoles as $role): ?>
                <option value="<?php echo $role; ?>">Role <?php echo $role; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Login</button>
    </form>
</body>
</html>
