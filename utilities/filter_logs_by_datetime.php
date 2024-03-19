<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../assets/js/demo/datatables-demo.js"></script>

<?php
if (isset($_POST['dateTime'])) {
    $selectedDateTime = $_POST['dateTime'];
    require('../config/db_connection.php');

    // Fetch logs for the selected date and time from the database
    $table = mysqli_query($conn, "SELECT logs.*, users.Fname, users.Lname, roles.Roles 
                                    FROM logs 
                                    INNER JOIN users ON logs.UserID = users.UserID
                                    INNER JOIN roles ON users.RoleID = roles.RoleID
                                    WHERE logs.Active = 1 
                                    AND logs.DateTime = '$selectedDateTime'
                                    ORDER BY logs.DateTime DESC");

    // Output the filtered logs in HTML format
    $count = 0;
    while ($row = mysqli_fetch_array($table)) {
        $count++;
        $highlightClass = ($count == 1) ? 'text-primary' : '';
        echo '<tr class="' . $highlightClass . '">
                <td>' . $count . '</td>
                <td>' . $row['Roles'] . '</td>
                <td>' . $row['Fname'] . ' ' . $row['Lname'] . '</td>
                <td>' . $row['Activity'] . '</td>
                <td>' . $row['DateTime'] . '</td>
            </tr>';
    }
}


?>