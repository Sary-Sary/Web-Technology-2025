<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
$db = require __DIR__ . '/../../config/db.php';

$player_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);
$item_id = $data['item_id'];

$stmt = $db->prepare("
    INSERT INTO player_items (player_id, item_id, found)
    VALUES (?, ?, 1, 0)
    ON DUPLICATE KEY UPDATE found = 1
");
$stmt->execute([$player_id, $item_id]);

echo json_encode(["success" => true]);
