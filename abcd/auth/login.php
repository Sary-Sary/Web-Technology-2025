<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        header('Location: ../test.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../base css/base.css">
    <link rel="stylesheet" href="../base css/components.css">
    <link rel="stylesheet" href="css/login.css"> 
    <title>Document</title>
</head>
<body>
    <div class="login-container">
    <h1>Login</h1>

    <form method="post" action="login_handler.php" novalidate>
        <label for="login">Username/Email</label>
        <input type="test" id="login" name="login" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <div id="login-error" class="error"></div>

        <button type="submit">Login</button>
    </form>

    <div class="extra-links">
        <p>No account? <a href="register.php">Register here</a></p>
    </div>

    <script src="javascript/login.js"></script>

</body>
</html>