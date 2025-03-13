<?php
session_start();
require_once('database.php');

if (isset($_SESSION['session_id'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Token CSRF non valido');
    }

    if (!isset($_POST['username'], $_POST['password'])) {
        die('Nome utente o password mancante');
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        die('Nome utente o password non corretti');
    }

    if (!password_verify($password, $user['password'])) {
        die('Nome utente o password non corretti');
    }

    $_SESSION['session_id'] = session_id();
    $_SESSION['user_id'] = $user['id'];

    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

    header('Location: dashboard.php');
    exit;
}

$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

echo '
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="css/style2.css">
    </head>
    <body>
        <form method="post" action="php/login.php">
            <h1 align="center">Login</h1>
            <input type="text" id="username" placeholder="Username" name="username" required>
            <input type="password" id="password" placeholder="Password" name="password" required>
            
            <!-- Aggiungi un campo nascosto per il token CSRF -->
            <input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">
            
            <div align="center"><button type="submit" name="login">Accedi</button></div>
            <div align="center" style="margin-top: 10px;">Non hai ancora un account? <a href="registrazione.php">Registrati</a></div>
        </form>
    </body>
</html>';
