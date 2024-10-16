<?php
// Configuration
$db_host = 'mysql';
$db_username = 'game_user';
$db_password = 'Giraffe#LemonTree88!';
$db_name = 'games';

ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_httponly', 0);

// stat.php
function check_login() {
	if (!isset($_SESSION)) {
        session_start();
    }
    // logic to check user's authorization
    // return true or false
    if (!empty($_SESSION) && array_key_exists('player_id', $_SESSION) && $_SESSION['player_id'] !== '') {
        return true;
        // return "<h1>Вы авторизованы как " . $_SESSION['player_id'] . "</h1>";
    } else {
        return false;
        // return "<p>Вы не авторизованы. <a href='login.php'>Войти</a> или <a href='registry.php'>зарегистрироваться</a></p>";
    }
}

function login($username, $password) {
	if (!isset($_SESSION)) {
        session_start();
    }
    // Connect to the database
    global $db_host, $db_username, $db_password, $db_name;
	$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
    // logic to handle login
    // return true or false
    if ($username && $password) {
        // Retrieve the player's data from the database
        $sql = "SELECT * FROM game_data WHERE player_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the player exists
        if ($result->num_rows > 0) {
            // Get the player's data
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['password'])) {
                $_SESSION['player_id'] = $username;
                return "Player logged in successfully";
            } else {
                return "Invalid password";
            }
        } else {
            return "Player not found";
        }
    } else {
        return "Invalid username or password";
    }
    $conn->close();
}

function registry($username, $password) {
	if (!isset($_SESSION)) {
        session_start();
    }
    // Connect to the database
    global $db_host, $db_username, $db_password, $db_name;
	$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
    // logic to handle registry
    // return true or false
    if ($username && $password) {
        // Check if the username already exists
        $sql = "SELECT * FROM game_data WHERE player_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // If the username does not exist, create a new player
        if ($result->num_rows === 0) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO game_data (player_id, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute()) {
                return "Player created successfully";
            } else {
                return "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            return "Username already exists";
        }
    } else {
        return "Invalid username or password";
    }
    $conn->close();
}

function get_statistics() {
    global $db_host, $db_username, $db_password, $db_name;
	$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    // Retrieve the statistics from the database
    $sql = "SELECT game_id, player_id, score, level, completion_time FROM game_ids";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $stats = array();
    while ($row = $result->fetch_assoc()) {
        $stats[] = $row;
    }

    echo json_encode($stats);
    $conn->close();
}

function create_game($json) {
	global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    $game_id = $json['game_id'];
    $player_id = $json['player_id'];
    $score = $json['score'];
    $level = $json['level'];
    $completion_time = $json['completion_time'] / 1000;
    // Check if the player exists
    $sql = "SELECT * FROM game_data WHERE player_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $player_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Create a new game
        $sql = "INSERT INTO game_ids (game_id, player_id, score, level, completion_time) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdii", $game_id, $player_id, $score, $level, $completion_time);
        if ($stmt->execute()) {
            // Increment the games played counter
            $sql = "UPDATE game_data SET games_played = games_played + 1 WHERE player_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $player_id);
            if ($stmt->execute()) {
                echo "Game created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Player not found";
    }
    $conn->close();
}

?>
