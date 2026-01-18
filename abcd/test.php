<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Page</title>
    <link rel="stylesheet" href="auth/css/base.css">
    <link rel="stylesheet" href="auth/css/components.css">
</head>
<body>
    <h1>Welcome, <?php session_start(); echo $_SESSION['username'] ?? 'Guest'; ?>!</h1>

    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
