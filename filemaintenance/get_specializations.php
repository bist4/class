<?php
include('../config/db_connection.php');

if (isset($_GET['code'])) {
    $strandCodeVal = $_GET['code'];

    $sqlDepartmentType = "SELECT * FROM specializations WHERE Code = '$strandCodeVal'";
    $resultDepartmentTypeName = $conn->query($sqlDepartmentType);

    $specializations = array();

    if ($resultDepartmentTypeName->num_rows > 0) {
        while ($row = $resultDepartmentTypeName->fetch_assoc()) {
            $specializations[] = array(
                'SpecializationID' => $row['SpecializationID'],
                'Specialization' => $row['Specialization']
            );
        }
    }

    echo json_encode($specializations);
}
?>
