<?php
require('../../config/db_connection.php');

if (isset($_POST['departmentID'])) {
    $departmentID = $_POST['departmentID'];

    // Check if the selected DepartmentTypeNameID exists in the 'department' table using prepared statements
    $sqlCheckDepartmentType = "SELECT DepartmentID FROM department WHERE DepartmentTypeNameID = ?";
    $stmtCheckDepartmentType = $conn->prepare($sqlCheckDepartmentType);
    $stmtCheckDepartmentType->bind_param("s", $departmentID);
    $stmtCheckDepartmentType->execute();
    $resultCheckDepartmentType = $stmtCheckDepartmentType->get_result();

    if ($resultCheckDepartmentType->num_rows > 0) {
        // The DepartmentTypeNameID is valid, and you can proceed with fetching Year Levels, Semesters, and StrandID.
        $sqlYearLevel = "SELECT DISTINCT d.YearLevel, d.Semester, d.DepartmentID, s.StrandID, s.StrandCode
                        FROM department d
                        LEFT JOIN strands s ON d.StrandID = s.StrandID
                        WHERE d.DepartmentTypeNameID = ? AND d.Active = 1";
        $stmtYearLevel = $conn->prepare($sqlYearLevel);
        $stmtYearLevel->bind_param("s", $departmentID);
        $stmtYearLevel->execute();
        $resultYearLevel = $stmtYearLevel->get_result();

        if ($resultYearLevel->num_rows > 0) {
            echo '<option disabled selected>Select Year Level</option>';
            while ($row = $resultYearLevel->fetch_assoc()) {
                echo '<option value="' . $row['DepartmentID'] . '">'
                    . 'Grade ' . $row['YearLevel'];

                if (!is_null($row['Semester'])) {
                    $semesterSuffix = ($row['Semester'] == 1) ? 'st' : 'nd';
                    echo ' ' . $row['Semester'] . $semesterSuffix . ' Semester';
                }

                if (!is_null($row['StrandID'])) {
                    echo ' ' . $row['StrandCode'];
                }

                echo '</option>';
            }
        } else {
            echo '<option disabled>No Year Levels available for this department</option>';
        }
    } else {
        // Invalid DepartmentTypeNameID, handle the error as needed
        echo '<option disabled selected>Invalid Department</option>';
    }

    // Close the prepared statements
    $stmtCheckDepartmentType->close();
    $stmtYearLevel->close();
} else {
    echo '<option disabled selected>Select Department first</option>';
}
?>
