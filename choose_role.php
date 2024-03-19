<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Role</title>
</head>
<body>
    <h2>Choose Your Role</h2>
    <form action="process_role_choice.php" method="post">
        <label for="role">Select Role:</label>
        <select name="role" id="role">
            <option value="1">System Admin</option>
            <option value="2">School Director</option>
            <option value="3">School Director Assistant</option>
            <option value="4">Instructor</option>
            <!-- Add options for additional roles as needed -->
        </select>
        <button type="submit">Login</button>
    </form>
</body>
</html>
