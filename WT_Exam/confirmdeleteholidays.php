<?php
// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $holidayID = $_GET['id'];
    $sql = "SELECT * FROM holidays WHERE HolidayID='$holidayID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Confirm Delete Holiday</title>
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
                    text-align: center;
                }
                h2 {
                    text-align: center;
                }
                p {
                    margin-bottom: 20px;
                }
                .btn {
                    padding: 10px 20px;
                    font-size: 16px;
                    background-color: #f44336;
                    color: white;
                    border: none;
                    cursor: pointer;
                }
                .btn:hover {
                    background-color: #d32f2f;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Confirm Delete Holiday</h2>
                <p>Are you sure you want to delete the holiday on <?php echo $row['HolidayDate']; ?>?</p>
                <form action="deleteholidays.php" method="post">
                    <input type="hidden" name="holidayID" value="<?php echo $row['HolidayID']; ?>">
                    <button type="submit" class="btn" name="delete">Delete</button>
                    <a href="viewholidays.php" class="btn">Cancel</a>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Holiday not found.";
    }
} else {
    echo "Invalid request.";
}
?>
