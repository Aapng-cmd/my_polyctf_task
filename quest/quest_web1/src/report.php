<?php

require_once './api/stat.php';

// Запускаем кастомную сессию
start_custom_session();

// Проверяем, авторизован ли пользователь
if (!check_login_custom() && get_username_by_id(custom_session_get_user_id()) !== 'tester') {
    header("Location: login.php");
    exit;
}



// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $reason = $_POST['reason'];

    // Здесь можно добавить код для сохранения отчета в базу данных или отправки уведомления
    create_report($username, $reason);
    
    // Пример вывода информации (можно заменить на сохранение в БД)
    echo "<h3>Отчет отправлен:</h3>";
    echo "<p><strong>Имя пользователя:</strong> " . htmlspecialchars($username) . "</p>";
    echo "<p><strong>Причина:</strong> " . htmlspecialchars($reason) . "</p>";
}

$usernames = get_all_usernames();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отчет о пользователе</title>
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
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Домашняя страница</a></li>
            <li><a href="logout.php">Выйти</a></li>
        </ul>
    </nav>

    <h1>Отчет о пользователе</h1>
    
    <form method="POST" action="">
        <label for="username">Имя пользователя:</label>
        <select name="username" id="username" required>
            <?php foreach ($usernames as $user): ?>
                <option value="<?php echo htmlspecialchars($user); ?>"><?php echo htmlspecialchars($user); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="reason">Причина:</label>
        <textarea name="reason" id="reason" rows="4" required></textarea>

        <button type="submit">Отправить отчет</button>
    </form>

</body>
</html>
