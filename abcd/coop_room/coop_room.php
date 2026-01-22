<?php
    session_start();
    require_once __DIR__ . '/../config/database.php';

    $roomCode = $_GET['code'] ?? null;

    if (!$roomCode) {
        die('Room code missing');
    }

    $stmt = $pdo->prepare("SELECT * FROM coop_rooms WHERE room_code = ?");
    $stmt->execute([$roomCode]);
    $room = $stmt->fetch();

    if (!$room) {
        die('Room not found');
    }

    if (!$room['started']) {
        $stmt = $pdo->prepare("UPDATE coop_rooms SET started = 1 WHERE id = ?");
        $stmt->execute([$room['id']]);
    }

    $stmt = $pdo->prepare("
        SELECT u.username 
        FROM coop_room_users ru
        JOIN users u ON ru.user_id = u.id
        WHERE ru.room_id = ?
    ");
    $stmt->execute([$room['id']]);
    $users = $stmt->fetchAll(PDO::FETCH_COLUMN);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Room <?php echo htmlspecialchars($roomCode); ?></title>
    <link rel="stylesheet" href="../base css/base.css">
    <link rel="stylesheet" href="../base css/components.css">
</head>
<body>
    <h1>Room <?php echo htmlspecialchars($roomCode); ?></h1>
    <p>
    <h2>Players:</h2>
    <p>
    <ul>
        <?php foreach ($users as $u): ?>
            <li><?php echo htmlspecialchars($u); ?></li>
        <?php endforeach; ?>
    </ul>

    <div id="timer"></div>

    <script>
    async function update_timer() {
        const response = await fetch(
            `coop_timer.php?code=<?php echo urlencode($roomCode); ?>`
        );
        const data = await response.json();

        if (!data.success) return;

        const total = data.elapsed;
        const minutes = Math.floor(total / 60);
        const seconds = total % 60;

        document.getElementById('timer').textContent =
            `${minutes}:${seconds.toString().padStart(2, '0')}`;
    }

    setInterval(update_timer, 1000);
    update_timer();
    </script>


    <p>game content</p>
</body>
</html>
