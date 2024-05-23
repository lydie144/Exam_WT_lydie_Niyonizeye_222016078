<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the timesheet ID is provided in the URL
if(isset($_GET['id'])) {
    // Get the ID of the timesheet to delete
    $timesheetID = $_GET['id'];

    // Prepare the delete statement
    $sql = "DELETE FROM timesheet WHERE `Timesheet ID`=?";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $timesheetID);

    if ($stmt->execute()) {
        // If the deletion is successful, redirect to the viewtimesheet page
        header("Location: viewtimesheet.php");
        exit(); // Stop execution after redirection
    } else {
        // If there's an error during deletion, display an error message
        echo "Error deleting record: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If no timesheet ID is provided, display an error message
    echo "No Timesheet ID provided.";
}

// Close the connection
$conn->close();
?>
