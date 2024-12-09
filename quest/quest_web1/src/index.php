<?php

require_once './api/stat.php';

start_custom_session(); // Start the custom session

if (!check_login_custom()) {
     header("Location: login.php");
     exit;
}

// Get the raw POST data
$data = json_decode(file_get_contents("php://input"), true);

// Check if data is received
if (isset($data['points']) && isset($data['hash'])) {
    $points = $data['points'];
    $hash = $data['hash'];
    
    if (verify_hash($points, $hash)) {
        update_game(custom_session_get_user_id(), $points);
    }
    else
    {
        echo "<p>" . "Bad Gateway" . "</p>";
    }
    // Here you can process the points and hash as needed
    // For example, save to the database or perform further logic

    // Send a response back
    // echo json_encode(['status' => 'success', 'points' => $points, 'hash' => $hash]);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Однорукий Джо</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Домашняя страница</a></li>
            <li><a href="logout.php">Выйти</a></li>
            
            <?php
            // Проверяем, является ли пользователь администратором или тестером
            $user_id = custom_session_get_user_id();
            $username = get_username_by_id($user_id);

            if ($username === 'admin') {
                echo '<li><a href="admin.php">Админ Панель</a></li>';
            }

            if ($username === 'tester') {
                echo '<li><a href="report.php">Создать отчет</a></li>';
            }
            ?>
        </ul>
    </nav>
    
    <div class="slot-machine">
        <div class="reel" id="reel1"></div>
        <div class="reel" id="reel2"></div>
        <div class="reel" id="reel3"></div>
    </div>
    <button id="spinButton">Пуск</button>
    <div id="result"></div>

    <script src="js/script.js"></script>
</body>
</html>
