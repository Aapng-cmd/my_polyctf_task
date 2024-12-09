<?php
require_once './api/stat.php';

start_custom_session(); // Начинаем сессию

// Проверяем, является ли пользователь администратором
if (!check_login_custom() || get_username_by_id(custom_session_get_user_id()) !== 'admin') {
    header("Location: login.php");
    exit;
}

// Получаем все отчеты
$reports = get_all_reports();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отчеты администраторов</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Подключите ваш CSS -->
    <script src="https://cdn.jsdelivr.net/npm/xss@2.1.0/dist/xss.min.js"></script> <!-- Include js-xss -->
</head>
<body>
    <h1>Все отчеты</h1>

    <?php if (empty($reports)): ?>
        <p>Нет доступных отчетов.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Заголовок</th>
                    <th>Результат</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                    <tr>
                        <td><?php echo $report['id']; ?></td>
                        <td><?php echo $report['user_id']; ?></td>
                        <td><?php echo $report['title']; ?></td>
                        <td><?php echo $report['result']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="logout.php">Выйти</a> <!-- Ссылка для выхода -->

    <script>
        // Sanitize output using js-xss before displaying it
        document.addEventListener('DOMContentLoaded', function() {
            // Select all table cells that might contain user input
            const cells = document.querySelectorAll('td');

            cells.forEach(cell => {
                // Sanitize the inner HTML of the cell
                const sanitizedContent = xss(cell.innerHTML);
                cell.innerHTML = sanitizedContent;
            });
        });
    </script>
</body>
</html>
