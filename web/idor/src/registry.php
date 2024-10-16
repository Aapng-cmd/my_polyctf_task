<?php
// registry.php
require_once './api/stat.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $params = 'registry';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $response = registry($username, $password);
    if ($response === "Player created successfully") {
        header("Location: login.php");
        exit;
    } else {
        echo $response;
    }
}

// rest of your HTML and JavaScript code here
?>

<!DOCTYPE html>
<html>
<head>
    <title>Страница регистрации</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 10px;
        }
        .form-group input[type="text"], .form-group input[type="password"] {
            width: 100%;
            height: 40px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            height: 40px;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Регистрация</h2>
        <form action="registry.php" method="post">
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button class="btn" type="submit">Зарегистрироваться</button>
        </form>
        <p>У вас уже есть аккаунт? <a href="login.php">Войти</a></p>
    </div>
</body>
</html>
