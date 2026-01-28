<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

$player_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);
$room_id = $data['room_id'];

$stmt = $db->prepare("
    UPDATE player_rooms
    SET completed = 1
    WHERE player_id = ? AND room_id = ?
");
$stmt->execute([$player_id, $room_id]);

echo json_encode(["success" => true]);
