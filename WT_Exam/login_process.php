<?php
include 'db_connection.php'; // Include the database connection file

// Initialize message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query to fetch user from the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    // Check if user exists
    if ($result->num_rows > 0) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session or redirect user to dashboard
            session_start();
            $_SESSION['username'] = $username; // Example: You can set session here

            // Redirect user to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Incorrect password. Please try again.";
        }
    } else {
        $message = "User not found. Please check your username.";
    }
} else {
    // If the form is not submitted via POST method, redirect to the login page
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <?php
    if (!empty($message)) {
        echo "<p>$message</p>";
    }
    ?>
    
</body>
</html>
