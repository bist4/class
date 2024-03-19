<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Instructor Reports</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
    <style>
        /* Add any necessary CSS styles for formatting */
        table {
            border-collapse: collapse;
            width: 75%;
            margin: auto; /* Center the table */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #F28705;
            color: #fff;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 15px;
        }

        .print-header {
            text-align: left;
        }

        .header img {
            width: 100px;
            height: 100px;
        }

        .header-text {
            display: inline-block;
            vertical-align: top;
            margin-left: 10px; /* Adjust the margin as needed */
        }

        .print-table {
            margin: 60px auto;
            width: 85%;
        }

        .par::before {
            content: '';
            position: fixed;
            top: 100px;
            height: 4px;
            width: 90%;
            background-color: #F28705;
            z-index: -1;
        }

        /* Additional styles for table */
        .print-table table {
            width: 100%;
        }

        .print-table th,
        .print-table td {
            padding: 8px;
            text-align: left;
        }

        .print-table th {
            background-color: #F28705;
            color: #fff;
        }

        .print-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .print-table tr:hover {
            background-color: #ddd;
        }

        /* Adjust the top margin of h2 to make it smaller and move it down */
        h2 {
            margin-top: 30px;
            margin-bottom: 20px;
            font-size: 18px; /* Adjust the font size as needed */
            text-align: center; /* Center the h2 element */
        }
    </style>
</head>

<body>
    <div>
        <div class="print-header">
            <div class="header">
                <img src="../assets/img/logo1.png" alt="logo">
                <div class="header-text">
                    <h1>Smart Achievers Academy Subic, Inc.</h1>
                    <p>Block 4 Lots 3 & 4 St. James Subdivision, Calapacuan Subic Zambales, Philippines</p>
                    <p class="par">Mobile No.: 09985501994/09303666559/09178348413 | Tel No. (047) 232-8224</p>
                </div>
            </div>
        </div>
        <h2>Instructor Reports</h2>

        <?php
require('../config/db_connection.php');

// Fetch instructor data from the database
$sql = "SELECT * FROM users WHERE Active = 1 AND RoleID = 4";
$result = $conn->query($sql);

// Check if there is data available
if ($result->num_rows > 0) {
    // Initialize an associative array to store Specialization values for each unique key
    $specializationArray = array();

    // Loop through the result set and populate the specialization array
    while ($row = $result->fetch_assoc()) {
        $key = $row['Fname'] . $row['Lname'] . $row['Mname'] . $row['Gender'] . $row['BirthDate'] . $row['Email'] . $row['Address']. $row['ContactNumber'];

        // Check if the key already exists in the array
        if (array_key_exists($key, $specializationArray)) {
            // Append the current row's specialization to the existing value
            $specializationArray[$key] .= ', ' . $row['Specialization'];
        } else {
            // Create a new entry in the array for the current key
            $specializationArray[$key] = $row['Specialization'];
        }
    }

    // Prepare the report table
    echo '<div class="print-table">
            <table id="visibleTable">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Birthday</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Specialization</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';

    // Output data of each unique key
    foreach ($specializationArray as $key => $specialization) {
        // Split the key to retrieve individual values
        list($fname, $lname, $mname, $gender, $birthdate, $email,$address,$contactnumber ) = str_split($key, strlen($key) / 8);

        // Add rows to the report table
        echo '<tr data-active="1">
                <td>' . $fname . ' ' . $lname . ' ' . $mname . '</td>
                <td>' . $gender . '</td>
                <td></td> <!-- Add age calculation logic here -->
                <td>' . $birthdate . '</td>
                <td>'.$address.'</td> <!-- Add address field logic here -->
                <td>'.$contactnumber.'</td> <!-- Add contact number field logic here -->
                <td>' . $email . '</td>
                <td>' . $specialization . '</td>
                <td></td> <!-- Add status field logic here -->
            </tr>';
    }
    echo '</tbody></table></div>';
} else {
    // No data available
    echo "<p>No data</p>";
}
?>


        <script>
            // Function to export table data to Excel
            function exportToExcel() {
                // Check if there are rows to export
                const table = document.getElementById('visibleTable');

                if (!table) {
                    alert('No data to export.');
                    return;
                }

                // Create a new Excel Workbook
                const wb = XLSX.utils.book_new();

                // Prepare the Excel sheet
                const ws = XLSX.utils.table_to_sheet(table);

                // Add the sheet to the Workbook
                XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                // Save the Workbook to an Excel file with a custom title
                XLSX.writeFile(wb, 'InstructorReports.xlsx');
            }
        </script>

        <script>
            // Automatically trigger printing when the page loads
            window.onload = function() {
                window.print();
            };
        </script>
    </div>

</body>

</html>
