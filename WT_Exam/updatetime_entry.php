<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Function to handle errors and display them
function handleError($message) {
    echo "<div style='color: red; text-align: center; margin-top: 20px;'>" . htmlspecialchars($message) . "</div>";
    exit();
}

// Check if entry_id is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $entry_id = $_GET['id'];

    // Fetch time entry details from the database based on entry_id
    $sql = "SELECT * FROM time_entries WHERE entry_id = ?";
    $stmt = $conn->prepare($sql);

    if($stmt) {
        $stmt->bind_param("i", $entry_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1) {
            // Time entry found, fetch data
            $row = $result->fetch_assoc();
            // Display update form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Time Entry</title>
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
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2, label {
            text-align: center;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
        input[type="text"], textarea, select, input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Time Entry</h2>
        <form action="process_update_time_entry.php" method="post">
            <input type="hidden" name="entry_id" value="<?php echo $row['entry_id']; ?>">
            <label for="start_time">Start Time:</label>
            <input type="datetime-local" id="start_time" name="start_time" value="<?php echo $row['start_time']; ?>" required>
            <label for="end_time">End Time:</label>
            <input type="datetime-local" id="end_time" name="end_time" value="<?php echo $row['end_time']; ?>" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required><?php echo $row['description']; ?></textarea>
            <input type="submit" value="Update Entry">
        </form>
    </div>
</body>
</html>
<?php
        } else {
            echo "Time entry not found.";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Entry ID not provided.";
}
?>
