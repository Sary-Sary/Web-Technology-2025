<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';

$login = trim($_POST['login'] ?? '');
$password = $_POST['password'] ?? '';

if (!$login || !$password) {
    echo json_encode(['success' => false, 'message' => 'Missing fields']);
    exit;
}

$stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE username = ? OR email = ?");
$stmt->execute([$login, $login]);
$user = $stmt->fetch();

if (!$user) {
    echo json_encode(['success' => false, 'message' => 'Invalid username/email or password']);
    exit;
}

if (!password_verify($password, $user['password_hash'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid username/email or password']);
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

echo json_encode(['success' => true, 'message' => 'Login successful']);
exit;
