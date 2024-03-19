<?php
// subjectData.php

require('../../config/db_connection.php');

if (isset($_POST['viewRoom'])) {
    $selectedDepartmentTypeID = $_POST['viewRoom'];
 
    // Fetch rooms based on the selected department ID
    $sqlRoom = "SELECT RoomID, RoomNumber, Capacity, RoomType  FROM rooms 
    WHERE DepartmentID = ? AND Active = 1"; // Adjust the WHERE clause based on your needs

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sqlRoom);
    $stmt->bind_param("i", $selectedDepartmentTypeID);
    $stmt->execute();
    $resultSubjects = $stmt->get_result();

    if ($resultSubjects->num_rows > 0) {
        $count = 0;
        while ($row = $resultSubjects->fetch_assoc()) {
            // Output the retrieved data in the desired format for the table
            $count++;
            echo '<tr>';
            echo '<td><input type="checkbox" class="roomCheckbox" name="selectedRoom[]" value="' . $row['RoomID'] . '"></td>';
            echo '<td>' . $count . '</td>'; 
            echo '<td>' . $row['RoomNumber'] . '</td>';
            echo '<td>'. $row['Capacity'] .'</td>';
            echo '<td>'. $row['RoomType'] .'</td>';



            echo '<td>
                <div class="d-flex justify-content-center">
                    <a href="../filemaintenance/edit_room.php?subid=' . $row['RoomID'] . '" class="btn btn-primary mx-2 btn-edit" title="Edit room">
                        <i class="fa fa-edit" data-toggle="tooltip" data-placement="top"></i>
                    </a>
                     
                    <a href="../filemaintenance/delete_room.php?delid='.$row['RoomID'].'" class="btn btn-danger mx-2 btn-delete" title="Delete room">
                        <i class="fa fa-trash" data-toggle="tooltip" data-placement="top"></i>
                    </a>

                    
                </div>
            </td>';
        
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6" class="text-center">No data found</td></tr>';
    }

    $stmt->close();
    $conn->close();
}
?>

 
 

