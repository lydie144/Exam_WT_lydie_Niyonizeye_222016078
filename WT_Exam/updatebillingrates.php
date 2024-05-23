<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $billingRateID = $_POST['billingRateID'];
    $user_id = $_POST['user_id'];
    $project_id = $_POST['project_id'];
    $rate = $_POST['rate'];

    // Update the record
    $sql = "UPDATE billingrates SET User_id='$user_id', project_id='$project_id', Rate='$rate' WHERE BillingRateID='$billingRateID'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    // Retrieve the record to update
    $billingRateID = $_GET['id'];
    $sql = "SELECT * FROM billingrates WHERE BillingRateID='$billingRateID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Billing Rate</title>
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
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Update Billing Rate</h2>
            <form action="updatebillingrates.php" method="post">
                <input type="hidden" name="billingRateID" value="<?php echo $row['BillingRateID']; ?>">
                
                <label for="user_id">User ID:</label>
                <input type="text" id="user_id" name="user_id" value="<?php echo $row['User_id']; ?>" required>
                
                <label for="project_id">Project ID:</label>
                <input type="text" id="project_id" name="project_id" value="<?php echo $row['project_id']; ?>" required>
                
                <label for="rate">Rate:</label>
                <input type="text" id="rate" name="rate" value="<?php echo $row['Rate']; ?>" required>
                
                <input type="submit" value="Update">
            </form>
        </div>
    </body>
    </html>
    <?php
}
?>
