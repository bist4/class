<?php
require('../../config/db_connection.php');

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$restoreFolder = 'Backupdatabase/restores/';

// Create a new connection to MySQL
$restoreConn = new mysqli($servername, $username, $password);

// Check connection
if ($restoreConn->connect_error) {
    die("Connection failed: " . $restoreConn->connect_error);
}

// Change the database to the one you want to restore
$restoreDatabase = "class2";
$restoreConn->select_db($restoreDatabase);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['sqlFile'])) {
    $uploadedFile = $_FILES['sqlFile'];

    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
        $tempFilePath = $restoreFolder . basename($uploadedFile['name']);

        if (move_uploaded_file($uploadedFile['tmp_name'], $tempFilePath)) {
            $sqlContent = file_get_contents($tempFilePath);

            if ($sqlContent === false) {
                die("Error reading SQL file.");
            }

            // Execute each SQL query
            $queries = explode(';', $sqlContent);
            foreach ($queries as $query) {
                // Trim and skip empty queries
                $query = trim($query);
                if (!empty($query)) {
                    $result = $restoreConn->query($query);

                    if (!$result) {
                        die("Error executing query: " . $restoreConn->error);
                    }
                }
            }

            echo "Database restored successfully. ";
            echo '<script>';
            echo 'window.location.href = "http://localhost/phpmyadmin/index.php?route=/server/databases";';
            echo '</script>';
        } else {
            echo "Error moving uploaded file to the temporary location.";
        }
    } else {
        echo "Error uploading file. Code: " . $uploadedFile['error'];
    }
} else {
    // Display an HTML form for file upload
    echo '<div style="text-align: center; margin-top: 60px;">';
    echo '    <h2 style="color: #333;">Upload a SQL :</h2>';
    echo '    <form enctype="multipart/form-data" action="upload.php" method="POST" style="margin-top: 20px; border: 2px solid #ccc; padding: 20px; border-radius: 10px; background-color: #f9f9f9; max-width: 400px; margin-left: auto; margin-right: auto;">';
    echo '        <label for="sqlFile" style="display: block; text-align: left; font-weight: bold; margin-bottom: 10px;">Choose an SQL file:</label>';
    echo '        <input type="file" name="sqlFile" id="sqlFile" accept=".sql" required style="width: 100%; padding: 10px; margin-bottom: 20px; box-sizing: border-box;">';
    echo '        <button type="submit" style="background-color: #F47339; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">Restore</button>';
    echo '    </form>';
    echo '</div>';
    echo '<script>';
    echo 'function redirectToDatabases() {';
    echo '    window.location.href = "http://localhost/phpmyadmin/index.php?route=/server/databases";';
    echo '}';
    echo '</script>';
    
    
}

// Close the connection to the restoreConn
$restoreConn->close();
?>
