<?php
include "connection.php";

if (!isset($_POST['uname'])||!isset($_POST['Email'])||!isset($_POST['subject']))
    die('Please insert the data');
$uname = strip_tags(addslashes($_POST['uname']));
$email = strip_tags(addslashes($_POST['Email']));
$Comment = strip_tags(addslashes($_POST['subject']));
$Country= strip_tags(addslashes($_POST['country']));
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
    $sql = "INSERT INTO feedback (Comment, uname, email, country) VALUES ('$Comment','$uname','$email','$Country' )";
    if (mysqli_query($con, $sql)) {
        header('location: contact.html');
    } else {
        echo ("Something went wrong...");
    }
mysqli_close($con);
?>

