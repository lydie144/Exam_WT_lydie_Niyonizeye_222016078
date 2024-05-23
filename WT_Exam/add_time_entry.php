<!--lydie_Niyonizeye_222016078-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Time Entry</title>
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
        input[type="text"], textarea, select, input[type="datetime-local"] {
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
        <h2>Add Time Entry</h2>
        <form action="process_time_entry.php" method="post">
            <label for="task_id">Task ID:</label>
            <input type="text" id="task_id" name="task_id" required>

            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required>

            <label for="start_time">Start Time:</label>
            <input type="datetime-local" id="start_time" name="start_time" required>

            <label for="end_time">End Time:</label>
            <input type="datetime-local" id="end_time" name="end_time" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <input type="submit" value="Add Entry">
        </form>
    </div>
</body>
</html>
<!--lydie_Niyonizeye_222016078-->