<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $holidayID = $_POST['holidayID'];
    $holidayDate = $_POST['holidayDate'];
    $description = $_POST['description'];

    // Update the record
    $sql = "UPDATE holidays SET HolidayDate='$holidayDate', Description='$description' WHERE HolidayID='$holidayID'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    // Retrieve the record to update
    $holidayID = $_GET['id'];
    $sql = "SELECT * FROM holidays WHERE HolidayID='$holidayID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Holiday</title>
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
            input[type="date"], input[type="text"] {
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
            <h2>Update Holiday</h2>
            <form action="updateholidays.php" method="post">
                <input type="hidden" name="holidayID" value="<?php echo $row['HolidayID']; ?>">
                
                <label for="holidayDate">Holiday Date:</label>
                <input type="date" id="holidayDate" name="holidayDate" value="<?php echo $row['HolidayDate']; ?>" required>
                
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="<?php echo $row['Description']; ?>" required>
                
                <input type="submit" value="Update">
            </form>
        </div>
    </body>
    </html>
    <?php
}
?>
