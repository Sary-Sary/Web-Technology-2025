<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$userId = $_SESSION['user_id'] ?? null;
$roomCode = trim($_POST['room_code'] ?? '');

if (!$userId || !$roomCode) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM coop_rooms WHERE room_code = ? AND started = 0");
$stmt->execute([$roomCode]);
$room = $stmt->fetch();

if (!$room) {
    echo json_encode(['success' => false, 'message' => 'Room not found or already started']);
    exit;
}

$stmt = $pdo->prepare("INSERT IGNORE INTO coop_room_users (room_id, user_id) VALUES (?, ?)");
$stmt->execute([$room['id'], $userId]);

echo json_encode([
    'success' => true,
    'roomCode' => $roomCode,
    'isCreator' => false
]);
exit;
