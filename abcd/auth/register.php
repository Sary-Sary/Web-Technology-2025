<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        header('Location: dashboard.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="css/login.css"> 
    <title>Document</title>
</head>
<body>
    <div class="login-container">
    <h1>Register</h1>

    <form method="post" action="registration_handler.php">
        <label for="username">Username</label>
        <input type="username" id="username" name="username" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <div class="extra-links">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>