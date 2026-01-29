<?php
require_once __DIR__ . '/../../config/database.php';

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$username || !$email || !$password) {
    die('Missing fields');
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->rowCount() > 0) {
    die('Username already taken');
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->rowCount() > 0) {
    die('Email already taken');
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $hash]);

$player_id = $pdo->lastInsertId();

$stmt = $pdo->prepare("
    INSERT INTO player_rooms (player_id, room_id, completed)
    SELECT ?, id, 0 FROM rooms
");
$stmt->execute([$player_id]);

header('Location: ../login.php');
exit;
