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
    $user_id = $_POST['user_id'];
    $week_starting_date = $_POST['week_starting_date'];
    $total_hours = $_POST['total_hours'];

    // Prepare the SQL statement
    $sql = "INSERT INTO timesheet (`User_ID`, `Week_Starting_Date`, `Total_Hours`) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("iss", $user_id, $week_starting_date, $total_hours);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Record inserted successfully'); window.location.href='timesheet.php';</script>";
    } else {
        echo "Error inserting record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
