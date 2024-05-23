<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $report_name = $_POST['report_name'];
    $description = $_POST['description'];
    $user_id = $_POST['user_id'];

    // Insert the record into the database
    $sql = "INSERT INTO reports (ReportName, Description, user_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $report_name, $description, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Record submitted successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
