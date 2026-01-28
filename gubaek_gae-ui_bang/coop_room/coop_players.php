<?php
require_once __DIR__ . '/../config/database.php';

$room_code = $_GET['code'] ?? null;
if (!$room_code) exit;

$stmt = $pdo->prepare("SELECT id FROM coop_rooms WHERE room_code = ?");
$stmt->execute([$room_code]);
$room = $stmt->fetch();
if (!$room) exit;

$stmt = $pdo->prepare("
    SELECT u.username
    FROM coop_room_users ru
    JOIN users u ON ru.user_id = u.id
    WHERE ru.room_id = ?
");
$stmt->execute([$room['id']]);

echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));

