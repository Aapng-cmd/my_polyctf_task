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
  header("location: login.php");
  die();
}

$tp = 0;
$names = array();
$tips = array();
$q = "";

$sql = "select name, count from bought where owner='$email';";
$result = $conn -> query($sql);
while ($row = $result -> fetch_array())
{
  array_push($names, $row['name']);
  array_push($names, $row['count']);
  array_push($tips, $names);
  $names = array();
}

for ($i = 0; $i < count($tips); $i++)
{
  $name = $tips[$i][0];
  $price = $tips[$i][1];

  $descr = tget("products/$name.php", 'descr');
  
  $q = $q . "
                <i class='info' data-modal-text='$descr'>$name</i>
  
  ";
  
  $sql = "select price from products where alias='$name';";
  $result = $conn -> query($sql);
  $row = $result -> fetch_array();
  
  $tp += ($row['price'] * $price);
}


$conn -> close();

?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
     <title>Cart</title>

    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link href="styles/style.css" rel='stylesheet'>
    <script defer src='styles/style.js'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"></h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="lost_pass.php"><h5>Сменить пароль</h5></a>
    </nav>
    <a class="p-2 text-dark" href="welcome.php"><h5>Profile</h5></a>
    <a class="btn btn-outline-primary" href="shop.php"><h5>Купить</h5></a>
    </div>

    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class='form-group'>
                  <h3>Total price: <?php echo $tp; ?></h3>
                </div>
            	<?php echo $q; ?>
            </div>
        </div>
    </div>
    

        
</body>
</html>
