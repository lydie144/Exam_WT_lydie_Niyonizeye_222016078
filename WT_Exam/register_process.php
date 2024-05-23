<?php
include 'db_connection.php'; // Include the database connection file

// Initialize message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // Check if the username already exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "Username already taken. Please choose another one.";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            $message = "Registration successful. You can now <a href='login.html'>login</a>.";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
</head>
<body>
    <?php
    if (!empty($message)) {
        echo "<p>$message</p>";
    }
    ?>
    