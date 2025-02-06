<?php
session_start();
require 'api/stat.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gameId = $_POST['game_id'];
    $rating = $_POST['rating'];

    if (rateGame($gameId, $rating)) {
        $success = "Спасибо за вашу оценку!";
    } else {
        $error = "Ошибка при оценке игры.";
    }
}

$games = getAllGames(); // Function to fetch all games and their average ratings

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оценка игр</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Оцените игры</h1>
    </header>
    <div class="container">
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        
        <h2>Список игр</h2>
        <ul>
            <?php foreach ($games as $game): ?>
                <li>
                    <h3><?php echo htmlspecialchars($game['name']); ?></h3>
                    <p><?php echo htmlspecialchars($game['description']); ?></p>
                    <img src="<?php echo htmlspecialchars($game['image']); ?>" alt="<?php echo htmlspecialchars($game['name']); ?>" style="max-width: 200px;">
                    <p>Средний рейтинг: <?php echo number_format($game['average_rating'], 2); ?></p>
                    <form method="POST">
                        <input type="hidden" name="game_id" value="<?php echo $game['id']; ?>">
                        <label for="rating">Ваша оценка:</label>
                        <select name="rating" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button type="submit">Оценить</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <p><a href="index.php"><button>Создать новую игру</button></a></p>
        <p><a href="logout.php"><button>Выйти</button></a></p>
    </div>
</body>
</html>
