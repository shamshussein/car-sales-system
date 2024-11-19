<?php
 include "connection.php"; 
 $alertMessage = "";
  if (isset($_GET["alert"])) {
      $alertMessage = "Car plate id and image already exist...";
      unset($_GET["alert"]);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="add.css">
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
    <link rel="website icon" type="png" href="Images/cars.jpg">
    <title>Add cars</title>
</head>
<body>
<header>
        <div class="header">
        <h1 class="head">Car Sales System /<span class="head2">Architecture and Development</span></h1>
       <br><br>
       </div>
        <div class="topnav">       
          <a href="logout.php">logout</a> 
          <div class="dropdown">
            <button class="dropbtn">Options
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="addcars.php">Update Cars/Exhibitions</a>
              <a href="removeuser.php">Remove users</a>
              <a href="reports.php">Reports</a>
              <a href="orders.php">Orders</a>
            </div>
          </div>
    </div>
    </header>
    <br>
    <div class="dropdown">
            <button class="dropbtn">update options
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="addcars.php">Add Cars</a>
              <a href="deletecars.php">Delete Cars</a>
              <a href="addexhibitions.php">Add exhibition</a>
              <a href="deleteexhibitions.php">Delete exhibition</a>
            </div>
          </div>
<div class="row">
        <div class="col-75">
          <div class="container">
            <form  action="addcars.php" method="post">
              <div class="row">
                <div class="col-50">
                  <h3>Car addition</h3>
                  <label for="plate id"><i class="fa fa-user"></i> Plate_id</label>
                  <input type="text" id="Plate_id" name="Plate_id" placeholder="019201" required>
                  <label for="Make"><i class="fa fa-envelope"></i> Make</label>
                  <input type="text" id="Make" name="Make" placeholder="BMW" required>
                  <label for="Model"><i class="fa fa-address-card-o"></i> Model</label>
                  <input type="text" id="Model" name="Model" placeholder="1987" required>
                  <label for="Price"><i class="fa fa-institution"></i> Price</label>
                  <input type="text" id="Price" name="Price" placeholder="20,000$" required>
                  <label for="ename">exhibition name</label>
                  <input type="text" id="ename" name="ename" placeholder="imperial..." required>
                  <label for="image">image</label>
                  <input type="file" id="image" name="image" accept="image/*" placeholder="car.jpg" required>
                  </div>      
              </div>
              <input type="submit" value="Add car" class="btn">
              <?php
                if (!isset($_POST['Plate_id'])||!isset($_POST['Make'])||!isset($_POST['Model'])||!isset($_POST['Price'])||!isset($_POST['image'])||!isset($_POST['ename']))
                die('Please insert the data');
            $Plate_id = strip_tags(addslashes($_POST['Plate_id']));
            $Make = strip_tags(addslashes($_POST['Make']));
            $Model = strip_tags(addslashes($_POST['Model']));
            $Price = strip_tags(addslashes($_POST['Price']));
            $image = strip_tags(addslashes($_POST['image']));
            $ename = strip_tags(addslashes($_POST['ename']));
            if (mysqli_connect_errno())
              {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }
            $select = "SELECT * FROM Car WHERE Plate_id='$Plate_id' and image='$image'";
            if (mysqli_num_rows(mysqli_query($con, $select)) > 0) {
                header("Location: addcars.php?alert=1");
                exit;            
            }
                 else {
                $sql = "INSERT INTO Car (Plate_id, Make, Model, Price, image, ename) VALUES ('$Plate_id', '$Make', $Model, '$Price', '$image', '$ename')";
                if (mysqli_query($con, $sql)) {
                    echo ("Car addition is done successfully...");
                } else {
                    echo ("Something went wrong...");
                }
            mysqli_close($con);
            }
                ?>
            </form>
          </div>
          </div>
      </div>
      <div id="alert-message">
<?php
    echo $alertMessage;
    ?>
      <br><br>
</body>
</html>