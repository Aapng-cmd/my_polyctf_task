<?php
include 'r.php';
$error = "";
$conn = conn();

$email = $_GET['email'];
$sa = trim($_GET['q']);

$sql = "select word from prom_ver where email='$email';";

$result = $conn -> query($sql);
$row = $result -> fetch_array();
$word = $row['word'];

if ($sa != $word) { header("location: register.php"); }

$conn -> close();

if (isset($_POST['submit']))
{
  $conn = conn();
  $cl = "";
  if ($conn == false)
  {
    die("Error: ");
  }
  
  $sql = "select id from user where email='$email';";
  
  $result = $conn -> query($sql);
  $row = $result -> fetch_array();
  $response = $result -> num_rows;

  $name = trim($_POST['name']);
  $password = trim($_POST['password']);
  $pass_con = trim($_POST['confirm_password']);
  
  if ($password != $pass_con)
  {
    $error = "<h3>Error: password is not verified.</h3>";
  }
  elseif ($response > 0)
  {
    $error = "<div class='error_login'>Error login</div>";
  }
  else
  {
    $password = password_hash($password,  PASSWORD_DEFAULT);
    
    $sql = "insert into user (name, password, email) values ('$name', '$password', '$email')";
    $result = $conn -> query($sql);
    $sql = "delete from prom_ver where email='$email';";
    $result = $conn -> query($sql);
    header("location: login.php");
    
  }
  
  $conn -> close();
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
    
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"></h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="reset_pass.php"><h5>Восстановить пароль</h5></a>
    </nav>
    <a class="btn btn-outline-primary" href="login.php"><h5>Вход</h5></a>
    </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Регистрация</h1>
                    <br><h3>Пожалуйста, заполните форму.</h3></br>
                    <?php echo $p; ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label><h4>Имя<h4></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>   
                        <div class="form-group">
                            <label><h4>Пароль</h4></label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label><h4>Повторите пароль</h4></label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Подтвердить">
                        </div>
                    </form>
                    <?php echo $error; ?>
                </div>
            </div>
        </div>    
    </body>
</html>
