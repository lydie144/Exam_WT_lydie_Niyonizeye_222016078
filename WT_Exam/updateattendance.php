<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendanceID = $_POST['attendanceID'];
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Update the record
    $sql = "UPDATE attendance SET User_id='$user_id', Date='$date', CheckIn='$check_in', CheckOut='$check_out' WHERE AttendanceID='$attendanceID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    // Retrieve the record to update
    $attendanceID = $_GET['id'];
    $sql = "SELECT * FROM attendance WHERE AttendanceID='$attendanceID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Attendance</title>
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
            input[type="text"], input[type="date"], input[type="time"], select {
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
            <h2>Update Attendance</h2>
            <form action="updateattendance.php" method="post">
                <input type="hidden" name="attendanceID" value="<?php echo $row['AttendanceID']; ?>">
                
                <label for="user_id">User ID:</label>
                <input type="text" id="user_id" name="user_id" value="<?php echo $row['User_id']; ?>" required>
                
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="<?php echo $row['Date']; ?>" required>
                
                <label for="check_in">Check In:</label>
                <input type="time" id="check_in" name="check_in" value="<?php echo $row['CheckIn']; ?>" required>
                
                <label for="check_out">Check Out:</label>
                <input type="time" id="check_out" name="check_out" value="<?php echo $row['CheckOut']; ?>" required>
                
                <input type="submit" value="Update">
            </form>
        </div>
    </body>
    </html>
    <?php
}
?>
