<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$player_id = $_SESSION['user_id'] ?? null;
$room_id   = $_POST['room_id'] ?? null;
$item_key  = $_POST['item_key'] ?? '';

if (!$player_id || !$room_id || !$item_key) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM items WHERE room_id = ? AND item_key = ?");
$stmt->execute([$room_id, $item_key]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    echo json_encode(['success' => false, 'message' => 'Item not found']);
    exit;
}

$item_id = $item['id'];

$stmt = $pdo->prepare("
    INSERT INTO player_items (player_id, room_id, item_id, collected, used)
    VALUES (?, ?, ?, 1, 0)
    ON DUPLICATE KEY UPDATE collected = 1
");
$stmt->execute([$player_id, $room_id, $item_id]);

echo json_encode(['success' => true]);
exit;
