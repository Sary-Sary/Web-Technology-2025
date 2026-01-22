<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$userId   = $_SESSION['user_id'] ?? null;
$roomCode = $_POST['room_code'] ?? null;

if (!$userId || !$roomCode) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$stmt = $pdo->prepare("
    SELECT id, creator_id, started
    FROM coop_rooms
    WHERE room_code = ?
");
$stmt->execute([$roomCode]);
$room = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$room) {
    echo json_encode(['success' => false, 'message' => 'Room not found']);
    exit;
}

if ((int)$room['creator_id'] !== (int)$userId) {
    echo json_encode(['success' => false, 'message' => 'Only the creator can start the game']);
    exit;
}

if ((int)$room['started'] === 1) {
    echo json_encode(['success' => false, 'message' => 'Game already started']);
    exit;
}

$stmt = $pdo->prepare("
    UPDATE coop_rooms
    SET started = 1,
        started_at = NOW()
    WHERE id = ?
");
$stmt->execute([$room['id']]);

echo json_encode(['success' => true]);
exit;
