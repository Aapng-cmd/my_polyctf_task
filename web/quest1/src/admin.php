<?php

require_once './api/stat.php';

// Запускаем кастомную сессию
start_custom_session();

// Проверяем, авторизован ли пользователь
if (!check_login_custom() || get_username_by_id(custom_session_get_user_id()) !== 'admin') {
    header("Location: login.php");
    exit;
}

// Установка заголовка CSP

// header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self'; connect-src 'self'; frame-ancestors 'none';");

// Обработка удаления отчета
if (isset($_POST['delete_report_id'])) {
    $report_id = $_POST['delete_report_id'];
    delete_report($report_id); // Функция для удаления отчета из БД
}

// Получаем все отчеты
$reports = get_all_reports(); // Предполагается, что эта функция возвращает массив отчетов
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ Панель - Все отчеты</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Подключаем CSS файл -->
    <style>
        /* Добавим стили для отчетов */
        .report {
            background: #fff;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        .report-details {
            display: none; /* Скрываем детали по умолчанию */
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Домашняя страница</a></li>
            <li><a href="logout.php">Выйти</a></li>
            <li><a href="index.php">Играть</a></li>
            <li><a href="reader.php">Файловый менеджер</a></li>
        </ul>
    </nav>

    <h1>Все отчеты</h1>
    
    <?php foreach ($reports as $report): ?>
        <div class="report" onclick="toggleDetails(this)">
            <strong>Пользователь:</strong> <?php echo htmlspecialchars($report['username']); ?>
            <div class="report-details">
                <p><strong>Причина:</strong> <?php echo $report['reason']; ?></p>
                <form method="POST" action="">
                    <input type="hidden" name="delete_report_id" value="<?php echo htmlspecialchars($report['id']); ?>">
                    <button type="submit">Удалить отчет</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        function toggleDetails(reportDiv) {
            const details = reportDiv.querySelector('.report-details');
            details.style.display = details.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
