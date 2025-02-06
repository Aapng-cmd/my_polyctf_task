<?php
session_start();
require 'api/stat.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (register($username, $password)) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Имя пользователя уже существует.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Регистрация</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Имя пользователя" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Зарегистрироваться</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <p>
            <a href="login.php">
                <button>Войти</button>
            </a>
        </p>
</body>
</html>
