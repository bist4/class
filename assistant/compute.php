<?php
// Check if the result parameter is set in the POST request
if(isset($_POST['result'])) {
    // Retrieve the result value from the POST data
    $result = $_POST['result'];
    
    // Send back the processed result
    echo $result;
} else {
    // If the result parameter is not set, return an error message
    echo "Error: Result parameter not set";
}
?>
