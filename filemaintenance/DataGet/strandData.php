<?php
// subjectData.php

require('../../config/db_connection.php');

if (isset($_POST['viewStrand'])) {
    $selectedStrandCode = $_POST['viewStrand'];
 
    // Fetch strands based on the selected strand code
    $sqlStrands = "SELECT StrandID, StrandCode, StrandName, TrackTypeName, s.Specialization 
    FROM strands 
    INNER JOIN specializations s ON strands.SpecializationID = s.SpecializationID
    WHERE StrandCode = ? AND Active = 1"; // Adjust the WHERE clause based on your needs

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sqlStrands);
    $stmt->bind_param("s", $selectedStrandCode); // Assuming StrandCode is a string
    $stmt->execute();
    $resultStrands = $stmt->get_result();

    if ($resultStrands->num_rows > 0) {
        $count = 0;
        while ($row = $resultStrands->fetch_assoc()) {
            // Output the retrieved data in the desired format for the table
            $count++;
            echo '<tr>';
            
            echo '<td>' . $count . '</td>'; 
          
            echo '<td>'  . $row['StrandName'] . '</td>';
            echo '<td>' . $row['TrackTypeName'] . '</td>';
            echo '<td>' . $row['Specialization'] . '</td>';

            echo '<td>
                <div class="d-flex justify-content-center">
                    <a href="../filemaintenance/edit_strand.php?subid=' . $row['StrandID'] . '" class="btn btn-primary mx-2 btn-edit" title="Edit Strand">
                        <i class="fa fa-edit" data-toggle="tooltip" data-placement="top"></i>
                    </a>
                     
                    <a href="../filemaintenance/delete_strand.php?delid='.$row['StrandID'].'" class="btn btn-danger mx-2 btn-delete" title="Delete Strand">
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
