<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$userId = $_SESSION['user_id'] ?? null;
$roomCode = trim($_POST['room_code'] ?? '');

if (!$userId || !$roomCode) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM coop_rooms WHERE room_code = ?");
$stmt->execute([$roomCode]);
$room = $stmt->fetch();

if (!$room) {
    echo json_encode(['success' => false, 'message' => 'Room not found']);
    exit;
}

$stmt = $pdo->prepare("DELETE FROM coop_room_users WHERE room_id = ? AND user_id = ?");
$stmt->execute([$room['id'], $userId]);

echo json_encode(['success' => true]);
exit;
