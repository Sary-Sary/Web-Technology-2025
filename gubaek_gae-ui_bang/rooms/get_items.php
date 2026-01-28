<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$player_id = $_SESSION['user_id'] ?? null;
$room_id = $_GET['room_id'] ?? null;

if (!$player_id || !$room_id) exit;

$stmt = $pdo->prepare("
    SELECT i.id AS item_id, i.item_key, pi.collected
    FROM items i
    LEFT JOIN player_items pi
        ON i.id = pi.item_id AND pi.player_id = ?
    WHERE i.room_id = ?
");
$stmt->execute([$player_id, $room_id]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
