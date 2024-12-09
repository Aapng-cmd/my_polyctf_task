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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> <!-- Подключаем Bootstrap -->
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
        <a class="navbar-brand" href="index.php">Чтение файла</a>
        <a class="nav-link" href="index.php">Домашняя страница</a>
        <a class="nav-link" href="logout.php">Выйти</a>
    </nav>

    <div class="container">
        <h1>Чтение текстового файла</h1>
        <div class="file-input mb-4">
            <form action="srcreader.php" method="GET" class="form-inline">
                <input type="text" name="file" class="form-control mr-2" placeholder="Введите путь к файлу .txt" required>
                <button type="submit" class="btn btn-primary"><i class="fas fa-file-alt"></i> Чтение файла</button>
            </form>
        </div>

        <div id="file-content">
            <?php
            if (isset($_GET['f'])) {
                $file = $_GET['f'];
                $file = str_replace("../", "", $file);
                $file = str_replace("./", "", $file);
                if (strpos($file, '/') === 0) {
                    echo "<p class='text-danger'>Invalid start of filename.</p>";
                }
                if (pathinfo($file, PATHINFO_EXTENSION) === 'txt' && file_exists($file)) {
                    if (!check_login_custom() || get_username_by_id(custom_session_get_user_id()) !== 'admin') {
                        header("Location: login.php");
                        exit;
                    }
                    
                    $content = file_get_contents($file);
                    echo "<h2>Содержимое файла: " . htmlspecialchars($file) . "</h2>";
                    echo "<pre class='bg-light p-3'>" . htmlspecialchars($content) . "</pre>";
                } else {
                    echo "<p class='text-danger'>Ошибка: Файл не существует или неверный формат (только txt).</p>";
                }
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>
