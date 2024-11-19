<?php
session_start();
include "connection.php";

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["orderId"])) {
    $orderId = $_POST["orderId"];
    $sql = "SELECT *, UNIX_TIMESTAMP(orderTime) AS orderTimestamp FROM orders WHERE Oid = '$orderId'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $orderTimestamp = $row["orderTimestamp"];
        $currentTime = time();
        $hoursDifference = ($currentTime - $orderTimestamp) / 3600;

        if ($hoursDifference < 48) {
            $deleteQuery = "DELETE FROM orders WHERE Oid = '$orderId'";
            if (mysqli_query($con, $deleteQuery)) {
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "cannotCancel";
        }
    } else {
        echo "notFound";
    }
}

$con->close();
?>
