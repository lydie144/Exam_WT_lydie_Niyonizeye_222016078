<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve clients records from the database
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

// Check if there are any records
if ($result === FALSE) {
    die("Error: " . $conn->error);
}

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
    echo '<tr>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>Contact Person</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>';

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['client_id']}</td>
                <td>{$row['client_name']}</td>
                <td>{$row['contact_person']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['address']}</td>
                <td class='actions'>
                    <a href='updateclient.php?id={$row['client_id']}'><img src='images/pen.jpeg' alt='Update' title='Update'></a>
                    <a href='confirmdeleteclient.php?id={$row['client_id']}'><img src='images/Bin1.jpeg' alt='Delete' title='Delete'></a>
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
