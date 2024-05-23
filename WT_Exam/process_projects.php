<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Initialize variables to hold success and error messages
$successMessage = $errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_name = $_POST['project_name'];
    $description = $_POST['description'];
    $created_by = $_POST['created_by'];
    $created_at = date('Y-m-d H:i:s'); // Current timestamp

    // Insert data into the projects table
    $sql = "INSERT INTO projects (project_name, description, created_by, created_at) VALUES ('$project_name', '$description', '$created_by', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = 'Project added successfully';
    } else {
        $errorMessage = 'Error: ' . $sql . '<br>' . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Form</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <div class="container">
        <h2>Projects Form</h2>
        <?php if ($successMessage): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php elseif ($errorMessage): ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php else: ?>
            <form action="process_projects.php" method="post">
                <label for="project_name">Project Name:</label>
                <input type="text" id="project_name" name="project_name" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>

                <label for="created_by">Created By:</label>
                <input type="text" id="created_by" name="created_by" required>

                <input type="submit" value="Submit">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
