<?php
session_start();
require_once __DIR__ . '/../config/database.php';

date_default_timezone_set('Europe/Sofia'); 

$room_code = $_GET['code'] ?? null;
if (!$room_code) {
    echo json_encode(['success' => false]);
    exit;
}

$stmt = $pdo->prepare("
    SELECT started_at 
    FROM coop_rooms 
    WHERE room_code = ?
");
$stmt->execute([$room_code]);
$room = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$room || !$room['started_at']) {
    echo json_encode(['success' => true, 'elapsed' => 0]);
    exit;
}

$stmt = $pdo->query("SELECT UNIX_TIMESTAMP(NOW()) AS now_ts");
$now = $stmt->fetchColumn();
$elapsed = $now - strtotime($room['started_at']);

echo json_encode([
    'success' => true,
    'elapsed' => $elapsed,
    'starter at' => strtotime($room['started_at']),
    'started at timestamp' => $room['started_at'],
    'time' => time(),
    'minus' => time() - strtotime($room['started_at'])
]);
