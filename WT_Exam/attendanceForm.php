<!--lydie_Niyonizeye_222016078-->
<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug: Check if POST data is received
    if (empty($_POST)) {
        die('No POST data received.');
    }

    // Retrieve POST data
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Debug: Display received POST data (optional)
    // echo "Received data: User ID = $user_id, Date = $date, Check In = $check_in, Check Out = $check_out<br>";

    // Insert data into database
    $sql = "INSERT INTO attendance (User_id, Date, CheckIn, CheckOut) VALUES ('$user_id', '$date', '$check_in', '$check_out')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
<!--lydie_Niyonizeye_222016078-->