<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Page</title>
    <link rel="stylesheet" href="base css/base.css">
    <link rel="stylesheet" href="base css/components.css">
    <link rel="stylesheet" href="coop/css/create_room.css">
</head>
<body>
    <h1>Welcome, <?php session_start(); echo $_SESSION['username'] ?? 'Guest'; ?>!</h1>

    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

    <button id="create-room-button">Create co-op room</button>
    
    <button id="join-room-button">Join co-op room</button>

    <div id="join-room-div" class="hidden">
        <div class="box-content">
            <h2>Join room</h2>
            <input type="text" id="join-room-code" placeholder="Enter room code">
            <button id="confirm-join-room">Join</button>
            <button id="cancel-join-room">Cancel</button>
        </div>
    </div>

    <div id="waiting-room-div" class="hidden">
        <div class="box-content waiting-layout">
            <div class="waiting-left">
                <h3>Room created!</h3>
                <p>Share this code:</p>
                <div id="room-code"></div>

                <button id="copy-code">Copy</button>
                <button id="start-room">Start game</button>
                <button id="leave-room">Leave room</button>
            </div>

            <div class="waiting-right">
                <h3>Players</h3>
                <ul id="user-list"></ul>
            </div>
        </div>
    </div>


    <script src="coop/javascript/create_room_js.js"></script>
    <script src="coop/javascript/join_room_js.js"></script>
    <script src="coop/javascript/waiting_room.js"></script>

</body>
</html>
