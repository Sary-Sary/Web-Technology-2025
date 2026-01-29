<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$room_code = $_GET['code'] ?? null;
if (!$room_code) die('Room code missing');

$stmt = $pdo->prepare("SELECT * FROM coop_rooms WHERE room_code = ?");
$stmt->execute([$room_code]);
$room = $stmt->fetch();
if (!$room) die('Room not found');

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

ob_start();
include __DIR__ . '/../rooms/room_one/room_one.php';
$room_html = ob_get_clean();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href='../rooms/room_one/'>
    <meta charset="UTF-8">
    <title>Room <?php echo htmlspecialchars($room_code); ?></title>
    <link rel="stylesheet" href="../../coop_room/coop_ui.css">
</head>
<body>

<div class="coop-layout">

    <div class="player-panel">
        <h3>Players</h3>
            <ul id="player-list"></ul>
    </div>

    <div class="game-container">
        <?= $room_html ?>

        <div class="timer-box" id="timer">0:00</div>
    </div>

</div>

<script>
async function update_timer() {
    const response = await fetch(
        "../../coop_room/coop_timer.php?code=<?php echo urlencode($room_code); ?>"
    );
    const data = await response.json();

    if (!data.success) return;

    const total = data.elapsed;
    const minutes = Math.floor(total / 60);
    const seconds = total % 60;

    document.getElementById("timer").textContent =
        `${minutes}:${seconds.toString().padStart(2,'0')}`;
}

setInterval(update_timer, 1000);
update_timer();
</script>

<script>
const ROOM_CODE = <?= json_encode($room_code) ?>;
</script>

<script src="../../coop_room/leave_room.js"></script>

</body>
</html>
