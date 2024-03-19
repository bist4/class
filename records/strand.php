<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Strand Reports</title>

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
        <h2>Strand Reports</h2>

        <?php
        require('../config/db_connection.php');

        // Fetch class schedule data from the database
        $sql = "SELECT * FROM strands WHERE Active = 1";
        $result = $conn->query($sql);

        // Check if there is data available
        if ($result->num_rows > 0) {
            // Prepare the report table
            echo '<table id="strandsTable">
            <tbody>
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
            echo '</tbody></table></div>';
        } else {
            // No data available
            echo "<p>No data</p>";
        }
        ?>
        <script>
        function exportToExcel() {
            // Select the table element
            var table = document.querySelector(".print-table table");

            // Create an empty Workbook
            var wb = XLSX.utils.book_new();

            // Add a Worksheet to the Workbook
            var ws = XLSX.utils.table_to_sheet(table);

            // Add the Worksheet to the Workbook
            XLSX.utils.book_append_sheet(wb, ws, "Sheet 1");

            // Generate Excel file as data URI
            var dataUri = XLSX.write(wb, { bookType: "xlsx", type: "blob" });

            // Create a download link and trigger a click to download the Excel file
            var link = document.createElement("a");
            link.href = URL.createObjectURL(dataUri);
            link.download = "StrandsReport.xlsx"; // Set the filename here
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
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
