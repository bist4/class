<?php
// DataGet/get_specializations.php

require('../../config/db_connection.php');

// Check if the specialization ID parameter is provided
if (isset($_GET['selectedSpecializationID'])) {
    $selectedSpecializationID = $_GET['selectedSpecializationID'];

    // Prepare the query to get the selected specialization and other specializations
    $sqlSpecialization = "SELECT SpecializationID, Specialization FROM specializations";
    $resultSpecialization = $conn->query($sqlSpecialization);

    $specializations = array();
    if ($resultSpecialization->num_rows > 0) {
        while ($row = $resultSpecialization->fetch_assoc()) {
            $specializationData = array(
                "SpecializationID" => $row['SpecializationID'],
                "Specialization" => $row['Specialization'],
                "Selected" => ($row['SpecializationID'] === $selectedSpecializationID) ? true : false
            );
            $specializations[] = $specializationData;
        }
    }

    echo json_encode($specializations);
} else {
    // If no specialization ID provided, return all specializations
    $sqlSpecializationAll = "SELECT SpecializationID, Specialization FROM specializations";
    $resultSpecializationAll = $conn->query($sqlSpecializationAll);

    $specializationsAll = array();
    if ($resultSpecializationAll->num_rows > 0) {
        while ($row = $resultSpecializationAll->fetch_assoc()) {
            $specializationsAll[] = array(
                "SpecializationID" => $row['SpecializationID'],
                "Specialization" => $row['Specialization'],
                "Selected" => false
            );
        }
    }

    echo json_encode($specializationsAll);
}
?>
