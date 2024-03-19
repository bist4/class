<?php
// subjectData.php

require('../../config/db_connection.php');

if (isset($_POST['viewSubjects'])) {
    $selectedDepartmentID = $_POST['viewSubjects'];
 
    // Fetch subjects based on the selected department ID
    $sqlSubjects = "SELECT SubjectID,SubjectCode, SubjectDescription, Units FROM subjects WHERE DepartmentID = ? AND Active = 1"; // Adjust the WHERE clause based on your needs

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sqlSubjects);
    $stmt->bind_param("i", $selectedDepartmentID);
    $stmt->execute();
    $resultSubjects = $stmt->get_result();

    if ($resultSubjects->num_rows > 0) {
        $count = 0;
        while ($row = $resultSubjects->fetch_assoc()) {
            // Output the retrieved data in the desired format for the table
            $count++;
            echo '<tr>';
            echo '<td><input type="checkbox" class="subjectCheckbox" name="selectedSubjects[]" value="' . $row['SubjectID'] . '"></td>';
            echo '<td>' . $count . '</td>'; 
            echo '<td>' . $row['SubjectCode'] . '</td>';
            echo '<td>' . $row['SubjectDescription'] . '</td>';
            echo '<td>' . $row['Units'] . '</td>';

            echo '<td>
                <div class="d-flex justify-content-center">
                    <a href="../filemaintenance/edit_subject.php?subid=' . $row['SubjectID'] . '" class="btn btn-primary mx-2 btn-edit" title="Edit Strand">
                        <i class="fa fa-edit" data-toggle="tooltip" data-placement="top"></i>
                    </a>
                     
                    <a href="../filemaintenance/delete_subject.php?delid='.$row['SubjectID'].'" class="btn btn-danger mx-2 btn-delete" title="Delete Subject">
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

 
 

