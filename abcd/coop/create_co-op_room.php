<?php
    session_start();
    require_once __DIR__ . '/../config/database.php';
    
    function generateRoomCode($length = 6) {
        return strtoupper(bin2hex(random_bytes($length / 2)));
    }
    
    $userId = $_SESSION['user_id'];
    
    $roomCode = generateRoomCode();
    
    $stmt = $pdo->prepare(
        "INSERT INTO coop_rooms (room_code, creator_id)
         VALUES (?, ?)"
    );
    $stmt->execute([$roomCode, $userId]);
    
    $roomId = $pdo->lastInsertId();
    
    $stmt = $pdo->prepare(
        "INSERT INTO coop_room_users (room_id, user_id)
         VALUES (?, ?)"
    );
    $stmt->execute([$roomId, $userId]);
    
    echo json_encode([
        'success' => true,
        'roomCode' => $roomCode
    ]);
exit;

