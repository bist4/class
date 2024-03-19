// Function to print the table
function printTable() {
    // You can customize this selector to target only the specific table you want to print
    const tableSelector = "#dataTable";

    // Create a new window with the table content
    const printWindow = window.open('', '_blank');
    const tableContent = $(tableSelector).html();

    // Write the table content to the new window
    printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Print Table</title>
            <style>
                * {
                    margin: auto auto;
                    padding: 3px 30px;
                }

                body {
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                }
                .print-header{
                    text-align: left;
                }
                .par::before{
                    content: '';
                    position: absolute;
                    left: 279px;
                    bottom: 81%;
                    height: 3px;
                    width: 75%;
                    background-color: #f47339;
                }
                .header img {
                    float: left;
                    width: 100px;
                    height: 100px;
                }

                .header h1 {
                    position: relative;
                    top: 18px;
                    left: 0;
                }
                .header p{
                    bottom: 20px;
                }
                

                .print-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 45px auto;
                }

                .print-table th,
                .print-table td {
                    padding: 8px;
                    border: 1px solid #ddd;
                }

                .print-table th {
                    background-color: #f2f2f2;
                    text-align: left;
                }

                .print-table tr:nth-child(even) {
                    background-color: #f2f2f2;
                }

                .print-table tr:hover {
                    background-color: #ddd;
                }
                    
                </style>
        </head>
        <body>
            <div class="print-header">
                <div class="header">
                    <img src="../assets/img/logo1.png" alt="logo">
                    <h1>Smart Achievers Academy Subic, Inc.</h1>
                    <br>
                    <p>Block 4 Lots 3 & 4 St. James Subdivision, Calapacuan Subic Zambales, Philippines</p>
                    <p class="par">Mobile No.: 09985501994/09303666559/09178348413 | Tel No. (047) 232-8224</p>
                </div>
            </div>
            <table class="print-table">
                <thead>
                    <tr>
                        <th>Strand Code</th>
                        <th>Strand Name</th>
                        <th>Track Type</th>
                        <th>Specialization</th>
                         
                    </tr>
                </thead>
                <tbody>
                    ${tableContent}
                </tbody>
            </table>
            
        </body>
        </html>
    `);

    // Close the new window after printing is done (optional)
    printWindow.onload = function () {
        printWindow.print();
        printWindow.close();
    };
}

// Function to export the table data to Excel
function exportToExcel() {
    const table = document.getElementById('dataTable');
    const tableData = Array.from(table.rows).map(row => Array.from(row.cells).map(cell => cell.innerText));
    const headers = Array.from(table.rows[0].cells).map(cell => cell.innerText);

    const csvContent = "data:text/csv;charset=utf-8," +
        headers.join(",") +
        "\n" +
        tableData.map(row => row.join(",")).join("\n");

    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "strands.csv");
    document.body.appendChild(link);
    link.click();
}