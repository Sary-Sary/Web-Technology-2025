<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';

if (!isset($_GET['username'])) {
    echo json_encode(['exists' => false]);
    exit;
}

$username = trim($_GET['username']);

$stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
$stmt->execute(['username' => $username]);

echo json_encode([
    'exists' => $stmt->fetch() !== false
]);
