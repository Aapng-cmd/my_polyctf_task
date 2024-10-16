<?php
session_start();

if (isset($_SESSION['player_id'])) {
    unset($_SESSION['player_id']);
    if (isset($_SESSION['player_id'])) {
        echo "Failed to unset player_id";
        exit;
    }
}
// Destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: login.php");
exit;
?>
