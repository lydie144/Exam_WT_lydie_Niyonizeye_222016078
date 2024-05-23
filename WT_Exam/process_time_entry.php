<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskID = $_POST['task_id'];
    $userID = $_POST['user_id'];
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];
    $description = $_POST['description'];

    // Validate form data
    if (empty($taskID) || empty($userID) || empty($startTime) || empty($endTime) || empty($description)) {
        echo "All fields are required.";
        exit;
    }

    // Insert the record
    $sql = "INSERT INTO time_entries (task_id, user_id, start_time, end_time, description) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error preparing the statement: " . $conn->error;
        exit;
    }

    $stmt->bind_param("iisss", $taskID, $userID, $startTime, $endTime, $description);

    if ($stmt->execute()) {
        echo "Record added successfully";
    } else {
        echo "Error adding record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
