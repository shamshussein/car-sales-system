<?php
include "connection.php";
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $successMessage = "";
if (isset($_GET["success"])) {
    $successMessage = "Selected cars have been deleted successfully.";
    unset($_GET["success"]);
}
$failMessage = "";
if (isset($_GET["fail"])) {
    $failMessage = "Please select at least one order to be deleted.";
    unset($_GET["fail"]);
}
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["delete"])) {
        if (isset($_POST["car"]) && is_array($_POST["car"])) {
            $selectedplate = array_map(function ($plate) use ($con) {
                return $con->real_escape_string($plate);
            }, $_POST["car"]);
            $selectedplate = array_map(function ($plate) {
                return "'" . $plate . "'";
            }, $selectedplate);
            $deleteQuery = "DELETE FROM car WHERE Plate_id IN (" . implode(",", $selectedplate) . ")";
            if ($con->query($deleteQuery) === TRUE) {
                header("Location: deletecars.php?success=1");
                exit();
            } else {
                echo "Error deleting cars: " . $con->error;
            }
        } else {
          header("Location: deletecars.php?fail=1");
          exit();        }
      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="removeusers.css">
    <link rel="stylesheet" href="style.css">
  <link rel="website icon" type="png" href="Images/cars.jpg">
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
    <title>Remove cars</title>
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
    <form method="post" action="deletecars.php">
        <?php
        $sql = "SELECT * FROM car";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($cars = $result->fetch_assoc()) {
                echo '<label><input type="checkbox" name="car[]" value="' . $cars["Plate_id"] . '"> ' . $cars["Make"] . '</label><br>';
            }
        } else {
            echo "No cars found.";
        }
        ?>
        <input type="submit" name="delete" value="Delete Selected cars">
    </form>
    <div id="success-message">
    <?php
        echo $successMessage;
        ?>
         <?php
        echo $failMessage;
        ?>
    </div>
</div>
</body>
</html>