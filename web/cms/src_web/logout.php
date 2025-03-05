<?php
include 'r.php';
$conn = conn();

$cookie = $_COOKIE['PHPSESID'];

$sql = "select email from cookies where cookie='$cookie';";
$result = $conn -> query($sql);
$row = $result -> fetch_array();

$email = $row['email'];

if ($email == "")
{
  header("location: login.php");
}

$sql = "delete from cookies where cookie='$cookie';";
$result = $conn -> query($sql);
setcookie("PHPSESID", "", time() - 3600);
$conn -> close();
header("location: login.php");
?>
