<?php
session_start();
require 'api/stat.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['change_password'])) {
        $newPassword = $_POST['new_password'];
        // Call a function to change the password
        if (changePassword($_SESSION['username'], $newPassword)) {
            $success = "Пароль успешно изменен!";
        } else {
            $error = "Ошибка при изменении пароля.";
        }
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image'];

        // Handle image upload
        $imagePath = '';
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Allowed MIME types

        if ($image['error'] == 0) {
            // Check the MIME type of the uploaded file
            $fileType = $image['type'];
            if (in_array($fileType, $allowedTypes)) {
                $targetDir = "uploads/";
                $imagePath = $targetDir . basename($image['name']);
                if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                    // File uploaded successfully
                } else {
                    $error = "Ошибка при загрузке файла.";
                }
            } else {
                $error = "Недопустимый тип файла. Пожалуйста, загрузите изображение в формате JPEG, PNG или GIF.";
            }
        }

        if (empty($error) && createGame($name, $description, $imagePath)) {
            $success = "Игра успешно создана!";
        } else {
            $error = "Ошибка при создании игры.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
            opacity: 0; /* Start hidden */
            transition: opacity 0.3s ease; /* Smooth transition */
        }

        .modal.show {
            display: block; /* Show the modal */
            opacity: 1; /* Fade in */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            border-radius: 5px; /* Rounded corners */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Position the settings button */
        #settingsBtn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #35424a;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        #settingsBtn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Добро пожаловать, <?php echo $_SESSION['username']; ?>!</h1>
    </header>
    <div class="container">
        <h2>Создать игру</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Название игры" required>
            <textarea name="description" placeholder="Описание игры" required></textarea>
            <input type="file" name="image" accept="image/*" required>
            <button type="submit">Создать</button>
        </form>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        
        <button id="settingsBtn">Настройки</button>
        <p>
            <a href="rate.php">
                <button>Оценить игру</button>
            </a>
        </p>
        <p><a href="logout.php"><button>Выйти</button></a></p>

        <!-- The Modal -->
        <div id="settingsModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Изменить пароль</h2>
                <form method="POST">
                    <input type ="password" name="new_password" placeholder="Новый пароль" required>
                    <button type="submit" name="change_password">Изменить пароль</button>
                </form>
                <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
                <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            </div>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("settingsModal");

        // Get the button that opens the modal
        var btn = document.getElementById("settingsBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.classList.add("show");
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.classList.remove("show");
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.remove("show");
            }
        }
    </script>
</body>
</html>
