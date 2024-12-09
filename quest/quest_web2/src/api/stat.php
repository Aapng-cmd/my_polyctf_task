<?php
// Configuration
$db_host = 'mysql';
$db_username = 'user1';
$db_password = 'Giraffe#LemonTree88!';
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

function save_file($username, $filepath)
{
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Check if the file path already exists
    $stmt = $conn->prepare("SELECT id FROM files WHERE filepath = ?");
    $stmt->bind_param("s", $filepath);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // File path exists, update the existing record
        $stmt->close(); // Close the previous statement

        $stmt = $conn->prepare("UPDATE files SET username = ? WHERE filepath = ?");
        $stmt->bind_param("ss", $username, $filepath);
        if ($stmt->execute()) {
            return true; // Successfully updated
        } else {
            return false; // Update failed
        }
    } else {
        // File path does not exist, insert a new record
        $stmt->close(); // Close the previous statement

        $stmt = $conn->prepare("INSERT INTO files (filepath, username) VALUES (?, ?)");
        $stmt->bind_param("ss", $filepath, $username);
        if ($stmt->execute()) {
            return true; // Successfully inserted
        } else {
            return false; // Insert failed
        }
    }
}

function get_file_path($fileId)
{
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    // Prepare and execute the query to retrieve the file path
    $stmt = $conn->prepare("SELECT filepath FROM files WHERE id = ?");
    $stmt->bind_param("i", $fileId); // Bind parameters
    $stmt->execute();
    $result = $stmt->get_result();
    $file = $result->fetch_assoc();
    
    return $file;
}

// Function to get all files for the logged-in user
function get_user_files($username) {
    global $db_host, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    $stmt = $conn->prepare("SELECT id, filepath FROM files WHERE username = '$username'");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

?>
