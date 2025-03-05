<?php
include "r.php";

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

$p = "";

$sql = "select alias, path from products";
$result = $conn -> query($sql);
while ($row = $result -> fetch_array())
{     
  $alias = $row['alias'];
  $path = $alias . '.php';
  $p = $p . "
    <p><a href='./products/$path'>$alias</a></p>
  ";
}

$conn -> close();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
     <title>Home page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"></h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="lost_pass.php"><h5>Сменить пароль</h5></a>
    </nav>
    <a class="p-2 text-dark" href="cart.php"><h5>Корзина</h5></a>
    <a class="p-2 text-dark" href="welcome.php"><h5>Home</h5></a>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $p ?></h1>
            </div>
        </div>
    </div>    
</body>
</html>
