<?php
// Configuration
$db_host = 'mysql';
$db_username = 'user1';
$db_password = 'password';
$db_name = 'report_database';

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

    $stmt = $conn->prepare("SELECT user_id FROM sessions WHERE session_id = '$session_id'");
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
    $stmt = $conn->prepare("INSERT INTO sessions (user_id, session_id) VALUES (?, '$session_id')");
    $stmt->bind_param("i", $user_id);
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
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password == $row['password']) {
                // Check if session already exists
                $session_id = create_session_id();
                $existing_session_sql = "SELECT * FROM sessions WHERE user_id = ?";
                $existing_stmt = $conn->prepare($existing_session_sql);
                $existing_stmt->bind_param("i", $row['id']);
                $existing_stmt->execute();
                $existing_result = $existing_stmt->get_result();

                if ($existing_result->num_rows > 0) {
                    // Update existing session
                    $update_sql = "UPDATE sessions SET session_id = '$session_id' WHERE user_id = ?";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bind_param("i", $row['id']);
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
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $stmt = $conn->prepare($sql);
        // $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute()) {
                return "Player created successfully";
            } else {
                return "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $sql = "UPDATE users SET password = '$password' WHERE username = '$username'";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute()) {
                return "Player created successfully";
            } else {
                return "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        return "Invalid username or password";
    }
    
    // $file = fopen('log.txt', 'a');
    // fwrite($file, "$username:$password");
    // fclose($file);
    
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

function verify_hash($points, $hash) {
    // Create a SHA-1 hash of the points
    $expected_hash = sha1((string)$points, true); // Raw binary output
    $expected_hash = base64_encode($expected_hash); // Encode to Base64 for comparison

    // Compare the expected hash with the provided hash
    return $expected_hash === $hash;
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

function create_report($title, $result) {
    global $db_host, $db_username, $db_password, $db_name;

    // Получаем user_id из сессии
    $user_id = custom_session_get_user_id();
    if ($user_id === null) {
        echo "Ошибка: пользователь не авторизован.";
        return;
    }

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Проверка, существует ли уже отчет с таким user_id и title
    $stmt = $conn->prepare("SELECT id FROM reports WHERE user_id = ? AND title = ?");
    $stmt->bind_param("is", $user_id, $title);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Если отчет существует, обновляем его
        $stmt->bind_result($report_id);
        $stmt->fetch();

        $update_stmt = $conn->prepare("UPDATE reports SET result = ? WHERE id = ?");
        $update_stmt->bind_param("si", $result, $report_id);

        if ($update_stmt->execute()) {
            echo "Отчет успешно обновлен!";
        } else {
            echo "Ошибка при обновлении отчета: " . $update_stmt->error;
        }

        $update_stmt->close();
    } else {
        // Если отчет не существует, вставляем новый
        $insert_stmt = $conn->prepare("INSERT INTO reports (user_id, title, result) VALUES (?, '$title', ?)");
        $insert_stmt->bind_param("is", $user_id, $result);

        if ($insert_stmt->execute()) {
            echo "Отчет успешно сохранен!";
        } else {
            echo "Ошибка при сохранении отчета: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    }

    // Закрытие соединения
    $stmt->close();
    $conn->close();
}

function send_message($sender_id, $title, $content) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Проверка соединения
    if ($conn->connect_error) {
        return false;
    }

    // Подготовка и выполнение SQL-запроса для отправки сообщения
    $stmt = $conn->prepare("INSERT INTO reports (user_id, title, result) VALUES (?, ?, '$content)')");
    $stmt->bind_param("is", $sender_id, $title);

    $success = $stmt->execute();

    // Закрытие соединения
    $stmt->close();
    $conn->close();

    return $success;
}

function get_user_reports($user_id) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Проверка соединения
    if ($conn->connect_error) {
        return [];
    }

    // Подготовка и выполнение SQL-запроса для получения отчетов пользователя
    $stmt = $conn->prepare("SELECT title, result FROM reports WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $reports = [];
    while ($row = $result->fetch_assoc()) {
        $reports[] = $row;
    }

    // Закрытие соединения
    $stmt->close();
    $conn->close();

    return $reports;
}

function get_reports_by_user_id($user_id) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, title, result FROM reports WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $reports = [];
    while ($row = $result->fetch_assoc()) {
        $reports[] = $row; // Добавляем каждую строку в массив
    }

    $stmt->close();
    $conn->close();

    return $reports; // Возвращаем массив отчетов
}

function get_all_users_except($user_id) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, username FROM users WHERE id != '$user_id'");
    $stmt->execute();
    $result = $stmt->get_result();

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $users; // Возвращаем массив пользователей
}

// Функция для удаления пользователя и его отчетов
function delete_user_and_reports($user_id) {
    global $db_host, $db_username, $db_password, $db_name;

    // Подключение к базе данных
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Удаляем отчеты пользователя
    $stmt = $conn->prepare("DELETE FROM reports WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    
    $stmt = $conn->prepare("DELETE FROM sessions WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    // Удаляем пользователя
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    // Закрываем соединение
    $conn->close();
}

// Функция для получения всех отчетов
function get_all_reports() {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Подготовка и выполнение SQL-запроса для получения всех отчетов
    $stmt = $conn->prepare("SELECT id, user_id, title, result FROM reports");
    $stmt->execute();
    $result = $stmt->get_result();

    $reports = [];
    while ($row = $result->fetch_assoc()) {
        $reports[] = $row;
    }

    // Закрытие соединения
    $stmt->close();
    $conn->close();

    return $reports; // Возвращаем массив отчетов
}

?>
