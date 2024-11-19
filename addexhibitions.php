<?php
 include "connection.php"; 
 $alertMessage = "";
  if (isset($_GET["alert"])) {
      $alertMessage = "exhibition already exist...";
      unset($_GET["alert"]);
  }
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["phone"]) && isset($_POST["ename"]) && isset($_POST["address"]) && isset($_FILES["image"]["name"])) {
        $phone = strip_tags(addslashes($_POST['phone']));
        $ename = strip_tags(addslashes($_POST['ename']));
        $address = strip_tags(addslashes($_POST['address']));

        $image_name = $_FILES["image"]["name"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        $image_path = "C:/xampp/htdocs/ISD_HusseinShams/public/Images/" . $image_name;
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            $select = "SELECT * FROM exhibition WHERE ename='$ename'";
            if (mysqli_num_rows(mysqli_query($con, $select)) > 0) {
                header("Location: addexhibitions.php?alert=1");
                exit;
            } else {
                if (move_uploaded_file($image_tmp, $image_path)) {
                    $sql = "INSERT INTO exhibition (phone, ename, address, image) VALUES ('$phone', '$ename', '$address', '$image_path')";
                    if (mysqli_query($con, $sql)) {
                        echo "Exhibition added successfully...";
                    } else {
                        echo "Something went wrong...";
                    }
                } else {
                    echo "Failed to upload the image.";
                }
            }
            mysqli_close($con);
        }
    } else {
        echo "<p class='alert'>Please insert all the required data.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="add.css">
  <link rel="website icon" type="png" href="Images/cars.jpg">
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>

    <title>Add Exhibition</title>
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
<form action="addexhibitions.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-50">
                  <h3>Car addition</h3>
                  <label for="phone"><i class="fa fa-user"></i> Phone</label>
                  <input type="text" id="phone" name="phone" placeholder="01920122" required>
                  <label for="ename"><i class="fa fa-envelope"></i>Exhibition name</label>
                  <input type="text" id="ename" name="ename" placeholder="imperial..." required>
                  <label for="address"><i class="fa fa-address-card-o"></i> Address</label>
                  <input type="text" id="address" name="address" placeholder="zahle" required>
                  <label for="image">image</label>
                  <input type="file" id="image" name="image" accept="image/*" required>
                  </div>      
              </div>
              <input type="submit" value="Add exhibition" class="btn">
              <?php
                if (!isset($_POST['phone'])||!isset($_POST['ename'])||!isset($_POST['address'])||!isset($_POST['image']))
                die('Please insert the data');
                $phone = strip_tags(addslashes($_POST['phone']));
            $ename = strip_tags(addslashes($_POST['ename']));
            $address = strip_tags(addslashes($_POST['address']));
            $image = strip_tags(addslashes($_POST['image']));
            if (mysqli_connect_errno())
              {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }
            $select = "SELECT * FROM exhibition WHERE ename='$ename'";
            if (mysqli_num_rows(mysqli_query($con, $select)) > 0) {
                header("Location: addexhibitions.php?alert=1");
                exit;            
            }
                 else {
                $sql = "INSERT INTO exhibition (phone, ename, address, image) VALUES ($phone, '$ename', '$address' '$image'])";
                if (mysqli_query($con, $sql)) {
                    echo ("exhibition added successfully...");
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