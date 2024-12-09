<?php
require_once './api/stat.php';

start_custom_session(); // Начинаем сессию

if (!check_login_custom()) {
    header("Location: login.php");
    exit;
}

// Получаем user_id из сессии
$user_id = custom_session_get_user_id();

// Получаем всех пользователей для выбора
$user_result = get_all_users_except($user_id);

// Получаем отчеты текущего пользователя
$reports_result = get_reports_by_user_id($user_id);

// Обработка отправки сообщения
if (isset($_POST['recipient']) && isset($_POST['report_id'])) {
    $recipient_id = $_POST['recipient'];
    $report_id = $_POST['report_id'];

    // Получаем данные отчета
    $report = get_reports_by_user_id($user_id);
    $selected_report = null;

    foreach ($report as $r) {
        if ($r['id'] == $report_id) {
            $selected_report = $r;
            break;
        }
    }

    if ($selected_report) {
        // Здесь мы можем отправить отчет
        $content = "Отчет: " . $selected_report['title'] . "\nРезультат: " . $selected_report['result'];
        
        // Отправка сообщения (или создание нового отчета)
        if (send_message($recipient_id, $selected_report['title'], $selected_report['result'])) {
            echo "<p class='text-success'>Сообщение успешно отправлено!</p>";
        } else {
            echo "<p class='text-danger'>Ошибка при отправке сообщения.</p>";
        }
    } else {
        echo "<p class='text-danger'>Ошибка: выбранный отчет не найден.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отправка сообщения</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> <!-- Подключаем Bootstrap -->
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
        <a class="navbar-brand" href="index.php">Отправка сообщения</a>
        <a class="nav-link" href="reports.php">Рапорты</a>
        <a class="nav-link" href="index.php">Домашняя страница</a>
        <a class="nav-link" href="logout.php">Выйти</a>
        
    </nav>
    <div class="container">
        <h1>Отправка сообщения</h1>
        <form action="messages.php" method="POST" class="mb-4">
            <div class="form-group">
                <label for="recipient">Выберите получателя:</label>
                <select id="recipient" name="recipient" class="form-control" required>
                    <?php foreach ($user_result as $user): ?>
                        <option value="<?php echo $user['id']; ?>">
                            <?php echo user['username']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="report_id">Выберите отчёт:</label>
                <select id="report_id" name="report_id" class="form-control" required>
                    <?php foreach ($reports_result as $report): ?>
                        <option value="<?php echo $report['id']; ?>">
                            <?php echo report['title']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="submit" class="btn btn-primary" value="Отправить сообщение">
        </form>

        <div class="text-center">
            <form action="index.php" method="get">
                <button type="submit" class="btn btn-secondary">Назад</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>
