<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the delete is confirmed
if (isset($_POST['confirm_delete'])) {
    $client_id = $_POST['client_id'];

    // Delete the record
    $sql = "DELETE FROM clients WHERE client_id='$client_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully'); window.location.href='viewclients.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    // Retrieve the record to confirm deletion
    $client_id = $_GET['id'];
    $sql = "SELECT * FROM clients WHERE client_id='$client_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delete Client</title>
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
                align-items: center;
            }
            p {
                margin-bottom: 20px;
                font-size: 16px;
            }
            input[type="submit"] {
                padding: 10px;
                font-size: 16px;
                background-color: #f44336;
                color: white;
                border: none;
                cursor: pointer;
                margin: 5px;
            }
            input[type="submit"]:hover {
                background-color: #e31b0c;
            }
            .button-container {
                display: flex;
                justify-content: center;
            }
            .button-container a {
                text-decoration: none;
                padding: 10px 20px;
                font-size: 16px;
                background-color: #4CAF50;
                color: white;
                border: none;
                cursor: pointer;
                margin: 5px;
                text-align: center;
            }
            .button-container a:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Delete Client</h2>
            <form action="confirmdeleteclient.php" method="post">
                <input type="hidden" name="client_id" value="<?php echo $row['client_id']; ?>">
                <p>Are you sure you want to delete the client: <strong><?php echo $row['client_name']; ?></strong>?</p>
                <div class="button-container">
                    <input type="submit" name="confirm_delete" value="Delete">
                    <a href="viewclients.php">Cancel</a>
                </div>
            </form>
        </div>
    </body>
    </html>
    <?php
}
?>
