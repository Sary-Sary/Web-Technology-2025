document.addEventListener('DOMContentLoaded', () => {
    let pollInterval = null;
    let currentRoomCode = null;

    window.show_waiting_room = function(code, isCreator = false) {
        const waitingDiv = document.getElementById('waiting-room-div');
        const roomCodeDisplay = document.getElementById('room-code');

        if (waitingDiv) waitingDiv.classList.remove('hidden');
        if (roomCodeDisplay) roomCodeDisplay.textContent = code;

        const start_button = document.getElementById('start-room');
        if (start_button) start_button.style.display = isCreator ? 'inline-block' : 'none';

        currentRoomCode = code;

        if (pollInterval) clearInterval(pollInterval);
        pollInterval = setInterval(fetchRoomUsers, 2000);
        fetchRoomUsers();
    };

    const copy_button = document.getElementById('copy-code');
    if (copy_button) {
        copy_button.addEventListener('click', () => {
            const code = document.getElementById('room-code').textContent;
            navigator.clipboard.writeText(code);
        });
    }

    // leave room
    const leave_button = document.getElementById('leave-room');
    if (leave_button) {
        leave_button.addEventListener('click', async () => {
            if (!currentRoomCode) return;

            try {
                const response = await fetch('coop/leave_waiting_room.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `room_code=${encodeURIComponent(currentRoomCode)}`
                });

                const data = await response.json();

                if (!data.success) {
                    alert(data.message || 'Failed to leave room');
                    return;
                }

                clearInterval(pollInterval);
                pollInterval = null;
                currentRoomCode = null;

                document.getElementById('waiting-room-div').classList.add('hidden');
                document.getElementById('user-list').innerHTML = '';

            } catch (err) {
                console.error(err);
                alert('Server error');
            }
        });
    }

    const start_button = document.getElementById('start-room');
    if (start_button) {
        start_button.addEventListener('click', async () => {
            const response = await fetch('coop/start_game.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `room_code=${encodeURIComponent(currentRoomCode)}`
            });
            const data = await response.json();
            if (!data.success) {
                alert(data.message || 'Failed to start game');
                return;
            }
            window.location.href = `coop_room/coop_room.php?code=${encodeURIComponent(currentRoomCode)}`;
        });
    }

    async function fetchRoomUsers() {
        if (!currentRoomCode) return;

        try {
            const response = await fetch(
                `coop/get_room_users.php?code=${encodeURIComponent(currentRoomCode)}`
            );

            const data = await response.json();
            if (!data.success) return;

            const list = document.getElementById('user-list');
            list.innerHTML = '';
            data.users.forEach(username => {
                const li = document.createElement('li');
                li.textContent = username;
                list.appendChild(li);
            });

            if (data.started) {
                clearInterval(pollInterval);
                window.location.href = `coop_room/coop_room.php?code=${encodeURIComponent(currentRoomCode)}`;
            }

        } catch (err) {
            console.error('Failed to fetch users:', err);
        }
    }
});
