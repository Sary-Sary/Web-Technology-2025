<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$player_id = $_SESSION['user_id'] ?? null;
$room_id   = $_GET['room_id'] ?? null;

if (!$player_id || !$room_id) {
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare("
    SELECT ii.item_id, ii.item_name, ii.item_image, ii.item_desc
    FROM player_items pi
    JOIN items i ON pi.item_id = i.id
    JOIN item_info ii ON ii.item_id = i.id
    WHERE pi.player_id = ? AND i.room_id = ? AND pi.collected = 1
");
$stmt->execute([$player_id, $room_id]);

$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($items);
exit;
