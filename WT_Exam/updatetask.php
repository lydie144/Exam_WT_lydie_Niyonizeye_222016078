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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskID = $_POST['task_id'];
    $taskName = $_POST['task_name'];
    $description = $_POST['description'];
    $projectID = $_POST['project_id'];
    $assignedTo = $_POST['assigned_to'];

    // Update the record
    $sql = "UPDATE tasks SET task_name=?, description=?, project_id=?, assigned_to=? WHERE task_id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        handleError("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("ssisi", $taskName, $description, $projectID, $assignedTo, $taskID);

    if ($stmt->execute()) {
        echo "<div style='color: green; text-align: center; margin-top: 20px;'>Record updated successfully</div>";
    } else {
        handleError("Error updating record: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    // Retrieve the record to update
    if (isset($_GET['id'])) {
        $taskID = $_GET['id'];
        $sql = "SELECT * FROM tasks WHERE task_id=?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            handleError("Error preparing the statement: " . $conn->error);
        }

        $stmt->bind_param("i", $taskID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row === null) {
            handleError("No record found with task ID: " . htmlspecialchars($taskID));
        }

        $stmt->close();
    } else {
        handleError("No task ID provided in the URL.");
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Task</title>
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
            input[type="text"], textarea, select {
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
            <h2>Update Task</h2>
            <form action="updatetask.php" method="post">
                <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($row['task_id']); ?>">

                <label for="task_name">Task Name:</label>
                <input type="text" id="task_name" name="task_name" value="<?php echo htmlspecialchars($row['task_name']); ?>" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($row['description']); ?></textarea>

                <label for="project_id">Project ID:</label>
                <input type="text" id="project_id" name="project_id" value="<?php echo htmlspecialchars($row['project_id']); ?>" required>

                <label for="assigned_to">Assigned To:</label>
                <input type="text" id="assigned_to" name="assigned_to" value="<?php echo htmlspecialchars($row['assigned_to']); ?>" required>

                <input type="submit" value="Update">
            </form>
        </div>
    </body>
    </html>
    <?php
}
?>
