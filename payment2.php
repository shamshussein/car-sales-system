<?php 
session_start();
 include "connection.php";
 if (!isset($_POST['email'])||!isset($_POST['address'])||!isset($_POST['city'])||!isset($_POST['cardname'])||!isset($_POST['cardnumber']))
    die('Please insert the data');
$uname = strip_tags(addslashes($_POST['uname']));
$city = strip_tags(addslashes($_POST['city']));
$email = strip_tags(addslashes($_POST['email']));
$address = strip_tags(addslashes($_POST['address']));
$cardname = strip_tags(addslashes($_POST['cardname']));
$cardnumber = strip_tags(addslashes($_POST['cardnumber']));
$uorder= strip_tags(addslashes($_POST['uorder']));
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$select = "SELECT * FROM orders WHERE userorder='$uorder' and username='$uname'";
if (mysqli_num_rows(mysqli_query($con, $select)) > 0) {
    header("Location: Payment.php?success=1");
    exit;
} 
    else {
    $sql = "INSERT INTO orders (cardname, username, userorder, cardnumber, email, address, city) VALUES ('$cardname', '$uname', '$uorder', '$cardnumber', '$email', '$address', '$city')";
    if (mysqli_query($con, $sql)) {
        header('Location: Cart.php');
        $_SESSION['uname'] = $uname; 
        exit();
            exit;
    } else {
        echo ("Something went wrong...");
    }
mysqli_close($con);
}
?>
