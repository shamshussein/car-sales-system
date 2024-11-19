<?php
 include "connection.php";
 
if (!isset($_POST['uname'])||!isset($_POST['phone'])||!isset($_POST['email'])||!isset($_POST['pass']))
    die('Please insert the data');
$uname = strip_tags(addslashes($_POST['uname']));
$phone = strip_tags(addslashes($_POST['phone']));
$email = strip_tags(addslashes($_POST['email']));
$pass = strip_tags(addslashes($_POST['pass']));
$utype = strip_tags(addslashes($_POST['utype']));

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$select = "SELECT * FROM Account WHERE uname='$uname' AND pass='$pass'";
if (mysqli_num_rows(mysqli_query($con, $select)) > 0) {
    echo ("User already exists...");
} else {
    $sql = "INSERT INTO Account (uname, phone, email, pass, utype) VALUES ('$uname', $phone, '$email', '$pass', '$utype')";
    if (mysqli_query($con, $sql)) {
        echo ("Registration done successfully...");
        header('location: login.html');
    } else {
        echo ("Something went wrong...");
    }
mysqli_close($con);
}

?>



