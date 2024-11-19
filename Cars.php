<?php
include "connection.php";
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
  }  
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" href="Cars.css">
  <link rel="website icon" type="png" href="Images/cars.jpg">
    <title>Cars Gallery</title>
</head>
<body>
<header>
        <div class="header">
        <h1 class="head">Car Sales System /<span class="head2">Architecture and Development</span></h1>
       <br>
       </div>
        <div class="topnav">       
          <a href="index.php">Home</a>
        <a href="Exhibitions.php">Exhibitions</a>
           <a href="contact.php">Contact us</a>
      <a href="About_us.html" target="_blank">About us</a>
      <a href="Cart.php">Cart</a>
    </div>
    </header>
    <br>
    <h2>Car Gallery</h2>
    <?php
    if (isset($_GET['ename'])) {
      $selectedExhibition = $_GET['ename'];
  } else {
      $selectedExhibition = "DefaultExhibition";
  }
  $sql = "SELECT c.Plate_id, c.Make, c.Model, c.Price, c.image, c.ename FROM car c LEFT JOIN exhibition e ON c.ename = e.ename WHERE c.ename = '$selectedExhibition'";
  $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $Make = $row["Make"];
        $image = $row["image"];
            echo '<p class="info"><b>Plate_id:</b> ' . $row["Plate_id"]. ' <b>Make:</b> ' . $row["Make"] .' <b>Model:</b> ' . $row["Model"] . ' <b>Price:</b> ' . $row["Price"] .' <b>ename:</b> ' . $row["ename"] .'</p>';
            echo '<a href="Payment.php?Make=' . urlencode($Make) . '"><img src="data:Image/jpeg;base64,' . base64_encode($row["image"]) . '" width="400" height="230" alt="Car Image" class="infoimg"></a><br>';
        }
    } else {
        echo "No cars found for the selected exhibition.";
    }
    $con->close();
    ?>
    <br><br>
    <footer>
      <br />
      <div class="visit">Visit our Instagram site</div>
      <a href="https://www.instagram.com">
        <img src="Images/icons8-instagram-48.png" alt="logo" id="instalogo" />
      </a>
      <p class="copy">
        &copy; Car Sales System since 2022 by: Hussein Shams. All Rights Reserved.
      </p>
      <br />
    </footer>
</body>
</html>