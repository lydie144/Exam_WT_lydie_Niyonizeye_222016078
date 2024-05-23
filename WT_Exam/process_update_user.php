<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if(isset($_POST['user_id'], $_POST['username'], $_POST['email'])) {
        // Sanitize form data to prevent SQL injection
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password']; // Optional: You may handle password update separately

        // Prepare update statement
        $sql = "UPDATE users SET username = ?, email = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);

        if($stmt) {
            // Bind parameters and execute query
            $stmt->bind_param("ssi", $username, $email, $user_id);
            $stmt->execute();

            // Check if update was successful
            if ($stmt->affected_rows > 0) {
                echo "User information updated successfully.";
            } else {
                echo "Failed to update user information.";
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "All required fields are not filled.";
    }
} else {
    // Redirect user to the form page if accessed directly without form submission
    header("Location: user.php");
    exit();
}

// Close database connection
$conn->close();
?>
