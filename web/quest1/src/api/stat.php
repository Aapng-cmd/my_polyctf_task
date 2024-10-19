<?php
// Configuration
$db_host = 'mysql';
$db_username = 'user1';
$db_password = 'Giraffe#LemonTree88!';
$db_name = 'game_database';

ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_httponly', 0);


start_custom_session();

// Function to start the session
function start_custom_session() {
    session_start();
    if (isset($_COOKIE['custom_session_id'])) {
        load_session_data($_COOKIE['custom_session_id']);
    }
}

// Function to load session data from the database using session ID
function load_session_data($session_id) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT user_id FROM sessions WHERE session_id = ?");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $conn->close();

    return $result ? $result['user_id'] : null;
}

// Function to create a new session
function create_session($user_id) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $session_id = create_session_id();
    $stmt = $conn->prepare("INSERT INTO sessions (user_id, session_id) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $session_id);
    $stmt->execute();
    // setcookie('custom_session_id', $session_id, time() + (86400 * 30), "/");
    $conn->close();
    return $session_id;
}

// Function to create a unique session ID
function create_session_id() {
    return bin2hex(random_bytes(32));
}

// Function to destroy the custom session
function destroy_custom_session() {
    if (isset($_COOKIE['custom_session_id'])) {
        global $db_host, $db_username, $db_password, $db_name;
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $session_id = $_COOKIE['custom_session_id'];
        $stmt = $conn->prepare("DELETE FROM sessions WHERE session_id = ?");
        $stmt->bind_param("s", $session_id);
        $stmt->execute();
        setcookie('custom_session_id', '', time() - 3600, "/");
        $conn->close();
    }
}

// Function to check if the user is logged in using the cookie
function check_login_custom() {
    if (isset($_COOKIE['custom_session_id'])) {
        return load_session_data($_COOKIE['custom_session_id']) !== null;
    }
    return false;
}

// Function to set a value in the session
function custom_session_set($user_id) {
    create_session($user_id);
}

// Function to get user ID from the session
function custom_session_get_user_id() {
    if (isset($_COOKIE['custom_session_id'])) {
        return load_session_data($_COOKIE['custom_session_id']);
    }
    return null;
}

function get_username_by_id($user_id) {
    // Подключение к базе данных
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Подготовка и выполнение запроса для получения username
    $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();

    // Закрытие соединения
    $conn->close();

    // Возвращаем полученный username
    return $username;
}

// Function to login a user
function login($username, $password) {
	// logout();
//    if (check_login_custom()) {
//        return "Player logged in successfully";
//    }
    
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($username && $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", htmlspecialchars($username));
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Check if session already exists
                $session_id = create_session_id();
                $existing_session_sql = "SELECT * FROM sessions WHERE user_id = ?";
                $existing_stmt = $conn->prepare($existing_session_sql);
                $existing_stmt->bind_param("i", $row['id']);
                $existing_stmt->execute();
                $existing_result = $existing_stmt->get_result();

                if ($existing_result->num_rows > 0) {
                    // Update existing session
                    $update_sql = "UPDATE sessions SET session_id = ? WHERE user_id = ?";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bind_param("si", $session_id, $row['id']);
                    $update_stmt->execute();
                } else {
                    // Create a new session
                    $session_id = create_session($row['id']);
                }

                // Set the cookie
                setcookie('custom_session_id', $session_id, time() + (86400 * 30), "/"); // 30 days expiration
                return "Player logged in successfully";
            } else {
                return "Invalid username or password";
            }
        } else {
            return "Invalid username or password";
        }
    } else {
        return "Invalid username or password";
    }
    
    $conn->close();
}

// Function to register a new user
function registry($username, $password) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($username && $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", htmlspecialchars($username), $hashed_password);
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

// Function to logout a user
function logout() {
    if (isset($_COOKIE['custom_session_id'])) {
        global $db_host, $db_username, $db_password, $db_name;
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $session_id = $_COOKIE['custom_session_id'];
        $stmt = $conn->prepare("DELETE FROM sessions WHERE session_id = ?");
        $stmt->bind_param("s", $session_id);
        $stmt->execute();
        setcookie('custom_session_id', '', time() - 3600, "/");
        $conn->close();
        return "Logged out successfully";
    } else {
        return "No user logged in";
    }
}

// Additional functions
function custom_session_exists($key) {
    return isset($_SESSION[$key]);
}

function custom_session_get($key) {
    return $_SESSION[$key];
}

function custom_session_unset($key) {
    unset($_SESSION[$key]);
}

function update_game($user_id, $points) {
    // Подключение к базе данных
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Подготовка и выполнение запроса для проверки существования игры
    $stmt = $conn->prepare("SELECT best_game FROM games WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($best_game);
    $exists = $stmt->fetch(); // Проверка, существует ли запись
    $stmt->close();

    // Проверка, существует ли игра для данного пользователя
    if ($exists) {
        // Обновление best_game, если текущая игра лучше
        if ($points > $best_game) {
            $best_game = $points;
        }

        // Подготовка и выполнение запроса на обновление
        $stmt = $conn->prepare("UPDATE games SET best_game = ?, last_game = '$points' WHERE user_id = ?");
        $stmt->bind_param("ii", $best_game, $user_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Если игра не существует, можно создать новую запись
        $stmt = $conn->prepare("INSERT INTO games (user_id, best_game, last_game) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $points, $points);
        $stmt->execute();
        $stmt->close();
    }

    // Закрытие соединения
    $conn->close();
}

function verify_hash($points, $hash) {
    // Create a SHA-1 hash of the points
    $expected_hash = sha1((string)$points, true); // Raw binary output
    $expected_hash = base64_encode($expected_hash); // Encode to Base64 for comparison

    // Compare the expected hash with the provided hash
    return $expected_hash === $hash;
}

function get_game_info_by_user_id($user_id) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Подготовка и выполнение запроса для получения best_game и last_game
    $stmt = $conn->prepare("SELECT best_game, last_game FROM games WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($best_game, $last_game);
    $stmt->fetch();
    $stmt->close();

    // Закрытие соединения
    $conn->close();

    // Возвращаем информацию о игре
    return [
        'best_game' => $best_game,
        'last_game' => $last_game
    ];
}

// Функция для получения имен всех пользователей
function get_all_usernames() {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Запрос для получения имен пользователей
    $result = $conn->query("SELECT username FROM users");

    $usernames = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $usernames[] = $row['username'];
        }
    }

    // Закрытие соединения
    $conn->close();

    return $usernames;
}

// Function to create a new report
function create_report($username, $reason) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Подготовка и выполнение запроса для вставки отчета
    $stmt = $conn->prepare("INSERT INTO reports (username, reason) VALUES (?, ?)");
    $stmt->bind_param("ss", htmlspecialchars($username), $reason);
    
    if ($stmt->execute()) {
        echo "Отчет успешно добавлен.";
    } else {
        echo "Ошибка при добавлении отчета: " . $stmt->error;
    }

    // Закрытие соединения
    $stmt->close();
    $conn->close();
}

function get_all_reports() {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Запрос для получения всех отчетов
    $sql = "SELECT id, username, reason FROM reports";
    $result = $conn->query($sql);

    $reports = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reports[] = $row;
        }
    }

    // Закрытие соединения
    $conn->close();
    return $reports;
}


// Подключение к базе данных
function delete_report($report_id) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Проверка на существование отчета
    $stmt = $conn->prepare("SELECT COUNT(*) FROM reports WHERE id = ?");
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count === 0) {
        echo "Отчет с ID $report_id не существует.";
        $conn->close();
        return;
    }

    // Удаление отчета
    $stmt = $conn->prepare("DELETE FROM reports WHERE id = ?");
    $stmt->bind_param("i", $report_id); // Привязываем параметр (id отчета)

    if ($stmt->execute()) {
        
		// Закрытие соединения
		$stmt->close();
		$conn->close();
        return 1;
    } else {
    	
		// Закрытие соединения
		$stmt->close();
		$conn->close();
        return 0;
    }

}

?>
