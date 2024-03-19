<?php
$folderPath = $_GET['folder'];
$logFile = '/opt/lampp/htdocs/NewUp/class/Schedule/utilities/database/database/folder_creation_log.txt';

try {
    if (!file_exists($folderPath)) {
        if (mkdir($folderPath, 0777, true)) {
            echo 'Folder created successfully.';
        } else {
            echo 'Error creating folder. Check permissions.';
        }
    } else {
        echo 'Folder already exists.';
    }
} catch (Exception $e) {
    error_log("Error creating folder: " . $e->getMessage() . "\n", 3, $logFile);
    echo 'Error creating folder. Check the server logs for more details.';
}
?>
