<?php
// Database configuration
// $host = "localhost";
// $username = "root";
// $password = "";  // No password
// $database_name = "ClassSchedule";

require('../../config/db_connection.php');
$conn->set_charset("utf8");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get All Table Names From the Database
$tables = array();
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

$sqlScript = "";
foreach ($tables as $table) {
    // Prepare SQL script for creating table structure
    $query = "SHOW CREATE TABLE $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);

    $sqlScript .= "\n\n" . $row[1] . ";\n\n";

    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);

    $columnCount = mysqli_num_fields($result);

    // Prepare SQL script for dumping data for each table
    while ($row = mysqli_fetch_row($result)) {
        $sqlScript .= "INSERT INTO $table VALUES(";
        for ($j = 0; $j < $columnCount; $j++) {
            $row[$j] = $row[$j];

            if (isset($row[$j])) {
                $sqlScript .= '"' . $row[$j] . '"';
            } else {
                $sqlScript .= '""';
            }
            if ($j < ($columnCount - 1)) {
                $sqlScript .= ',';
            }
        }
        $sqlScript .= ");\n";
    }

    $sqlScript .= "\n";
}
// Specify the download location
$backupFilename = 'Backupdatabase' . time() . '.sql';

// Save the backup file
file_put_contents($backupFilename, $sqlScript);

// Return the filename to JavaScript
echo json_encode(['filename' => $backupFilename]);
if (!empty($sqlScript)) {
    $backup_folder = '';

    // Check if the backup folder exists or create it
    if (!file_exists($backup_folder)) {
        mkdir($backup_folder, 0777, true);
    }

    $backupFilename = $backup_folder . 'backup_' . time() . '.sql';

    // Open the file for writing
    $fileHandler = fopen($backupFilename, 'w');

    // Check if the file was opened successfully
    if ($fileHandler === false) {
        die("Error: Unable to open the backup file for writing.");
    }

    $number_of_lines = fwrite($fileHandler, $sqlScript);

    // Check if write was successful
    if ($number_of_lines === false) {
        die("Error: Unable to write to the backup file.");
    }

    fclose($fileHandler);

    // Set the appropriate headers for download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($backupFilename));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backupFilename));

    // Specify the download location
    header('Content-Security-Policy: sandbox');
    header('Content-Security-Policy: form-action \'self\'');

    ob_clean();
    flush();
    readfile($backupFilename);
    unlink($backupFilename); // Delete the backup file after download
    exit;
}
?>