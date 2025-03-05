<?php
include "r.php";
$error = "";

$conn = conn();

$cookie = $_COOKIE['PHPSESSID'];

$sql = "select email from cookies where cookie='$cookie';";
$result = $conn -> query($sql);
$row = $result -> fetch_array();

$email = $row['email'];

if ($email == "")
{
  header("location: login.php");
}

$sql = "select id, name from user where email='$email'";
$result = $conn -> query($sql);
$row = $result -> fetch_array();

$id = $row['id'];
$name = $row['name'];

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
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="logout.php"><h5>Exit</h5></a>
    </nav>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="cart.php"><h5>Корзина</h5></a>
    </nav>
    
    <a class="btn btn-outline-primary" href="shop.php"><h5>Купить</h5></a>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $name ?></h1>
                <br><h3>HI</h3></br>
            
                <?php echo $error; ?>
            </div>
        </div>
    </div>    
</body>
</html>
