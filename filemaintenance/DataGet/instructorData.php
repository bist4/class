<?php
require('../../config/db_connection.php');

if (isset($_POST['viewInstructor'])) {
    $selectedInstructorID = $_POST['viewInstructor'];

    // Fetch instructor data and departments based on the selected InstructorID
    $sqlInstructor = "SELECT i.InstructorID, i.Fname, i.Mname, i.Lname, i.Gender, i.Age, i.Birthday, i.Address, i.ContactNumber, i.Email, i.Specialization, i.Status, GROUP_CONCAT(dt.DepartmentTypeName) AS DepartmentNames 
        FROM instructor i
        INNER JOIN departmenttypename dt ON i.DepartmentID = dt.DepartmentTypeNameID
        WHERE DepartmentID = ? AND Active = 1
        GROUP BY i.InstructorID";

    $stmt = $conn->prepare($sqlInstructor);
    $stmt->bind_param("i", $selectedInstructorID);
    $stmt->execute();
    $resultInst = $stmt->get_result();

    if ($resultInst->num_rows > 0) {
        $count = 0;
        while ($row = $resultInst->fetch_assoc()) {
            $count++;
            echo '<tr>';
            // echo '<td><input type="checkbox" class="instructorCheckbox" name="selectedInstructor[]" value="' . $row['InstructorID'] . '"></td>';
            echo '<td>' . $count . '</td>'; 
            echo '<td>' . $row['DepartmentNames'] . '</td>';
            echo '<td>' . $row['Fname'] . ' ' . $row['Mname'] . ' ' . $row['Lname'] . '</td>';
            echo '<td>' . $row['Gender'] . '</td>';
            echo '<td>' . $row['Age'] . '</td>';
            echo '<td>' . $row['Birthday'] . '</td>';
            echo '<td>' . $row['Address'] . '</td>';
            echo '<td>' . $row['ContactNumber'] . '</td>';
            echo '<td>' . $row['Email'] . '</td>';
            echo '<td>' . $row['Specialization'] . '</td>';
            echo '<td>' . $row['Status'] . '</td>';
           
            echo '<td>
                <div class="d-flex justify-content-center">
                    <a href="../filemaintenance/edit_instructor.php?subid=' . $row['InstructorID'] . '" class="btn btn-primary mx-2 btn-edit" title="Edit Instructor">
                        <i class="fa fa-edit" data-toggle="tooltip" data-placement="top"></i>
                    </a>
                     
                    <a href="../filemaintenance/delete_instructor.php?delid='.$row['InstructorID'].'" class="btn btn-danger mx-2 btn-delete" title="Delete Instructor">
                        <i class="fa fa-trash" data-toggle="tooltip" data-placement="top"></i>
                    </a>
                </div>
            </td>';
    
            echo '</tr>';
        }
    } else {
        // No data found for the selected InstructorID
        echo '<tr><td colspan="12" class="text-center">No data found</td></tr>';
    }

    $stmt->close();
    $conn->close();
}
?>



