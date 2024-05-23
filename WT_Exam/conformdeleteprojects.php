<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['project_id'])) {
        $project_id = $_POST['project_id'];

        // Delete the record
        $sql = "DELETE FROM projects WHERE project_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $project_id);

        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully'); window.location.href='viewprojects.php';</script>";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>alert('No ID specified.'); window.location.href='viewprojects.php';</script>";
    }

    $conn->close();
} else {
    // Display confirmation form
    if (isset($_GET['id'])) {
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
            <title>Delete Project Confirmation</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    width: 50%;
                    margin: 50px auto;
                    background-color: white;
                    padding: 20px;
                    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
                    text-align: center;
                }
                h2 {
                    text-align: center;
                }
                p {
                    text-align: center;
                    font-weight: bold;
                    margin-top: 20px;
                }
                .buttons {
                    text-align: center;
                    margin-top: 20px;
                }
                .buttons button {
                    padding: 10px;
                    font-size: 16px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    cursor: pointer;
                    margin-right: 10px;
                }
                .buttons button:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Delete Project Confirmation</h2>
                <p>Are you sure you want to delete the project "<?php echo $row['project_name']; ?>"?</p>
                <div class="buttons">
                    <form action="deleteprojects.php" method="post">
                        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                        <button type="submit">Yes, Delete</button>
                    </form>
                    <button onclick="window.location.href='viewprojects.php';">No, Cancel</button>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<script>alert('No ID specified.'); window.location.href='viewprojects.php';</script>";
    }
}
?>
