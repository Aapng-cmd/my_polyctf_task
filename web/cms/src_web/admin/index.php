<?php
include '../r.php';
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
  exit;
}

$sql = "select is_admin from user where email='$email'";
$result = $conn -> query($sql);
$row = $result -> fetch_array();

$is_admin = $row['is_admin'];

if ($is_admin)
{
  $row = ['flag' => 'PMLCTF{5Q11_1n51D3_c00K135_15_5m7h_n3w}', 'ps' => 'Just use php_session()'];
  
  echo "<p>" . $row['flag'] . "</p>";
  echo "<p>" . $row['ps'] . "</p>";
}



$conn -> close();


?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Вход</title>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    </head>
    <body>
    
    
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"></h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="../reset_pass.php"><h5>Восстановить пароль</h5></a>
    </nav>
    <a class="btn btn-outline-primary" href="../register.php"><h5>Регистрация</h5></a>
    </div>    
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Привет, <?php echo $email;?></h1>
                    <?php
                    if (!$is_admin)
                    {
                      echo "<p>Что ты тут делаешь?</p>";
                    }
                    ?>
                    <?php echo $error; ?>
                </div>
            </div>
        </div>    
    </body>
</html>
