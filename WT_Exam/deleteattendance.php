<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if 'id' parameter is set
if (isset($_GET['id'])) {
    $attendanceID = $_GET['id'];

    // Display a confirmation form
    if (!isset($_POST['confirm'])) {
        echo "
            <form method='post'>
                <p>Are you sure you want to delete the record with ID $attendanceID?</p>
                <input type='hidden' name='attendanceID' value='$attendanceID'>
                <input type='submit' name='confirm' value='Yes'>
                <a href='viewattendance.php'>No</a>
            </form>
        ";
    } else {
        // Delete the record
        $sql = "DELETE FROM attendance WHERE AttendanceID='$attendanceID'";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully. <a href='viewattendance.php'>Go back to attendance records</a>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        // Close the connection
        $conn->close();
    }
} else {
    echo "Invalid request. <a href='viewattendance.php'>Go back to attendance records</a>";
}
?>
