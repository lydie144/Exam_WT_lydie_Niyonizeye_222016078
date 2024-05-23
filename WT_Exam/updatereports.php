<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $report_id = $_POST['report_id'];
    $report_name = $_POST['report_name'];
    $description = $_POST['description'];
    $user_id = $_POST['user_id'];

    // Update the record
    $sql = "UPDATE reports SET ReportName=?, Description=?, user_id=? WHERE ReportID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $report_name, $description, $user_id, $report_id);

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully'); window.location.href='viewreports.php';</script>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Retrieve the record to update
    if (isset($_GET['id'])) {
        $report_id = $_GET['id'];
        $sql = "SELECT * FROM reports WHERE ReportID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $report_id);
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
            <title>Update Report</title>
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
                <h2>Update Report</h2>
                <form action="updatereports.php" method="post">
                    <input type="hidden" name="report_id" value="<?php echo $row['ReportID']; ?>">
                    
                    <label for="report_name">Report Name:</label>
                    <input type="text" id="report_name" name="report_name" value="<?php echo $row['ReportName']; ?>" required>
                    
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required><?php echo $row['Description']; ?></textarea>
                    
                    <label for="user_id">User ID:</label>
                    <input type="text" id="user_id" name="user_id" value="<?php echo $row['user_id']; ?>" required>
                    
                    <input type="submit" value="Update">
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<script>alert('No ID specified.'); window.location.href='viewreports.php';</script>";
    }
}
?>
