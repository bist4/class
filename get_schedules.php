<?php
require('config/db_connection.php');

if (isset($_GET['strand'])) {
    $strand = $_GET['strand'];

    // Prepare the statement
    $stmt = $conn->prepare("SELECT history.*, rooms.RoomNumber FROM history 
    INNER JOIN rooms ON history.RoomID = rooms.RoomID
    INNER JOIN roomtype ON rooms.RoomTypeID = roomtype.RoomTypeID
    WHERE Strand = ?");
    
    $stmt->bind_param("s", $strand);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Reverse mapping for numeric days
    $numericDaysReverse = [
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        // Add other days as needed
    ];

    // Add a "Send" button at the top of the table
    echo "<span class='float-right'>";
    echo "<div colspan='9'><button class='btn btn-primary mx-2' onclick='sendSchedule()'>Send the Schedule</button></div>";
    echo "</span>";

    // Start the table with an ID for easier targeting
    echo "<table id='schedule-table' class='table'>";

    // Fetch and display the data
    while ($row = $result->fetch_assoc()) {
        // Output your table cells here based on the columns in your SELECT statement
        echo "<tr class='schedule-row' data-class-schedule-id='" . $row['ClassScheduleID'] . "'>";
        echo "<td>" . $row['AcademicYear'] . "</td>";
        echo "<td>" . $row['YearLevel'] . "</td>";
        echo "<td>" . $row['Semester'] . "</td>";
        echo "<td>" . $row['Strand'] . "</td>";
        echo "<td>" . $row['SubjectDescription'] . "</td>";
        echo "<td>" . $row['Instructor'] . "</td>";
        echo "<td>" . $row['RoomNumber'] . "</td>"; // Change from RoomID to RoomNumber

        // Convert days to numeric values for sorting
        $days = explode(',', $row['Day']);
        usort($days, function ($a, $b) {
            return $a - $b;
        });

        $daysAsString = implode(', ', array_map(function ($numericDay) use ($numericDaysReverse) {
            return $numericDaysReverse[$numericDay];
        }, $days));

        $timeStart = date("h:i A", strtotime($row['New_Time_Start']));
        $timeEnd = date("h:i A", strtotime($row['New_Time_End']));

        echo "<td>Days: " . $daysAsString . "<br>Time: " . $timeStart . " - " . $timeEnd . "</td>";

        $statusClass = '';
        $statusText = '';

        switch ($row['Status']) {
            case 0:
                $statusClass = 'info';
                $statusText = 'Ready to Send';
                break;
            case 1:
                $statusClass = 'success';
                $statusText = 'Approved';
                break;
            case 2:
                $statusClass = 'warning'; // Use 'warning' or another class for "Waiting"
                $statusText = 'Pending';
                break;
            default:
                // Handle any other status values as needed
                break;
        }

        echo "<td><span class='mx-2 badge badge-" . $statusClass . "'>" . $statusText . "</span></td>";
      
        // Disable the "Edit" button if the status is "Pending"
        echo "<td><button class='btn btn-primary mx-2 send-btn'" . ($row['Status'] == 0 ? '' : 'disabled') . ">Edit</button></td>";

        echo "</tr>";
    }

    // Close the table
    echo "</table>";

    // Close the statement
    $stmt->close();
}

$conn->close();
?>

<!-- Add SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function sendSchedule() {
        // Get all selected rows
        var selectedRows = document.querySelectorAll('.schedule-row');

        // Check if any selected row has a status of 2 (Pending)
        var hasPendingStatus = Array.from(selectedRows).some(function(row) {
            return row.querySelector('.badge').textContent.trim() === 'Pending';
        });

        // If there is a row with a status of 2, display an error message and return
        if (hasPendingStatus) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Cannot send schedule. One or more selected rows are already pending.',
            });
            return;
        }

        // Get data from selected rows
        var selectedData = [];
        selectedRows.forEach(function(row) {
            var rowData = {
                ClassScheduleID: row.getAttribute('data-class-schedule-id'),
                Status: 2, // Set the status to 2
            };
            selectedData.push(rowData);
        });

        // Assume you have a PHP file to handle the update, replace 'update_status.php' with the actual file
        fetch('UpdateSchedule/update_schedule.php', {
            method: 'POST',
            body: JSON.stringify({ data: selectedData }), // Send selected data
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Log the data to the console
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Schedule Sent!',
                    text: 'The schedule has been sent successfully.',
                }).then(() => {
                    // Reload the page after displaying the success message
                    location.reload();
                });

                // Disable the button after sending the schedule
                document.querySelector('.send-btn').disabled = true;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to send the schedule.',
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred.',
            });
        });
    }
</script>
