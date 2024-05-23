<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST['project_id'];
    $project_name = $_POST['project_name'];
    $description = $_POST['description'];
    $created_by = $_POST['created_by'];

    // Update the record
    $sql = "UPDATE projects SET project_name=?, description=?, created_by=? WHERE project_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $project_name, $description, $created_by, $project_id);

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully'); window.location.href='viewprojects.php';</script>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Retrieve the record to update
    $project_id = $_GET['id'];
    $sql = "SELECT * FROM projects WHERE project_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Project</title>
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
        <h2>Update Project</h2>
        <form action="updateprojects.php" method="post">
            <input type="hidden" name="project_id" value="<?php echo $row['project_id']; ?>">

            <label for="project_name">Project Name:</label>
            <input type="text" id="project_name" name="project_name" value="<?php echo $row['project_name']; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required><?php echo $row['description']; ?></textarea>

            <label for="created_by">Created By:</label>
            <input type="text" id="created_by" name="created_by" value="<?php echo $row['created_by']; ?>" required>

            <input type="submit" value="Update">
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>
