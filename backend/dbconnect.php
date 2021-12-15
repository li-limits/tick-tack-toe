<?php
$host = 'localhost';
$dbname = 'tictactoe';
$username = 'root';
$password = '';

$conn = new PDO("mysql:host=$host;dbname=$dbname", "$username", "$password");
//$conn->set_charset("utf8");
?>