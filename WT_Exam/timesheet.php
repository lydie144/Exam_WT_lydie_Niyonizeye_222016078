<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet Form</title>
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
        input[type="text"], input[type="date"], input[type="number"] {
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
        <h2>Timesheet Form</h2>
        <form action="process_timesheet.php" method="post">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required>

            <label for="week_starting_date">Week Starting:</label>
            <input type="date" id="week_starting_date" name="week_starting_date" required>

            <label for="total_hours">Total Hours:</label>
            <input type="number" id="total_hours" name="total_hours" step="0.01" required>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
