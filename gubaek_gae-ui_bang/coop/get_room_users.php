<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$room_code = $_GET['code'] ?? '';

$stmt = $pdo->prepare("
    SELECT u.username
    FROM coop_rooms r
    JOIN coop_room_users ru ON r.id = ru.room_id
    JOIN users u ON u.id = ru.user_id
    WHERE r.room_code = ?
");
$stmt->execute([$room_code]);
$users = $stmt->fetchAll(PDO::FETCH_COLUMN);

$stmt2 = $pdo->prepare("SELECT started FROM coop_rooms WHERE room_code = ?");
$stmt2->execute([$room_code]);
$room = $stmt2->fetch();

echo json_encode([
    'success' => true,
    'users' => $users,
    'started' => $room['started'] ?? 0
]);
