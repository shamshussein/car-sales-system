<?php
include "connection.php";
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $successMessage = "";
if (isset($_GET["success"])) {
    $successMessage = "Selected users have been deleted successfully.";
    unset($_GET["success"]);
}
$failMessage = "";
if (isset($_GET["fail"])) {
    $failMessage = "Please select at least one order to be deleted.";
    unset($_GET["fail"]);
}
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["delete"])) {
        if (isset($_POST["account"]) && is_array($_POST["account"])) {
            $selectedUsernames = array_map(function ($uname) use ($con) {
                return $con->real_escape_string($uname);
            }, $_POST["account"]);
            $selectedUsernames = array_map(function ($uname) {
                return "'" . $uname . "'";
            }, $selectedUsernames);
            $deleteQuery = "DELETE FROM account WHERE uname IN (" . implode(",", $selectedUsernames) . ")";
            if ($con->query($deleteQuery) === TRUE) {
                header("Location: removeuser.php?success=1");
                exit();
            } else {
                echo "Error deleting users: " . $con->error;
            }
        } else {
            header("Location: removeuser.php?fail=1");
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
    <title>Remove user</title>
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
    <div class="row">
<h2 class="list">User List</h2>
    <form method="post" action="removeuser.php">
        <?php
        $sql = "SELECT * FROM account where utype='user'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($user = $result->fetch_assoc()) {
                echo '<label><input type="checkbox" name="account[]" value="' . $user["uname"] . '"> ' . $user["email"] . '</label><br>';
            }
        } else {
            echo "No users found.";
        }
        ?>
        <input type="submit" name="delete" value="Delete Selected Users">
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