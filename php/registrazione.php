<?php
session_start();
require_once('database.php');

if (isset($_SESSION['session_id'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->execute([$username, $password_hash]);

    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registrazione</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="css/style2.css">
    </head>
    <body>
        <form method="post">
            <h1 align="center">Registrazione</h1>
            <input type="text" id="username" placeholder="Username" name="username" required>
            <input type="password" id="password" placeholder="Password" name="password" required>
            <div align="center"><button type="submit" name="register">Registrati</button></div>
        </form>
    </body>
</html>
