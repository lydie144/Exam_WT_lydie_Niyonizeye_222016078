<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug: Check if POST data is received
    if (empty($_POST)) {
        die('No POST data received.');
    }

    // Retrieve POST data
    $client_name = $_POST['client_name'];
    $contact_person = $_POST['contact_person'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Insert data into database
    $sql = "INSERT INTO clients (client_name, contact_person, email, phone_number, address) 
            VALUES ('$client_name', '$contact_person', '$email', '$phone_number', '$address')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Success message
        echo "<script>alert('Record submitted successfully');</script>";
    } else {
        // Error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
