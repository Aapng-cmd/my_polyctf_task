<?php
include 'r.php';

$page = "
                      <form action='' method='post'>
                        <div class='form-group'>
                            <label>Введите электронный адрес</label>
                            <input type='email' name='email' class='form-control' required>
                        </div>
                        <div class='form-group'>
                            <label>Введите старый пароль</label>
                            <input type='text' name='password' class='form-control' required>
                        </div>
                        <div class='form-group'>
                            <input type='submit' name='submit' class='btn btn-primary' value='Подтвердить'>
                        </div>
                    </form>
";

$conn = conn();

$cookie = $_COOKIE['PHPSESID'];

$sql = "select email from cookies where cookie='$cookie';";
$result = $conn -> query($sql);
$row = $result -> fetch_array();

$email = $row['email'];
if (isset($_POST['submit']))
{
  $conn = conn();
  
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  //$password = password_hash($password,  PASSWORD_DEFAULT);
  $sql = "select password from user where email='$email'";
  
  $query = $conn->prepare("$sql");
  if ($query)
  {
    //$query->bind_param('s', $name);
    $result = $conn -> query($sql);
    $row = $result -> fetch_array();
    $pass = $row['password'];
    if (!(password_verify($password, $pass)))
    {
      echo "<h1>Wrong password</h1>";
      
    } else {
    
      $page = "
                      <form action='' method='post'>
                        <div class='form-group'>
                            <label>Введите новый пароль</label>
                            <input type='text' name='password1' class='form-control' required>
                        </div>
                        <div class='form-group'>
                            <input type='submit' name='submit1' class='btn btn-primary' value='Подтвердить'>
                        </div>
                    </form>    
      ";
    }
  }
  
  
}

if (isset($_POST['submit1']))
{
  $password = trim($_POST['password1']);
  $password = password_hash($password,  PASSWORD_DEFAULT);
  $sql = "update user set password='$password' where email='$email'";
  $result = $conn -> query($sql);
  header("location: welcome.php");
}

$conn -> close();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Сброс Пароля</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
    
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"></h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="welcome.php">Home</a>
    </nav>
    <a class="btn btn-outline-primary" href="logout.php">Выход</a>
    </div>
    
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Сброс Пароля</h2>
                    <?php echo $page; ?>
                </div>
            </div>
        </div>    
    </body>
</html>
