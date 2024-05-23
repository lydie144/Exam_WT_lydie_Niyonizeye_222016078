<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve timesheet records from the database
$sql = "SELECT * FROM timesheet";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Check if there are any records
if ($result->num_rows > 0) {
    echo '<style>
            table {
                width: 80%;
                margin: 20px auto;
                border-collapse: collapse;
            }
            th, td {
                padding: 12px;
                text-align: left;
                border: 1px solid #ddd;
            }
            th {
                background-color: skyblue;
            }
            img {
                width: 20px; /* Adjust the width as needed */
                height: 20px; /* Adjust the height as needed */
                vertical-align: middle;
            }
            td.actions {
                text-align: center;
            }
          </style>';

    echo '<table>';
    echo '<tr><th>Timesheet ID</th><th>User_ID</th><th>Week_Starting_Date</th><th>Total_Hours</th><th>Actions</th></tr>';

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['Timesheet ID']}</td>
                <td>{$row['User_ID']}</td>
                <td>{$row['Week_Starting_Date']}</td>
                <td>{$row['Total_Hours']}</td>
                <td class='actions'>
                    <a href='updatetimesheet.php?id={$row['Timesheet ID']}'><img src='images/pen.jpeg' alt='Update' title='Update'></a>
                    <a href='deletetimesheet.php?id={$row['Timesheet ID']}'><img src='images/Bin1.jpeg' alt='Delete' title='Delete'></a>
                </td>
              </tr>";
    }

    echo '</table>';
} else {
    echo '0 results';
}

// Free result set
$result->free();

// Close the database connection
$conn->close();
?>
