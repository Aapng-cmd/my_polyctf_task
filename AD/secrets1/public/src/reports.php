<?php

require_once './api/stat.php';

start_custom_session(); // Начинаем сессию

if (!check_login_custom()) {
    header("Location: login.php");
    exit;
}

// Получаем user_id из сессии
$user_id = custom_session_get_user_id();

// Получаем все отчеты пользователя
$reports = get_user_reports($user_id);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои отчеты</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> <!-- Подключаем Bootstrap -->
    <link rel="stylesheet" href="css/styles.css"> <!-- Подключаем CSS файл -->
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
        <a class="navbar-brand" href="index.php">Мои отчеты</a>
        <a class="nav-link" href="index.php">Домашняя страница</a>
        <a class="nav-link" href="messages.php">Сообщения</a>
        <a class="nav-link" href="logout.php">Выйти</a>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Мои отчеты</h1>
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>№</th>
                    <th>Название</th>
                    <th>Результат</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reports)): ?>
                    <?php foreach ($reports as $index => $report): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td> <!-- Нумерация отчетов -->
                            <td><?php echo $report['title']; ?></td>
                            <td><?php echo $report['result']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Нет отчетов.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="text-center">
            <form action="index.php" method="get" class="d-inline">
                <button type="submit" class="btn btn-primary">Назад</button>
            </form>
        </div>
    </div>

    <!-- Подключаем jQuery 1.2 -->
    <script src="https://code.jquery.com/jquery-1.2.6.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>
