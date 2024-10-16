<?php
error_reporting(0);

ob_start();

session_start();
// index.php
require_once './api/stat.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST requests
} else {
    $response = check_login();
    if ($response !== true) {
        header("Location: login.php");
        exit;
    }
}
// rest of your HTML and JavaScript code here

?>

<!-- index.html -->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Крестики-нолики против компьютера</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .game-board {
            width: 300px;
            height: 300px;
            border: 1px solid #ddd;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            gap: 1px;
        }
        .cell {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 48px;
            border: 1px solid #ddd;
            background-color: #f0f0f0;
        }
        .cell:hover {
            background-color: #ccc;
        }
        .winner {
            background-color: #cfc;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Крестики-нолики против компьютера</h1>
    <div class="game-board">
        <?php for ($i = 0; $i < 9; $i++): ?>
            <div class="cell" id="cell-<?php echo $i ?>"></div>
        <?php endfor ?>
    </div>
    
    <!--<div id="game-container" data-player-id=<?php echo $_SESSION['player_id']; ?> ></div>-->
    
    <!-- Add a container for the button -->

    <div id="button-container"></div>
    
    <!-- Add the logout button -->
    <button id="logout-btn">Выйти</button>

    <script>
        document.getElementById('logout-btn').addEventListener('click', function() {
            window.location.href = 'logout.php';
        });
    </script>
    
    <script>
        let gameBoard = document.querySelector('.game-board');
        let cells = document.querySelectorAll('.cell');
        let currentPlayer = 'X';
        let gameOver = false;
        let computerPlayer = 'O';

        cells.forEach(cell => {
            cell.addEventListener('click', handleCellClick);
        });

        function handleCellClick(event) {
            if (gameOver) return;
            let cell = event.target;
            let cellIndex = cell.id.split('-')[1];
            if (cell.textContent === '') {
                cell.textContent = currentPlayer;
                checkWinner();
                if (!gameOver) {
                    computerTurn();
                }
            }
        }

        function checkWinner() {
            let winningCombinations = [
                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8],
                [0, 3, 6],
                [1, 4, 7],
                [2, 5, 8],
                [0, 4, 8],
                [2, 4, 6]
            ];
            for (let combination of winningCombinations) {
                let cell1 = cells[combination[0]];
                let cell2 = cells[combination[1]];
                let cell3 = cells[combination[2]];
                if (cell1.textContent === cell2.textContent && cell2.textContent === cell3.textContent && cell1.textContent !== '') {
                    gameOver = true;
                    cell1.classList.add('winner');
                    cell2.classList.add('winner');
                    cell3.classList.add('winner');
                    sendResults(cell1.textContent);
                    return;
                }
            }

            // Check if the game is a tie
            let allCellsFilled = true;
            for (let cell of cells) {
                if (cell.textContent === '') {
                    allCellsFilled = false;
                    break;
                }
            }
            if (allCellsFilled) {
                gameOver = true;
                sendResults('tie');
            }
        }

        function computerTurn() {
            let emptyCells = [];
            cells.forEach((cell, index) => {
                if (cell.textContent === '') {
                    emptyCells.push(index);
                }
            });

            // Check if the computer can win in the next move
            for (let i = 0; i < emptyCells.length; i++) {
                let cellIndex = emptyCells[i];
                cells[cellIndex].textContent = computerPlayer;
                if (checkWin(computerPlayer)) {
                    checkWinner(); // Call checkWinner after the computer wins
                    return;
                }
                cells[cellIndex].textContent = '';
            }

            // Check if the player can win in the next move and block them
            for (let i = 0; i < emptyCells.length; i++) {
                let cellIndex = emptyCells[i];
                cells[cellIndex].textContent = currentPlayer;
                if (checkWin(currentPlayer)) {
                    cells[cellIndex].textContent = computerPlayer;
                    checkWinner(); // Call checkWinner after the player is blocked
                    return;
                }
                cells[cellIndex].textContent = '';
            }

            // Play in the center of the board if it's empty
            if (cells[4].textContent === '') {
                cells[4].textContent = computerPlayer;
                checkWinner(); // Call checkWinner after the computer plays in the center
                return;
            }

            // Play in a random empty cell
            let randomIndex = Math.floor(Math.random() * emptyCells.length);
            let cellIndex = emptyCells[randomIndex];
            cells[cellIndex].textContent = computerPlayer;
            checkWinner(); // Call checkWinner after the computer plays in a random cell
        }

        function checkWin(player) {
            let winningCombinations = [
                                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8],
                [0, 3, 6],
                [1, 4, 7],
                [2, 5, 8],
                [0, 4, 8],
                [2, 4, 6]
            ];
            for (let combination of winningCombinations) {
                let cell1 = cells[combination[0]];
                let cell2 = cells[combination[1]];
                let cell3 = cells[combination[2]];
                if (cell1.textContent === cell2.textContent && cell2.textContent === cell3.textContent && cell1.textContent === player) {
                    return true;
                }
            }
            return false;
        }

        function sendResults(winner) {
            let gameId = Math.random().toString(36).substr(2, 9);
            // let playerId = document.getElementById("game-container").getAttribute("data-player-id");
            let playerId = "<?php echo $_SESSION['player_id']; ?>";
            let score;
            if (winner === 'X') {
                score = 1;
            } else if (winner === 'O') {
                score = 0.0;
            } else if (winner === 'tie') {
                score = 0.5;
            }
            fetch('./api/api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    params: 'create_game',
                    game_id: gameId,
                    player_id: playerId,
                    score: score,
                    level: 1,
                    completion_time: Date.now()
                })
            })
            .then(response => response.json())
            .then(data =>{
                // console.log(data);
                // Add the "новая игра" button after the game is over
                let button = document.createElement("button");
                button.textContent = "новая игра";
                button.onclick = function() {
                    // Refresh the page when the button is clicked
                    window.location.reload();
                };
                document.getElementById("button-container").appendChild(button);
            })
            .catch(error => console.error('Ошибка:', error));
        }
    </script>

    <table id="stats-table">
        <thead>
            <tr>
                <th>Идентификатор игрока</th>
                <th>Идентификатор игры</th>
                <th>Счёт</th>
                <th>Уровень</th>
                <th>Время прохождения</th>
            </tr>
        </thead>
        <tbody id="stats-body">
            <!-- Данные будут отображены здесь -->
        </tbody>
    </table>

    <script>
        function formatUnixTime(unixTime) {
            let date = new Date(unixTime * 1000);
            let day = date.getDate();
            let month = date.toLocaleString('ru-RU', { month: 'long' });
            let year = date.getFullYear();
            let hour = date.getHours();
            let minute = date.getMinutes();
            let second = date.getSeconds();

            return `${day} ${month} ${year} г. в ${hour}:${minute.toString().padStart(2, '0')}:${second.toString().padStart(2, '0')}`;
        }
        // Делаем запрос к API для получения статистики
        fetch('./api/api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                params: 'statistic'
            })
        })
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('stats-body');
            data.forEach(stat => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${stat.player_id}</td>
                    <td>${stat.game_id}</td>
                    <td>${stat.score}</td>
                    <td>${stat.level}</td>
                    <td>${formatUnixTime(stat.completion_time)}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Ошибка:', error));
    </script>
</body>
</html>
