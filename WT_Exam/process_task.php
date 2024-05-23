<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $task_name = $_POST['task_name'];
    $description = $_POST['description'];
    $project_id = $_POST['project_id'];
    $assigned_to = $_POST['assigned_to'];

    // Prepare the SQL statement
    $sql = "INSERT INTO tasks (task_name, description, project_id, assigned_to) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssis", $task_name, $description, $project_id, $assigned_to);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Task added successfully'); window.location.href='tasksForm.html';</script>";
    } else {
        echo "Error inserting record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
