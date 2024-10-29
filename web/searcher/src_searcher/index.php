<?php
$topResults = [];
$query = '';
$searchUrl = '';

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['query']) && !empty($_POST['url'])) {
    // Получаем URL и запрос из формы
    $searchUrl = trim($_POST['url']);
    $query = trim($_POST['query']);

    // Создаем полный URL для запроса
    $url = $searchUrl . '?q=' . urlencode($query);

    // Инициализируем cURL сессию
    $ch = curl_init();

    // Устанавливаем параметры cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

    // Выполняем запрос
    $response = curl_exec($ch);

    // Закрываем cURL сессию
    curl_close($ch);
	
	echo $response;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск в Google</title>
    <style>
    body {
	  font-family: Arial, sans-serif;
	  background-color: #f9f9f9;
	  padding: 20px;
	}

	h1 {
	  color: #333;
	  font-size: 24px;
	  margin-bottom: 10px;
	}

	form {
	  display: flex;
	  flex-direction: column;
	  align-items: center;
	  padding: 20px;
	  border: 1px solid #ccc;
	  border-radius: 10px;
	  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	input[type="text"] {
	  padding: 10px;
	  font-size: 16px;
	  border: 1px solid #ccc;
	  border-radius: 5px;
	  width: 300px;
	}

	input[type="submit"] {
	  background-color: #4CAF50;
	  color: #fff;
	  padding: 10px 20px;
	  border: none;
	  border-radius: 5px;
	  cursor: pointer;
	}

	input[type="submit"]:hover {
	  background-color: #3e8e41;
	}

	h2 {
	  color: #666;
	  font-size: 18px;
	  margin-top: 20px;
	}

	ul {
	  list-style: none;
	  padding: 0;
	  margin: 0;
	}

	li {
	  margin-bottom: 10px;
	}

	a {
	  text-decoration: none;
	  color: #337ab7;
	}

	a:hover {
	  color: #23527c;
	}
    </style>
</head>
<body>
    <h1>Поиск в Woogle</h1>
    <form method="post" action="">
        <input type="text" name="query" placeholder="Введите запрос" required>
        <input type="hidden" name="url" value="https://www.google.com/search" class="e">
        <input type="submit" value="Поиск">
    </form>
    <!-- b -->
</body>
</html>
