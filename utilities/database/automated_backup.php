<?php
// ... (previous code for generating SQL backup)

// Specify the download location
$backupFilename = 'backup_' . time() . '.sql';

// Redirect the user to the download link
header('Location: ' . $backupFilename);
exit;
?>
