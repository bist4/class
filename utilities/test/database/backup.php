<?php
// Database configuration
// $host = "localhost";
// $username = "root";
// $password = "";  // No password
// $database_name = "ClassSchedule";
 
require('../../config/db_connection.php');
// Get connection object and set the charset
// $conn = mysqli_connect($host, $username, $password, $database_name);
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

if (!empty($sqlScript)) {
    $backup_folder = 'Backup/';

    // Check if the backup folder exists or create it
    if (!file_exists($backup_folder)) {
        mkdir($backup_folder, 0777, true);
    }

    $backup_file_name = $backup_folder . $database_name . '_backup_' . time() . '.sql';

    // Open the file for writing
    $fileHandler = fopen($backup_file_name, 'w');

    // Check if file was opened successfully
    if ($fileHandler === false) {
        die("Error: Unable to open the backup file for writing.");
    }

    $number_of_lines = fwrite($fileHandler, $sqlScript);

    // Check if write was successful
    if ($number_of_lines === false) {
        die("Error: Unable to write to the backup file.");
    }

    fclose($fileHandler);

    // Download the SQL backup file to the browser
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file_name));
    ob_clean();
    flush();
    readfile($backup_file_name);
    unlink($backup_file_name); // Delete the backup file after download
    exit;
}
?>
