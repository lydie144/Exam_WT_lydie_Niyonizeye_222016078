<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $holidayDate = $_POST['holidayDate'];
    $description = $_POST['description'];

    // Insert the record into the database
    $sql = "INSERT INTO holidays (HolidayDate, Description) VALUES ('$holidayDate', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record submitted successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holidays Form</title>
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
        input[type="date"], textarea {
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
        <h2>Holidays Form</h2>
        <form action="holidaysForm.php" method="post">
            <label for="holidayDate">Holiday Date:</label>
            <input type="date" id="holidayDate" name="holidayDate" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
            
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
