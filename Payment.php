<?php
session_start();
 include "connection.php";
 if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
  }
  $successMessage = "";
  if (isset($_GET["success"])) {
      $successMessage = "Car already ordered...";
      unset($_GET["success"]);
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['uname'])) {
        $_SESSION['uname'] = $_POST['uname'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="payment.css">
    <link rel="stylesheet" href="style.css">
  <link rel="website icon" type="png" href="Images/cars.jpg">
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>

    <title>Payment</title>
</head>
<body>
    <body>    
        <header>
            <div class="header">
            <h1 class="head">Car Sales System /<span class="head2">Architecture and Development</span></h1>
           <br>
           </div>
            <div class="topnav">       
              <a href="index.php">Home</a>
            <a href="Exhibitions.php" >Exhibitions</a>
               <a href="contact.html">Contact us</a>
          <a href="About_us.html" target="_blank">About us</a>
      <a href="Cart.php">Cart</a>
        </div>
        </header>
        <br>
    <div class="row">
        <div class="col-75">
          <div class="container">
            <form  action="payment2.php" method="post">
            <label for="uorder"><i class="fa fa-user"></i>User_Order</label>
<?php
if (isset($_GET['Make'])) {
  $selectedCar = $_GET['Make'];
} else {
  $selectedCar = "DefaultCar";
}
$sql = "SELECT * FROM car WHERE Make = '$selectedCar'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $Make = $row["Make"];
    $image = $row["image"];
    echo '<input type="text" id="uorder" name="uorder" value="' . $Make . '" readonly >';
    echo '<img src="data:Image/jpeg;base64,' . base64_encode($row["image"]) . '" width="400" height="230" alt="Car Image" class="infoimg"><br>';
  }
} else {
    echo "No cars found.";
}
?> 
               <div class="row">
                <div class="col-50">
                  <h3>Billing Address</h3>
                  <label for="uname"><i class="fa fa-user"></i> Username</label>
                  <input type="text" id="uname" name="uname" value="<?php echo $_SESSION['uname']; ?>" readonly > 
                  <label for="email"><i class="fa fa-envelope"></i> Email</label>
                  <input type="text" id="email" name="email" placeholder="user1@example.com">
                  <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                  <input type="text" id="adr" name="address" placeholder="Zahle street 1987">
                  <label for="city"><i class="fa fa-institution"></i> City</label>
                  <input type="text" id="city" name="city" placeholder="Zahle">
                  </div>      
                <div class="col-50">
                  <h3>Payment</h3>
                  <label for="fname">Accepted Cards</label>
                  <div class="icon-container">
                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                  </div>
                  <label for="cname">Name on Card</label>
                  <input type="text" id="cname" name="cardname" placeholder="Your name on card...">
                  <label for="ccnum">Credit card number</label>
                  <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                  </div>      
              </div>
              <label>
                <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
              </label>
              <input type="submit" value="Confirm Order" class="btn">
            </form>
          </div>
          </div>
      </div>
      <div id="success-message">
<?php
    echo $successMessage;
    ?>
      <br><br>
      <footer>
        <br />
        <div class="visit">Visit our Instagram site</div>
        <a href="https://www.instagram.com">
          <img src="Images/icons8-instagram-48.png" alt="logo" id="instalogo" />
        </a>
        <p class="copy">
          &copy; Car Sales System since 2022 by: Hussein Shams. All Rights
          Reserved.
        </p>
        <br />
      </footer>  
    </body>
</html>