<?php

require_once './api/stat.php';

start_custom_session(); // Начинаем сессию

if (!check_login_custom()) {
    header("Location: login.php");
    exit;
}

// Получаем user_id из сессии
$user_id = custom_session_get_user_id();

// Удаляем пользователя и его отчеты
delete_user_and_reports($user_id);


// Разлогиниваем пользователя
// logout();

// Перенаправляем на страницу входа
header("Location: login.php");
exit;

?>
