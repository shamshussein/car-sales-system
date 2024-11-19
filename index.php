<?php
include "connection.php";

if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="style.css">  
  <link rel="website icon" type="png" href="Images/cars.jpg">
        <title>Car Sales System</title>
</head>
<body>    
    <header>
        <div class="header">
        <h1 class="head">Car Sales System /<span class="head2">Architecture and Development</span></h1>
       <br>
       </div>
        <div class="topnav">       
          <a href="index.php">Home</a>
        <a href="login.html" target="_blank">Exhibitions</a>
           <a href="contact.html">Contact us</a>
      <a href="About_us.html" target="_blank">About us</a>
            <a href="login.html" target="_blank" class="split">Login</a>
    </div>
    </header>
    <div class="descrption">Access our car sales system on the go! Our website is fully optimized, so you can browse, and buy cars from the palm of your hand.
    <br>  Join thousands of satisfied customers who have found their perfect car with our website. Start your car-buying journey today with just a few clicks!
    </div>
    <br>
    <h2>Latest automobile Exhibitions:</h2>
     <?php
    $sql = "SELECT * FROM exhibition ";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      echo'<div class="slideshow-container">';
        while ($row = $result->fetch_assoc()) {
          echo '<a href="login.html"><img class="slideimg" src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" width="400" height="230" alt="Car Image"></a><br>';
          }
          echo '</div>';
         }
     else {
        echo "No cars found.";
    }
    ?>   
    <script src="Javascript.js"></script>         
       <div class="descrption">By entering the exhibition you desire, you will have the access to see all cars related to each exhibition! Then you will be able to browse cars and see there description.
        <br>With just a click, you will enter your payment method and confirm your order.
        </div>
        <br>
<h2 class="recentcar">Recent Cars:</h2>
<?php
    $sql2 = "SELECT Plate_id, Make, Model, Price, image FROM car where Price >= '30,000$' ";
    $result2 = $con->query($sql2);
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
          echo '   <div class="image-container">';
            echo '<a href="login.html"><img id="cars" src="data:Image/jpeg;base64,' . base64_encode($row["image"]) . '" width="400" height="230" alt="Car Image" ></a><br>';
            echo '   <div class="middle"> ';
            echo '   <div class="description">' . $row["Price"]. ' </div></div> 
    </div> <br>';
          }
    } else {
        echo "No cars found.";
    }
    $con->close();
    ?> 
<marquee class="marq" behavior="alternate" direction="left" width="400px">Please login to view all cars >>></marquee>
<a href="login.html" id="allcars" target="_blank"> All cars</a>  <br><br>
 <p>Want to ask about us?</p>
 <p>Facing some problems?</p>
 <p>Why us?</p>
 <a href="About_us.html" id="about_us" target="_blank">About us</a>
<br><br>
 <footer><br>
   <div class="visit">Visit our Instagram site</div> 
    <a href="https://www.instagram.com">
    <img src="Images/icons8-instagram-48.png" alt="logo" id="instalogo">
</a>
<p class="copy">&copy; Car Sales System since 2022 by: Hussein Shams. All Rights Reserved.</p><br>
</footer>
</body> 
</html>