<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Not logged in'
    ]);
    exit;
}

$player_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT r.file_path
    FROM player_rooms pr
    JOIN rooms r ON pr.room_id = r.id
    WHERE pr.player_id = ?
      AND pr.completed = 0
    ORDER BY r.room_order
    LIMIT 1
");

$stmt->execute([$player_id]);
$room = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$room) {
    echo json_encode([
        'success' => false,
        'message' => 'All rooms completed!',
        'room?' => $room,
        'player id' => $player_id
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'room_path' => $room['file_path']
]);
