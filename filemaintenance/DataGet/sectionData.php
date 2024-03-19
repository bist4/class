<?php
// subjectData.php

require('../../config/db_connection.php');

if (isset($_POST['viewSection'])) {
    $selectedDepartmentID = $_POST['viewSection'];
 
    // Fetch sections based on the selected department ID
    $sqlSections = "SELECT s.SectionID, s.SectionNo, s.SectionName, i.Fname, i.Mname, i.Lname
    FROM sections s
    INNER JOIN instructor i ON s.Adviser = i.InstructorID
    WHERE s.DepartmentID = ? AND s.Active = 1"; // Adjust the WHERE clause based on your needs

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sqlSections);
    $stmt->bind_param("i", $selectedDepartmentID);
    $stmt->execute();
    $resultSubjects = $stmt->get_result();

    if ($resultSubjects->num_rows > 0) {
        $count = 0;
        while ($row = $resultSubjects->fetch_assoc()) {
            // Output the retrieved data in the desired format for the table
            $count++;
            $FullName = $row['Fname'] . ' ' . $row['Mname'] . ' ' . $row['Lname'];
            echo '<tr>';
            echo '<td><input type="checkbox" class="sectionCheckbox" name="selectedSection[]" value="' . $row['SectionID'] . '"></td>';
            echo '<td>' . $count . '</td>'; 
            echo '<td>' . 'Section Number: ' . $row['SectionNo'] . '<br>Section Name: ' . $row['SectionName'] . '</td>';
            echo '<td>' . $FullName. '</td>';



            echo '<td>
                <div class="d-flex justify-content-center">
                    <a href="../filemaintenance/edit_section.php?subid=' . $row['SectionID'] . '" class="btn btn-primary mx-2 btn-edit" title="Edit Section">
                        <i class="fa fa-edit" data-toggle="tooltip" data-placement="top"></i>
                    </a>
                     
                    <a href="../filemaintenance/delete_section.php?delid='.$row['SectionID'].'" class="btn btn-danger mx-2 btn-delete" title="Delete Section">
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

 
 

