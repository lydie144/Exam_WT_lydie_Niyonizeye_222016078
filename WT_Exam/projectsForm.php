<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Form</title>
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
    <h2>Projects Form</h2>
    <form action="process_projects.php" method="post">
        <!-- Hidden input field for project_id -->
        <input type="hidden" id="project_id" name="project_id" value="">
        
        <label for="project_name">Project Name:</label>
        <input type="text" id="project_name" name="project_name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="created_by">Created By:</label>
        <input type="text" id="created_by" name="created_by" required>

        <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
