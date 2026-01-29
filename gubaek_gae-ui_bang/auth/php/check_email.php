<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/database.php';

if (!isset($_GET['email'])) {
    echo json_encode(['exists' => false]);
    exit;
}

$email = trim($_GET['email']);

$stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
$stmt->execute(['email' => $email]);

echo json_encode([
    'exists' => $stmt->fetch() !== false
]);
