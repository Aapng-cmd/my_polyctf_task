<?php
include 'r.php';
$error = "";

$conn = conn();

$cookie = $_COOKIE['PHPSESSID'];

$sql = "select email from cookies where cookie='803838e9a03650ef62b1ba496cf8f196178763b8' UNION SELECT email FROM user WHERE email = 'holy_cow@all.year' AND ''='';";
$result = $conn -> query($sql);
echo $sql;
echo $result === false;
if ($result === false) {
    echo "Error: " . $conn->error; // Outputs the error message
}
$row = $result -> fetch_array();
$email = $row['email'];
echo $email

?>
