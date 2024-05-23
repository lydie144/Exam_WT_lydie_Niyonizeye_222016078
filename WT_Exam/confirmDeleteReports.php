<?php
// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
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
            <title>Delete Report Confirmation</title>
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
                <h2>Delete Report Confirmation</h2>
                <p>Are you sure you want to delete the report "<?php echo $row['ReportName']; ?>"?</p>
                <div class="buttons">
                    <form action="deleteReports.php" method="post">
                        <input type="hidden" name="report_id" value="<?php echo $report_id; ?>">
                        <button type="submit">Yes, Delete</button>
                    </form>
                    <button onclick="window.location.href='viewreports.php';">No, Cancel</button>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<script>alert('No ID specified.'); window.location.href='viewreports.php';</script>";
    }
}
?>
