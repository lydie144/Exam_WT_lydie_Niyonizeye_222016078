<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the user ID is provided in the URL
if(isset($_GET['id'])) {
    // Get the ID of the user to delete
    $userID = $_GET['id'];

    // Disable foreign key checks temporarily
    $conn->query("SET FOREIGN_KEY_CHECKS=0");

    // Prepare the delete statement
    $sql = "DELETE FROM users WHERE user_id = ?";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);

    if ($stmt->execute()) {
        // If the deletion is successful, redirect to the users page
        header("Location: users.php");
        exit(); // Stop execution after redirection
    } else {
        // If there's an error during deletion, display an error message
        echo "Error deleting record: " . $conn->error;
    }

    // Re-enable foreign key checks
    $conn->query("SET FOREIGN_KEY_CHECKS=1");

    // Close the statement
    $stmt->close();
} else {
    // If no user ID is provided, display an error message
    echo "No User ID provided.";
}

// Close the connection
$conn->close();
?>
