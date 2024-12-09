<?php
session_start(); // Start the session
require_once './api/stat.php';
// Directory where uploaded files will be stored
$targetDirectory = "uploads/";
$uploadStatus = 0;
$message = "";

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page
    exit;
}

// do not forget about this 2. L5VTC3SEGRPW2MLEL4FA====

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the file was uploaded without errors
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $targetFilePath = $targetDirectory . $_SESSION['username'] . '/' . $fileName;
        $userDir = $targetDirectory . $_SESSION['username'];
        if (!file_exists($userDir)) {
            mkdir($userDir, 0777, true); // Create directory with appropriate permissions
        }
        
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = array("jpg", "png", "jpeg", "gif", "pdf", "xml");
        
        // Check if the file type is allowed
        if (in_array($fileType, $allowedTypes)) {
            // Attempt to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
                $uploadStatus = 1;
                $message = "The file " . $fileName . " has been uploaded.";
                save_file($_SESSION['username'], $targetFilePath);
            } else {
                $message = "There was an error uploading your file.";
            }
        } else {
            $message = "Sorry, only JPG, JPEG, PNG, GIF, PDF, and XML files are allowed.";
        }
    } else {
        $message = "Error: " . $_FILES["fileToUpload"]["error"];
    }
}

$uploadedFiles = get_user_files($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        input[type="file"] {
            display: block;
            margin: 20px 0;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 20px;
            text-align: center;
            color: green;
        }
        .error {
            color: red;
        }
        .file-list {
            margin-top: 20px;
        }
        .file-list a {
            display: block;
            margin: 5px 0;
            color: #007BFF;
            text-decoration: none;
        }
        .file-list a:hover {
            text-decoration: underline;
        }
        iframe { howtodo: 4. CM%=l[e}; }
    </style>
</head>
<body>
    <nav>
		<ul>
			<li><a href='logout.php'>Выход</a></li>
		<ul>
	</nav>
    <div class="container">
        <h2>Upload a File</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" required>
            <input type="submit" value="Upload File">
        </form>
        <?php if ($message): ?>
            <div class="message <?php echo $uploadStatus ? '' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="file-list">
			<h3>Uploaded Files:</h3>
			<?php if (!empty($uploadedFiles)): ?>
				<ul>
				    <?php foreach ($uploadedFiles as $file): ?>
				        <li>
				            <a href="reader.php?file_id=<?php echo urlencode($file['id']); ?>">
				                <?php echo htmlspecialchars($file['filepath']); ?>
				            </a>
				        </li>
				    <?php endforeach; ?>
				</ul>
			<?php else: ?>
				<p>No files uploaded yet.</p>
			<?php endif; ?>
		</div>
    </div>
</body>
</html> 
