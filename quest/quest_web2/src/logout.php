<?php

require_once './api/stat.php';

echo "<p>" . logout() . "</p>";

// Redirect the user to the login page
header("Location: login.php");
exit;
?>
