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

$sql = "select id from user where email = (select email from cookies where cookie='$cookie');";
$result = $conn -> query($sql);
$row = $result -> fetch_array();

$id = $row['id'];

if ($id != 0) { header("location: ../login.php"); }

if (isset($_POST['submit']))
{
  $path = "NULL";
  $alias = trim($_POST['name']);
  $flag = add_files($_FILES, $alias);

  if ($flag)
  {
    $path = $flag;

    
    $descr = trim($_POST['descr']);
    $price = trim($_POST['price']);
    $count = trim($_POST['much']);
    echo 0;
    $sql = "insert into products (alias, price, count, path) values ('$alias', $price, $count, '$path');";
    try
    {
      $result = $conn -> query($sql);
      echo 1;
    } catch (Exception $e) {
      $sql = "select alias from products where alias='$alias';";
      echo 2;
      $result = $conn -> query($sql);
      $row = $result -> fetch_array();
      echo 3;
      if ($row['alias'] !== $alias)
      {
        $sql = "update products set alias = '$alias', price = $price, count = $count, path = '$path';";
        $result = $conn -> query($sql);
      }
    }
    
    $qq = "";
    
    $q = make_prod($alias, $descr, $price, $count);
    if ($q !== 0)
    {    
      $myfile = fopen("/var/www/html/cms/templates/template.php", 'r');
      $qq = fread($myfile, filesize("/var/www/html/cms/templates/template.php"));
      fclose($myfile);
      
      $q = $qq . $q;
      
      $myfile = fopen("/var/www/html/cms/products/$alias.php", 'w');
      fwrite($myfile, $q);
      fclose($myfile);
    }
  }
  
}

$conn -> close();

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
     <title>Admin page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"></h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="lost_pass.php"><h5>Сменить пароль</h5></a>
    </nav>
    <a class="p-2 text-dark" href="admin.php"><h5>Admin</h5></a>
    <a class="btn btn-outline-primary" href="/cms/shop.php"><h5>Купить</h5></a>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $name ?></h1>
                <br><h3>HI</h3></br>
                <form enctype="multipart/form-data" action="admin.php" method="POST">
                    <div class="form-group">
                        <label><h4>name</h4></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><h4>description</h4></label>
                        <input type="text" name="descr" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><h4>price</h4></label>
                        <input type="number" name="price" class="form-control" min="0" required>
                    </div>
                    <div class="form-group">
                        <label><h4>count</h4></label>
                        <input type="number" name="much" class="form-control" min="0" required>
                    </div>
                
                    <input type="hidden" name="MAX_FILE_SIZE" value="50000" />
                    Send this file: <input name="fileToUpload" type="file" id="fileToUpload" />
                    <input type="submit" value="Send File" name="submit" class="btn btn-primary" />
            	</form>
                <?php echo $error; ?>
            </div>
        </div>
    </div>    
</body>
</html>
