<?php
 include "connection.php";
 if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Exhibitions.css">
    <link rel="stylesheet" href="style.css">
  <link rel="website icon" type="png" href="Images/cars.jpg">
    <title>Exhibitions</title>
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
           <a href="Contact_us.html">Contact us</a>
      <a href="About_us.html" target="_blank">About us</a>
      <a href="Cart.php">Cart</a>

    </div>
    </header>
    <br>
    <div class="descrption">By entering the exhibition you desire, you will have the access to see all cars related to each exhibition! Then you will be able to browse cars and see there description.
      <br>With just a click, you will enter your payment method and confirm your order.
      </div>
      <br>
    <h4>Exhibitions:</h4>    
    <?php
    $sql = "SELECT * FROM exhibition";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $phone = $row["phone"];
        $ename = $row["ename"];
        $address = $row["address"];
        $image = $row["image"];
     echo ' <div class="image-container">';
            echo '<a href="Cars.php?ename=' . urlencode($ename) . '"><img id="exh" src="data:Image/jpeg;base64,' . base64_encode($row["image"]) . '" width="400" height="230" alt="Car Image" ></a><br>';
            echo '   <div class="middle"> ';
            echo '   <div class="description">' . $row["ename"]. ' </div></div> 
    </div> <br>';
          }
         }
     else {
        echo "No exhibitions found.";
    }
    ?> 
    <br>
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
