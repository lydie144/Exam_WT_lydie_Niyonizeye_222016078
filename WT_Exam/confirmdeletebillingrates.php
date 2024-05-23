<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id'])) {
    $billingRateID = $_GET['id'];
} else {
    echo "<script>alert('No ID specified.'); window.location.href='viewbillingrates.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete Billing Rate</title>
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
        .buttons {
            text-align: center;
        }
        .buttons a, .buttons form {
            display: inline-block;
            margin: 10px;
        }
        .buttons a, .buttons input {
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border: none;
            cursor: pointer;
        }
        .buttons a:hover, .buttons input:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Are you sure you want to delete this record?</h2>
        <div class="buttons">
            <form action="deletebillingrates.php" method="post">
                <input type="hidden" name="billingRateID" value="<?php echo $billingRateID; ?>">
                <input type="submit" value="Yes">
            </form>
            <a href="viewbillingrates.php">No</a>
        </div>
    </div>
</body>
</html>
