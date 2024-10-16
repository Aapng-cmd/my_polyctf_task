<?php
// api.php
require_once 'stat.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$json = json_decode(file_get_contents('php://input'), true);
    $params = $json['params'];

    if ($params === 'statistic') {
        echo get_statistics();
    } elseif ($params === 'create_game') {
    	echo create_game($json);
    }
} else {
    echo "Invalid request method";
}
?>
