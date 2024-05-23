<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Fetch time entries from the database
$sql = "SELECT te.entry_id, te.start_time, te.end_time, te.description, 
               t.task_name, u.username
        FROM time_entries te
        JOIN tasks t ON te.task_id = t.task_id
        JOIN users u ON te.user_id = u.user_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Time Entries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/wtch.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .action-links a {
            margin-right: 5px;
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Time Entries</h2>
        <table>
            <tr>
                <th>Entry ID</th>
                <th>Task Name</th>
                <th>User Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['entry_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['task_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['start_time']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['end_time']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td class='action-links'>";
                    echo "<a href='updatetime_entry.php?id=" . urlencode($row['entry_id']) . "'>Update</a>";
                    echo "<a href='deletetime_entry.php?id=" . urlencode($row['entry_id']) . "' onclick='return confirm(\"Are you sure you want to delete this time entry?\");'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No time entries found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
