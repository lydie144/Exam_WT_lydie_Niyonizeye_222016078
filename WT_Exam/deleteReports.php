<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['report_id'])) {
        $report_id = $_POST['report_id'];

        // Delete the record
        $sql = "DELETE FROM reports WHERE ReportID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $report_id);

        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully'); window.location.href='viewreports.php';</script>";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>alert('No ID specified.'); window.location.href='viewreports.php';</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Report</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
<div class="container">
    <h2>Delete Report</h2>
    <p>Are you sure you want to delete this report?</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="report_id" value="<?php echo isset($_POST['report_id']) ? $_POST['report_id'] : ''; ?>">
        <button type="submit">Yes, Delete</button>
        <a href="viewreports.php">No, Cancel</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForm = document.querySelector('form');
        deleteForm.classList.toggle('show');
    });
</script>
</body>
</html>
