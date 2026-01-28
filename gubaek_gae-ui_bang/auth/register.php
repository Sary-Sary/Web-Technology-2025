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
    <link rel="stylesheet" href="../base_css/base.css">
    <link rel="stylesheet" href="../base_css/components.css">
    <link rel="stylesheet" href="css/login.css"> 
    <title>Document</title>
</head>
<body>
    <div class="registration-container">
    <h1>Register</h1>

    <form method="post" action="php/registration_handler.php" novalidate>
        <label for="username">Username</label>
        <input type="test" id="username" name="username" required>
        <div class="error" id="username-error"></div>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <div class="error" id="email-error"></div>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <div class="error" id="password-error"></div>

        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" required>
        <div class="error" id="confirm-password-error"></div>

        <button type="submit">Register</button>
    </form>

    <div class="extra-links">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script src="javascript/registration.js"></script>

</body>
</html>