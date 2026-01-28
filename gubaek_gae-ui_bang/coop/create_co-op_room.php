<?php
    session_start();
    require_once __DIR__ . '/../config/database.php';
    
    function generateroom_code($length = 6) {
        return strtoupper(bin2hex(random_bytes($length / 2)));
    }
    
    $userId = $_SESSION['user_id'];
    
    $room_code = generateroom_code();
    
    $stmt = $pdo->prepare(
        "INSERT INTO coop_rooms (room_code, creator_id)
         VALUES (?, ?)"
    );
    $stmt->execute([$room_code, $userId]);
    
    $roomId = $pdo->lastInsertId();
    
    $stmt = $pdo->prepare(
        "INSERT INTO coop_room_users (room_id, user_id)
         VALUES (?, ?)"
    );
    $stmt->execute([$roomId, $userId]);
    
    echo json_encode([
        'success' => true,
        'room_code' => $room_code
    ]);
exit;

