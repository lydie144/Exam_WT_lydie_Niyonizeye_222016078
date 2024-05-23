<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if user_id is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user details from the database based on user_id
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    if($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1) {
            // User found, fetch data
            $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/wtch.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2, label {
            text-align: center;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <form action="process_update_user.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter new password">
            <input type="submit" value="Update User">
        </form>
    </div>
</body>
</html>
<?php
        } else {
            echo "User not found.";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "User ID not provided.";
}
?>
