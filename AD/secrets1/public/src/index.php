<?php
require_once './api/stat.php';

start_custom_session(); // Start the custom session

if (!check_login_custom()) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['title']) && isset($_POST['result'])) {
    $title = $_POST['title'];
    $result = $_POST['result'];

    // Вызов функции для сохранения отчета
    create_report($title, $result);
    
    echo "<h1>Отчет</h1>";
    echo "<p><strong>Название:</strong> $title</p>";
    echo "<p><strong>Результат работы:</strong></p>";
    echo "<p>$result</p>";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Генератор отчетов</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> <!-- Подключаем Bootstrap -->
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
        <a class="navbar-brand" href="index.php">Генератор отчетов</a>
        <a class="nav-link" href="reports.php">Рапорты</a>
        <a class="nav-link" href="messages.php">Сообщения</a>
        <a class="nav-link" href="logout.php">Выйти</a>
        
    </nav>
    <div class="container">
        <h1 class="text-center">Генератор отчетов</h1>
        <form action="index.php" method="POST" class="mb-4">
            <div class="form-group">
                <label for="title">Название:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="result">Результат работы:</label>
                <textarea id="result" name="result" class="form-control" required></textarea>
            </div>

            <input type="submit" class="btn btn-primary" value="Сгенерировать отчет">
        </form>
    </div>
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>
