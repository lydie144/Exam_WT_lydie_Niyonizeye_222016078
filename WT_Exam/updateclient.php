<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_POST['client_id'];
    $client_name = $_POST['client_name'];
    $contact_person = $_POST['contact_person'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Update the record
    $sql = "UPDATE clients SET client_name='$client_name', contact_person='$contact_person', email='$email', phone_number='$phone_number', address='$address' WHERE client_id='$client_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully'); window.location.href='viewclients.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    // Retrieve the record to update
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
        <title>Update Client</title>
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
            input[type="text"], input[type="email"], input[type="tel"], textarea {
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
            <h2>Update Client</h2>
            <form action="updateclient.php" method="post">
                <input type="hidden" name="client_id" value="<?php echo $row['client_id']; ?>">
                
                <label for="client_name">Client Name:</label>
                <input type="text" id="client_name" name="client_name" value="<?php echo $row['client_name']; ?>" required>
                
                <label for="contact_person">Contact Person:</label>
                <input type="text" id="contact_person" name="contact_person" value="<?php echo $row['contact_person']; ?>" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                
                <label for="phone_number">Phone Number:</label>
                <input type="tel" id="phone_number" name="phone_number" value="<?php echo $row['phone_number']; ?>" required>
                
                <label for="address">Address:</label>
                <textarea id="address" name="address" required><?php echo $row['address']; ?></textarea>
                
                <input type="submit" value="Update">
            </form>
        </div>
    </body>
    </html>
    <?php
}
?>
