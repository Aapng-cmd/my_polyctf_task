<?php
require_once './api/stat.php';

// Запускаем кастомную сессию
start_custom_session();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Чтение текстового файла</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css"> <!-- Подключаем CSS файл -->
    <style>
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .file-input {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            background-color: #5cb85c;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            margin-left: 10px;
        }
        button:hover {
            background-color: #4cae4c;
        }
        pre {
            background: #f8f8f8;
            padding: 15px;
            border-radius: 4px;
            overflow-x: auto;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
	<nav>
        <ul>
            <li><a href="home.php">Домашняя страница</a></li>
            <li><a href="logout.php">Выйти</a></li>
            <li><a href="index.php">Играть</a></li>
            <li><a href="admin.php">Репорты</a></li>
        </ul>
    </nav>
<div class="container">
    <h1>Чтение текстового файла</h1>
    <div class="file-input">
        <form action="srcreader.php" method="GET">
            <input type="text" name="file" placeholder="Введите путь к файлу .txt" required>
            <button type="submit"><i class="fas fa-file-alt"></i> Чтение файла</button>
        </form>
    </div>

    <!-- Здесь будет выводиться содержимое файла -->
    <div id="file-content">
        <?php
        // Если файл был передан через GET, показываем его содержимое
        if (isset($_GET['f'])) {
            $file = $_GET['f'];
			$file = str_replace("../", "", $file);
			$file = str_replace("./", "", $file);
			if (strpos($file, '/') === 0)
			{
				echo "<p class=error>Invalid start of filename.</p>";
			}
            if (pathinfo($file, PATHINFO_EXTENSION) === 'txt' && file_exists($file)) {
            	// Проверяем, авторизован ли пользователь
				if (!check_login_custom() || get_username_by_id(custom_session_get_user_id()) !== 'admin') {
					header("Location: login.php");
					exit;
				}
				
                $content = file_get_contents($file);
                echo "<h2>Содержимое файла: " . htmlspecialchars($file) . "</h2>";
                echo "<pre>" . htmlspecialchars($content) . "</pre>";
            } else {
                echo "<p class='error'>Ошибка: Файл не существует или неверный формат (только txt).</p>";
            }
        }
        ?>
    </div>
</div>

</body>
</html>
