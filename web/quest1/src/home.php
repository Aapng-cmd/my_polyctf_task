<?php

require_once './api/stat.php';

// Запускаем кастомную сессию
start_custom_session();

// Проверяем, авторизован ли пользователь
if (!check_login_custom()) {
    header("Location: login.php");
    exit;
}

// Получаем ID пользователя из кастомной сессии
$user_id = custom_session_get_user_id();

// Получаем username
$username = get_username_by_id($user_id);

// Получаем информацию о игре
$game_info = get_game_info_by_user_id($user_id);


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Домашняя страница</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Подключаем CSS файл -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #4CAF50;
        }
        .user-info {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        nav {
            margin-top: 20px;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 15px;
        }
        nav a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="user-info">
        <h1>Информация о пользователе</h1>
        <p><strong>ID игрока:</strong> <?php echo htmlspecialchars($user_id); ?></p>
        <p><strong>Имя пользователя:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>Лучший результат:</strong> <?php echo htmlspecialchars($game_info['best_game']); ?></p>
        <p><strong>Последний результат:</strong> <?php echo htmlspecialchars($game_info['last_game']); ?></p>
    </div>

    <nav>
        <ul>
            <li><a href="logout.php">Выйти</a></li>
            <li><a href="index.php">Играть</a></li>
        </ul>
    </nav>
</body>
</html>
