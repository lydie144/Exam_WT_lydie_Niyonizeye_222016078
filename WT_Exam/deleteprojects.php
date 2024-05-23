<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Project</title>
    <style>
        body {
            background-image: url('images/watch.jpg'); 
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background for the form */
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2, p {
            text-align: center;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
        button, a {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
        }
        button:hover, a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Project</h2>
        <p>Are you sure you want to delete this project?</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="project_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <button type="submit">Yes, Delete</button>
            <a href="viewprojects.php">No, Cancel</a>
        </form>
    </div>
</body>
</html>
