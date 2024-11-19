<?php
session_start();
 include "connection.php";
$uname = strip_tags(addslashes( $_POST['uname']));
$pass = strip_tags(addslashes( $_POST['pass']));
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "SELECT * FROM account WHERE uname='$uname' AND pass='$pass'";
$result = mysqli_query($con, $sql); 

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_array($result); 
  if ($row['utype'] == 'admin') {
    header('location: addcars.php');
  } elseif ($row['utype'] == 'user') {
    header('location: Exhibitions.php');
    $_SESSION['uname'] = $uname; 
exit();
  } else {
    header('location: Login.html?error=incorrect');
  }
} 
else {
  header('location: Login.html?error=incorrect');

mysqli_close($con);
}
?>
