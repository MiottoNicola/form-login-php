<?php
$host = 'localhost';
$dbname = 'YOUT_DATABASE_NAME';
$username = 'YOUR__DATABASE_USERNAME';
$password = 'YOUR_DATABASE_PASSWORD';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
