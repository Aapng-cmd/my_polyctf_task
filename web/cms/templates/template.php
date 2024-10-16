<?php
include '/var/www/html/cms/r.php';

$error = "";
$conn = conn();

$cookie = $_COOKIE['PHPSESID'];

$sql = "select email from cookies where cookie='$cookie';";
$result = $conn -> query($sql);
$row = $result -> fetch_array();

$email = $row['email'];

if ($email == "")
{
  header("location: ../login.php");
}

if (isset($_POST['submit']))
{
  $count = trim($_POST['cb']);
  $alias = trim($_POST['name']);
  
  $sql = "insert into bought (owner, name, count) values ('$email', '$alias', $count);";
  try
  {
    $result = $conn -> query($sql);
  } catch (Exception $e) {
    if ($row['alias'] !== $alias)
    {
      $sql = "update bought set owner = '$email', name = '$alias', count = $count";
      $result = $conn -> query($sql);
    }
  }
  header("location: ../shop.php");
}

$conn -> close();
?>
