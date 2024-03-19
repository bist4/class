<?php
// filter_logs.php

if (isset($_POST['month'])) {
    $selectedMonth = $_POST['month'];
    require('../config/db_connection.php');

    if ($selectedMonth === 'all') {
        // Fetch all logs from the database without filtering by month
        $table = mysqli_query($conn, "SELECT l.*, usi.Fname, usi.Lname FROM logs l
                                    --   INNER JOIN userroles usr ON logs.UserID = usr.UserRoleID
                                      INNER JOIN roles r ON r.RoleID = r.RoleID
                                      INNER JOIN userinfo usi ON l.UserID = usi.UserInfoID
                                      ORDER BY l.DateTime DESC");
        
        
        
    
    } else {
        // Fetch logs for the selected month from the database
        $table = mysqli_query($conn, "SELECT l.*, usi.Fname, usi.Lname FROM logs l
                                        -- INNER JOIN userroles usr ON logs.UserID = usr.UserRoleID
                                        -- INNER JOIN roles r ON r.RoleID = r.RoleID
                                        
                                        INNER JOIN userinfo usi ON l.UserID = usi.UserInfoID
                                        AND MONTH(l.DateTime) = '$selectedMonth'
                                        ORDER BY l.DateTime DESC");
    }

    // Output the filtered logs in HTML format
    $count = 0;
    while ($row = mysqli_fetch_array($table)) {
        $count++;
        $highlightClass = ($count == 1) ? 'text-primary' : '';
        echo '<tr class="' . $highlightClass . '">
                <td>' . $count . '</td>
              
                <td>' . $row['Fname'] . ' ' . $row['Lname'] . '</td>
                <td>' . $row['Activity'] . '</td>
                <td>' . $row['DateTime'] . '</td>
            </tr>';
    }
}
?>
