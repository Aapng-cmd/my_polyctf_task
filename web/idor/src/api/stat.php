<?php
// Configuration
$db_host = 'mysql';
$db_username = 'user1';
$db_password = 'Giraffe#LemonTree88!';
$db_name = 'images';

ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_httponly', 0);

// stat.php
function check_login() {
	if (!isset($_SESSION)) {
        session_start();
    }
    // logic to check user's authorization
    // return true or false
    if (!empty($_SESSION) && array_key_exists('name', $_SESSION) && $_SESSION['name'] !== '') {
        return true;
        // return "<h1>Вы авторизованы как " . $_SESSION['name'] . "</h1>";
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
        // Retrieve the User's data from the database
        $sql = "SELECT * FROM images_data WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the User exists
        if ($result->num_rows > 0) {
            // Get the User's data
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['password'])) {
                $_SESSION['name'] = $username;
                return "User logged in successfully";
            } else {
                return "Invalid password";
            }
        } else {
            return "User not found";
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
        $sql = "SELECT * FROM images_data WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // If the username does not exist, create a new User
        if ($result->num_rows === 0) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO images_data (name, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute()) {
                return "User created successfully";
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

/**
 * Uploads a file to a directory based on the user's ID.
 *
 * @param string $fileInputName The name of the file input field.
 * @param string $uploadDir The base directory for uploads.
 * @param array $allowedExtensions Optional. An array of allowed file extensions.
 * @param int $maxFileSize Optional. The maximum file size in bytes.
 *
 * @return bool|string Returns true on success, or an error message on failure.
 */
function uploadFile($fileInputName, $uploadDir, $allowedExtensions = null, $maxFileSize = null) {
    // Get the user's ID from the session
    $userId = $_SESSION['name'];

    // Create the upload directory if it doesn't exist
    $uploadPath = $uploadDir . '/' . $userId;
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    // Get the uploaded file information
    $file = $_FILES[$fileInputName];

    // Check if a file was uploaded
    if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
        return 'No file uploaded or upload error occurred.';
    }

    // Check the file extension if allowed extensions are specified
    if ($allowedExtensions && !in_array(pathinfo($file['name'], PATHINFO_EXTENSION), $allowedExtensions)) {
        return 'Invalid file extension. Allowed only jpg, jpeg, png, gif';
    }

    // Check the file size if a maximum size is specified
    if ($maxFileSize && $file['size'] > $maxFileSize) {
        return 'File size exceeds the maximum allowed size.';
    }

    // Generate SHA-256 hash for the filename
    $fileName = basename($file['name']);
    $hashedFileName = hash('sha256', $userId . $fileName) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

    // Move the uploaded file to the upload directory with the hashed filename
    $uploadFilePath = $uploadPath . '/' . $hashedFileName;
    if (!move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
        return 'Failed to move the uploaded file.';
    }

    // Save the original filename to a text file
    $originalFileNamePath = $uploadPath . '/original_filenames.txt';
    file_put_contents($originalFileNamePath, "$hashedFileName:$fileName\n", FILE_APPEND);

    return true;
}
