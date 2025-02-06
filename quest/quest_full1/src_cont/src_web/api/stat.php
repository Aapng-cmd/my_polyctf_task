<?php
// Configuration
$db_host = 'mysql';
$db_username = 'user1';
$db_password = 'SVZpcIZV9l8vIv5hrrq81e';
$db_name = 'file_database';

session_start();

// Function to login a user
function login($username, $password) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session variables
            $_SESSION['username'] = $username; // Store username in session
            return true;
        } else {
            // Password is incorrect
            return false;
        }
    } else {
        // User does not exist
        return false;
    }
    
    $conn->close();
}


function register($username, $password) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username already exists
        return false;
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);
        
        if ($stmt->execute()) {
            // Registration successful
            return true;
        } else {
            // Registration failed
            return false;
        }
    }
    
    $conn->close();
}

// Function to logout a user
function logout() {
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

    header("Location: login.php");
    exit;
}

// Add these functions to your existing stat.php

function rateGame($gameId, $rating) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user has already rated this game
    $stmt = $conn->prepare("SELECT COUNT(*) FROM ratings WHERE game_id = ? AND username = ?");
    $stmt->bind_param("is", $gameId, $_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // User has already rated this game
        return false; // Indicate that the rating was not submitted
    }

    // Insert the rating into the database
    $stmt = $conn->prepare("INSERT INTO ratings (game_id, username, rating) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $gameId, $_SESSION['username'], $rating);
    
    if ($stmt->execute()) {
        return true; // Rating successful
    } else {
        return false; // Rating failed
    }

    $stmt->close();
    $conn->close();
}

function createGame($name, $description, $imagePath) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Insert the new game into the database
    $stmt = $conn->prepare("INSERT INTO games (name, description, image, created_by) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $description, $imagePath, $_SESSION['username']);
    
    if ($stmt->execute()) {
        return true; // Game creation successful
    } else {
        return false; // Game creation failed
    }
}

function getAllGames() {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to get all games and their average ratings
    $sql = "
        SELECT games.id, games.name, games.description, games.image, 
               COALESCE(AVG(ratings.rating), 0) AS average_rating
        FROM games
        LEFT JOIN ratings ON games.id = ratings.game_id
        GROUP BY games.id
    ";

    $result = $conn->query($sql);
    $games = [];

    if ($result->num_rows > 0) {
        // Fetch all games
        while ($row = $result->fetch_assoc()) {
            $games[] = $row;
        }
    }

    $conn->close();
    return $games;
}

?>
