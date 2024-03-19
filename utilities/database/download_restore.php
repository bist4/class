<?php
if (isset($_GET['file'])) {
    $restoreFile = $_GET['file'];

    // Check if the restore file exists
    if (file_exists($restoreFile)) {
        // Set the appropriate headers for download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($restoreFile));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($restoreFile));

        // Read the restore file and output it to the browser
        readfile($restoreFile);

        exit; // Stop further execution
    } else {
        echo "Invalid file selection. File '$restoreFile' not found.";
    }
} else {
    echo "Invalid request. Please provide a valid file parameter.";
}
?>
