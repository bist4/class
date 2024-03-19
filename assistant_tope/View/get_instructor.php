<?php
require('../../config/db_connection.php');

if (isset($_POST['instructor'])) {
    $instructor = $_POST['instructor'];

    $query = "SELECT * FROM classschedule 
              WHERE Instructor = '$instructor' 
              AND Active = 1";

    $result = $conn->query($query);

    $instructors = [];

    while ($row = $result->fetch_assoc()) {
        $key = $row['Instructor'] . '_' . $row['Time_Start'] . '_' . $row['Time_End'] . '_' . $row['Subject'] . '_' . $row['YearLevel'] . '_' . $row['Room'];

        if (!isset($instructors[$key])) {
            $instructors[$key] = [
                'Days' => [],
                'Time_Start' => $row['Time_Start'],
                'Time_End' => $row['Time_End'],
                'Subject' => $row['Subject'],
                'Instructor' => $row['Instructor'],
                'YearLevel' => $row['YearLevel'],
                'Room' => $row['Room'],
            ];
        }

        $instructors[$key]['Days'][] = $row['Day'];
    }

    // Define the order of days
    $orderOfDays = ['M' => 1, 'T' => 2, 'W' => 3, 'TH' => 4, 'F' => 5];

    // Sort instructors first by time in ascending order, then by days
    uasort($instructors, function ($a, $b) use ($orderOfDays) {
        $timeStartA = strtotime($a['Time_Start']);
        $timeStartB = strtotime($b['Time_Start']);

        // Compare times first
        if ($timeStartA !== $timeStartB) {
            return $timeStartA - $timeStartB;
        }

        $daysA = $a['Days'];
        $daysB = $b['Days'];

        foreach ($daysA as $day) {
            $orderA[] = $orderOfDays[$day];
        }

        foreach ($daysB as $day) {
            $orderB[] = $orderOfDays[$day];
        }

        // If times are the same, sort by days
        return min($orderA) - min($orderB);
    });

    foreach ($instructors as $instructor) {
        $days = $instructor['Days'];
        $mergedDays = implode(', ', $days);
        ?>
        <tr>
            <td><?php echo $instructor['YearLevel']; ?></td>
            <td><?php echo $instructor['Subject']; ?></td>
            <td><?php echo date("h:i A", strtotime($instructor['Time_Start'])) . ' - ' . date("h:i A", strtotime($instructor['Time_End'])); ?></td>
            <td><?php echo $mergedDays; ?></td>
            <td><?php echo $instructor['Room']; ?></td>
        </tr>
        <?php
    }

    $result->close();
} else {
    echo '<option disabled selected>Select Department</option>';
}
?>
