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
    // Retrieve form data
    $entry_id = $_POST['entry_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $description = $_POST['description'];

    // Update the time entry record
    $sql = "UPDATE time_entries SET start_time=?, end_time=?, description=? WHERE entry_id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        handleError("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("sssi", $start_time, $end_time, $description, $entry_id);

    if ($stmt->execute()) {
        // Redirect to viewtime_entries.php after successful update
        header("Location: viewtime_entries.php");
        exit();
    } else {
        // Display error message
        handleError("Error updating record: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    handleError("Invalid request method.");
}
?>
