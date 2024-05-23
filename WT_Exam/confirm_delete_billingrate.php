<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $billingRateID = $_GET['id'];
    echo "<form action='deletebillingrates.php' method='post'>";
    echo "<input type='hidden' name='billingRateID' value='$billingRateID'>";
    echo "<p>Are you sure you want to delete this billing rate record?</p>";
    echo "<input type='submit' name='delete' value='Delete'>";
    echo "</form>";
} else {
    echo "Invalid request!";
}
?>
