<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";  // No password
$database_name = "ClassScheduling";

// Get connection object
$conn = mysqli_connect($host, $username, $password, $database_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Check if the file exists
    if (file_exists($file)) {
        // Read the SQL file content
        $sqlContent = file_get_contents($file);

        // Execute SQL commands
        $sqlCommands = explode(';', $sqlContent);
        foreach ($sqlCommands as $sqlCommand) {
            if (!empty($sqlCommand)) {
                mysqli_query($conn, $sqlCommand);
            }
        }

        echo "Database restored successfully.";
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid file.";
}

// Close the database connection
mysqli_close($conn);
?>
