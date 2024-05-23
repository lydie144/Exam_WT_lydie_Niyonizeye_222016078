<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $timesheetID = $_POST['timesheetID'];
    $user_id = $_POST['user_id'];
    $week_starting_date = $_POST['week_starting_date'];
    $total_hours = $_POST['total_hours'];

    // Update the record
    $sql = "UPDATE timesheet SET User_ID=?, Week_Starting_Date=?, Total_Hours=? WHERE `Timesheet ID`=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("issi", $user_id, $week_starting_date, $total_hours, $timesheetID);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Retrieve the record to update
    if (isset($_GET['id'])) {
        $timesheetID = $_GET['id'];
        $sql = "SELECT * FROM timesheet WHERE `Timesheet ID`=?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing the statement: " . $conn->error);
        }

        $stmt->bind_param("i", $timesheetID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row === null) {
            die("No record found with Timesheet ID: " . htmlspecialchars($timesheetID));
        }

        $stmt->close();
    } else {
        die("No TimesheetID provided in the URL.");
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Timesheet</title>
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
            input[type="text"], input[type="date"], input[type="number"] {
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
            <h2>Update Timesheet</h2>
            <form action="updatetimesheet.php" method="post">
                <input type="hidden" name="timesheetID" value="<?php echo isset($row['Timesheet ID']) ? htmlspecialchars($row['Timesheet ID']) : ''; ?>">
                
                <label for="user_id">User ID:</label>
                <input type="text" id="user_id" name="user_id" value="<?php echo isset($row['User_ID']) ? htmlspecialchars($row['User_ID']) : ''; ?>" required>
                
                <label for="week_starting_date">Week Starting Date:</label>
                <input type="date" id="week_starting_date" name="week_starting_date" value="<?php echo isset($row['Week Starting Date']) ? htmlspecialchars($row['Week Starting Date']) : ''; ?>" required>
                
                <label for="total_hours">Total Hours:</label>
                <input type="number" id="total_hours" name="total_hours" value="<?php echo isset($row['Total Hours']) ? htmlspecialchars($row['Total Hours']) : ''; ?>" step="0.01" required>
                
                <input type="submit" value="Update">
            </form>
        </div>
    </body>
    </html>
    <?php
}
?>
