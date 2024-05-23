<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Retrieve projects records from the database
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);

// Check if there are any records
if ($result === false) {
    echo "Error: " . $conn->error;
} else {
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
        echo '<tr><th>Project ID</th><th>Project Name</th><th>Description</th><th>Created By</th><th>Created At</th><th>Actions</th></tr>';

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['project_id']}</td>
                    <td>{$row['project_name']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['created_by']}</td>
                    <td>{$row['created_at']}</td>
                    <td class='actions'>
                        <a href='updateprojects.php?id={$row['project_id']}'><img src='images/pen.jpeg' alt='Update' title='Update'></a>
                        <a href='deleteprojects.php?id={$row['project_id']}'><img src='images/Bin1.jpeg' alt='Delete' title='Delete'></a>
                    </td>
                  </tr>";
        }

        echo '</table>';
    } else {
        echo '0 results';
    }
}

// Close the database connection
$conn->close();
?>
