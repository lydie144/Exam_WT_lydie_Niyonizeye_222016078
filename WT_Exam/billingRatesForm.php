<!--lydie_Niyonizeye_222016078-->
<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Initialize variables for feedback messages
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user_id = $_POST['user_id'];
    $project_id = $_POST['project_id'];
    $rate = $_POST['rate'];

    // Insert data into the billingrates table
    $sql = "INSERT INTO billingrates (User_id, Project_id, Rate) VALUES ('$user_id', '$project_id', '$rate')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "Record submitted successfully.";
        // Run JavaScript to display the success message as a pop-up
        echo "<script>alert('$successMessage');</script>";
    } else {
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch users from the database
$userOptions = '';
$userResult = $conn->query("SELECT User_id, Username FROM users");
if ($userResult->num_rows > 0) {
    while ($userRow = $userResult->fetch_assoc()) {
        $userOptions .= "<option value='{$userRow['User_id']}'>{$userRow['Username']}</option>";
    }
} else {
    $userOptions = "<option value=''>No users available</option>";
}

// Fetch projects from the database
$projectOptions = '';
$projectResult = $conn->query("SELECT Project_id, Project_name FROM projects");
if ($projectResult->num_rows > 0) {
    while ($projectRow = $projectResult->fetch_assoc()) {
        $projectOptions .= "<option value='{$projectRow['Project_id']}'>{$projectRow['Project_name']}</option>";
    }
} else {
    $projectOptions = "<option value=''>No projects available</option>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Rates Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/time.jpeg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], select {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 16px;
        }
        input[type="submit"] {
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Billing Rates Form</h2>
        <?php if ($successMessage): ?>
            <div class="message success"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <form action="billingRatesForm.php" method="post">
            <label for="user_id" style="display:none;">User ID:</label>
            <select id="user_id" name="user_id" required style="display:none;">
                <?php echo $userOptions; ?>
            </select>

            <label for="project_id" style="display:none;">Project ID:</label>
            <select id="project_id" name="project_id" required style="display:none;">
                <?php echo $projectOptions; ?>
            </select>

            <label for="rate">Rate:</label>
            <input type="text" id="rate" name="rate" required>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
<!--lydie_Niyonizeye_222016078-->