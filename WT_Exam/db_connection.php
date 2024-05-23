<?php
// Database connection parameters
$servername = "localhost";
$username = "Niyo";
$password = "niyo123";
$database = "time_tracking_application";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
