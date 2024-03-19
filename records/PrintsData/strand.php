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
        require('../config/db_connection.php');

        // Fetch class schedule data from the database
        $sql = "SELECT * FROM strands WHERE Active = 1";
        $result = $conn->query($sql);

        // Check if there is data available
        if ($result->num_rows > 0) {
            // Prepare the report table
            echo '<table id="strandsTable">
                    <tr>
                        <th>Strand Code</th>
                        <th>Strand Name</th>
                        <th>Track Type</th>
                        <th>Specialization</th>
                    </tr>';

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Add rows to the report table
                echo '<tr data-active="1">
                        <td>' . $row['StrandCode'] . '</td>
                        <td>' . $row['StrandName'] . '</td>
                        <td>' . $row['TrackTypeName'] . '</td>
                        <td>' . $row['Specialization'] . '</td>
                    </tr>';
            }
            echo '</table>';
        } else {
            // No data available
            echo "<p>No data</p>";
        }
        ?>

        <script>
            // Automatically trigger printing when the page loads
            window.onload = function() {
                window.print();
            };
        </script>
    </div>
</body>
</html>
