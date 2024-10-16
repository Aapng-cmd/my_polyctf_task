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

// Configuration
$uploadDir = 'uploads/'; // Upload directory

// Get the user's ID from the session
$userId = $_SESSION['name'];

// Create the upload directory if it doesn't exist
$uploadPath = $uploadDir . '/' . $userId;
if (!is_dir($uploadPath)) {
    mkdir($uploadPath, 0777, true);
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Call the uploadFile function
    $result = uploadFile('file', $uploadDir, ['jpg', 'jpeg', 'png', 'gif'], 1024 * 1024 * 2);
    if ($result === true) {
        $success = 'File uploaded successfully!';
    } else {
        $error = $result;
    }
}

// Get a list of uploaded files
$files = scandir($uploadPath);
$files = array_diff($files, ['.', '..']); // Remove . and .. directories

// Load original filenames into an associative array
$originalFilenames = [];
$originalFileNamePath = $uploadPath . '/original_filenames.txt';
if (file_exists($originalFileNamePath)) {
    $lines = file($originalFileNamePath);
    foreach ($lines as $line) {
        list($hashed, $original) = explode(':', trim($line));
        $originalFilenames[$hashed] = $original;
    }
}

?>

<?php
// ... (rest of the PHP code remains the same)

// Display uploaded files
if (!empty($files)): ?>
    <h2>Your Uploaded Files:</h2>
    <ul>
        <?php foreach ($files as $file): ?>
            <?php if (isset($originalFilenames[$file])): ?>
                <li>
                    <a href="<?php echo $uploadPath . '/' . $file; ?>" target="_blank"><?php echo $originalFilenames[$file]; ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No files uploaded yet.</p>
<?php endif; ?>

<!-- HTML Structure -->
<html>
<head>
    <title>File Uploader</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>File Uploader</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <button type="submit" class="button">Upload File</button>
        </form>
        <br><br>
        <button class="button" onclick="location.href='logout.php'">Logout</button>
        <!-- Display error or success message -->
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php elseif (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
