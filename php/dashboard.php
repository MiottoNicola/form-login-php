<?php
session_start();

if (!isset($_SESSION['session_id'])) {
  header('Location: login.php');
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Dsshboard page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style3.css">
</head>

<body>
  <header>
    <h1>Welcome, John Doe</h1>
  </header>
</body>

</html>