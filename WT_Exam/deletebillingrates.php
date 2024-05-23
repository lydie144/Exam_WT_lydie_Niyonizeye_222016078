<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['billingRateID'])) {
        $billingRateID = $_POST['billingRateID'];

        // Delete the record
        $sql = "DELETE FROM billingrates WHERE BillingRateID='$billingRateID'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Record deleted successfully'); window.location.href='viewbillingrates.php';</script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "<script>alert('No ID specified.'); window.location.href='viewbillingrates.php';</script>";
    }

    $conn->close();
}
?>
