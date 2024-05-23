<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Form</title>
    <style>
         body {
            background-image: url('images/wtch.jpg'); 
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background for the form */
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2, p {
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
        input[type="text"], textarea {
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
        <h2>Reports Form</h2>
        <form action="process_reports.php" method="post">
            <label for="report_name">Report Name:</label>
            <input type="text" id="report_name" name="report_name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
