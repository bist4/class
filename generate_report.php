<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Class Schedule Report</title>
    <style>
        /* Add any necessary CSS styles for formatting */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div>
        <h1>Class Schedule Report</h1>
        <?php
        require('config/db_connection.php');

        // Fetch class schedule data from the database
        $sql = "SELECT * FROM classschedule";
        $result = $conn->query($sql);

        // Check if there is data available
        if ($result->num_rows > 0) {
            // Prepare the report table
            echo '<table>
                    <tr>
                        <th>Academic Year</th>
                        <th>Department</th>
                        <th>Year Level</th>
                        <th>Semester</th>
                        <th>Strand</th>
                    </tr>';

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Add rows to the report table
                echo '<tr>
                        <td>' . $row['AcademicYear'] . '</td>
                        <td>' . $row['Department'] . '</td>
                        <td>' . $row['YearLevel'] . '</td>
                        <td>' . $row['Semester'] . '</td>
                        <td>' . $row['Strand'] . '</td>
                      </tr>';
            }
            echo '</table>';

            // Print button
            echo '<button onclick="window.print()">Print Report</button>';
        } else {
            // No data available
            echo "<p>No data</p>";
        }
        ?>
    </div>
</body>
</html>
