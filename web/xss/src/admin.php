<?php
error_reporting(0);

session_start();

ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_httponly', 0);

// print_r($_SESSION);

// Check if the user is an admin
if ($_SESSION['player_id'] === 'admin') {
    echo "flag_plug";
} else {
    echo "You are not an admin";
}
?>
