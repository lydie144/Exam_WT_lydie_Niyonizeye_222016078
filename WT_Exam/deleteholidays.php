<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['holidayID'])) {
        $holidayID = $_POST['holidayID'];

        // Delete the record
        $sql = "DELETE FROM holidays WHERE HolidayID='$holidayID'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Record deleted successfully'); window.location.href='viewholidays.php';</script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "<script>alert('No ID specified.'); window.location.href='viewholidays.php';</script>";
    }

    $conn->close();
}
?>
