<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if entry_id is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $entry_id = $_GET['id'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM time_entries WHERE entry_id = ?";
    $stmt = $conn->prepare($sql);

    if($stmt) {
        $stmt->bind_param("i", $entry_id);
        if($stmt->execute()) {
            echo "Time entry deleted successfully.";
        } else {
            echo "Error deleting time entry: " . $stmt->error;
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
