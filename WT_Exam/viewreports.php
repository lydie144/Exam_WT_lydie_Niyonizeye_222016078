<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Retrieve reports records from the database
$sql = "SELECT * FROM reports";
$result = $conn->query($sql);

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
    echo '<tr><th>Report ID</th><th>Report Name</th><th>Description</th><th>User ID</th><th>Actions</th></tr>';

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['ReportID']}</td>
                <td>{$row['ReportName']}</td>
                <td>{$row['Description']}</td>
                <td>{$row['user_id']}</td>
                <td class='actions'>
                    <a href='updatereports.php?id={$row['ReportID']}'><img src='images/pen.jpeg' alt='Update' title='Update'></a>
                    <a href='deleteReports.php?id={$row['ReportID']}'><img src='images/Bin1.jpeg' alt='Delete' title='Delete'></a>
                </td>
              </tr>";
    }

    echo '</table>';
} else {
    echo '0 results';
}

// Close the database connection
$conn->close();
?>
