<?php
session_start();
include "connection.php";

if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

$selecteduser = isset($_SESSION['uname']) ? $_SESSION['uname'] : "Defaultuser";

$sql = "SELECT *, UNIX_TIMESTAMP(orderTime) AS orderTimestamp FROM orders WHERE username = '$selecteduser'";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Cart.css">
    <link rel="stylesheet" href="style.css">
  <link rel="website icon" type="png" href="Images/cars.jpg">
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
    <title>Cart</title>
</head>
<body>
    <header>
        <div class="header">
        <h1 class="head">Car Sales System /<span class="head2">Architecture and Development</span></h1>
       <br>
       </div>
        <div class="topnav">       
          <a href="index.php">Home</a>
        <a href="Exhibitions.php" >Exhibitions</a>
           <a href="contact.php" >Contact us</a>
      <a href="About_us.html" target="_blank">About us</a>
      <a href="Cart.php">Cart</a>
    </div>
    </header>
   <h2>Recent orders</h2>  
   <script>
function cancelOrder(orderId) {
    if (confirm("Are you sure you want to cancel this order?")) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const response = this.responseText;
                if (response === "success") {
                    alert("Order canceled successfully!");
                    location.reload();
                } else if (response === "cannotCancel") {
                    alert("Cannot cancel after 48 hours. Please contact us to delete your order...");
                } else if (response === "notFound") {
                    alert("Order not found.");
                } else {
                    alert("Failed to cancel the order. Please try again later.");
                }
            }
        };
        
        const url = 'cancel_order.php';
        const params = 'orderId=' + encodeURIComponent(orderId);
        
        xhttp.open('POST', url, true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send(params);
    }
}
</script>

   <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<p class="details"><b>Username:</b> ' . $row["username"] . ' <b>UserOrder:</b> ' . $row["userorder"] . ' <b>Address:</b> ' . $row["address"] . '</p>';
            $orderTimestamp = $row["orderTimestamp"];
            $currentTime = time();
            $hoursDifference = ($currentTime - $orderTimestamp) / 3600;
    
            if ($hoursDifference < 48) {
                echo '<input type="button" class="cancelButton" value="Cancel Order" onclick="cancelOrder(' . $row["Oid"] . ')">';
            } else {
                echo '<span class="cannotCancel">Cannot cancel after 48 hours</span>';
            }
        }
    } else {
        echo "No orders found for the selected user.";
    }

    $con->close();
    ?>
    <br><br>
    <footer><br>
  <div class="visit">Visit our Instagram site</div>  <a href="https://www.instagram.com">
   <img src="Images/icons8-instagram-48.png" alt="logo" id="instalogo">
</a>
<p class="copy">&copy; Car Sales System since 2022 by: Hussein Shams. All Rights Reserved.</p><br>
</footer>
</body>
</html>