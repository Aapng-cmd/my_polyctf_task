<?php
session_start(); 
require './api/stat.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit;
}

if (isset($_GET['file_id'])) {
    $fileId = intval($_GET['file_id']); 
    $file = get_file_path($fileId); 
    if ($file) {
        $filePath = $file['filepath'];
        $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        $allowedTypes = array("jpg", "png", "jpeg", "gif", "pdf", "xml");
        
        if (in_array($fileType, $allowedTypes) && file_exists($filePath)) {
            
            switch ($fileType) {
                case "jpg":
                case "jpeg":
                case "png":
                case "gif":
                    
                    echo "<h2>Image Preview:</h2>";
                    echo "<img src='$filePath' alt='Image' style='max-width: 100%; height: auto;'>";
                    break;
                case "pdf":
                    
                    echo "<h2>PDF Document:</h2>";
                    echo "<iframe src='$filePath' style='width: 100%; height: 600px;' frameborder='0'></iframe>";
                    break;
                case "xml":
					
					echo "<h2>XML Content:</h2>";
					
					$xml = simplexml_load_file($filePath);
					
					libxml_disable_entity_loader(false); 
					libxml_use_internal_errors(true);
					
					if ($xml === false) {
						echo "<pre>Error loading XML:</pre>";
						foreach (libxml_get_errors() as $error) {
							echo "<pre>" . htmlspecialchars($error->message) . "</pre>";
						}
					} else {
						$dom = new DOMDocument();
						$dom->preserveWhiteSpace = false;
						$dom->substituteEntities = true; // Enable entity expansion
						$dom->resolveExternals = true; // Enable external entity resolution
						$dom->loadXML($xml->asXML());
						
						echo $dom->saveXML();
					}
					break;
                default:
                    echo "<h2>Error:</h2> Unsupported file type.";
            }
        } else {
            echo "<h2>Error:</h2> File type not allowed or file does not exist.";
        }
    } else {
        echo "<h2>Error:</h2> File not found.";
    }
} else {
    
    $userFiles = get_user_files($conn, $_SESSION['username']);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Select File</title>
        <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                padding: 20px;
            }
            h1 {
                color: #333;
            }
            form {
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            select, button {
                padding: 10px;
                margin-top: 10px;
                width: 100%;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            button {
                background-color: #28a745;
                color: white;
                cursor: pointer;
                border: none;
            }
            button:hover {
                background-color: #218838;
            }
        </style>
    </head>
    <body>
        <h1>Select a File to View</h1>
        <form method="POST" action="">
            <select name="file_id" required>
                <option value="">Select a file</option>
                <?php foreach ($userFiles as $file): ?>
                    <option value="<?php echo $file['id']; ?>"><?php echo htmlspecialchars($file['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">View File</button>
        </form>
    </body>
    </html>
<?php
}
?>
