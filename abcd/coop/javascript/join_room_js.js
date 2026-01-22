document.addEventListener('DOMContentLoaded', () => {

    console.log('JS loaded');

    const joinBtn = document.getElementById('join-room-button');
    const joinDiv = document.getElementById('join-room-div');
    const joinInput = document.getElementById('join-room-code');
    const joinConfirm = document.getElementById('confirm-join-room');
    const joinCancel = document.getElementById('cancel-join-room');

    if (joinBtn) {
        joinBtn.addEventListener('click', () => {
            joinDiv.classList.remove('hidden');
        });
    }

    if (joinCancel) {
        joinCancel.addEventListener('click', () => {
            joinDiv.classList.add('hidden');
            joinInput.value = '';
        });
    }

    if (joinConfirm) {
        joinConfirm.addEventListener('click', async () => {
            const code = joinInput.value.trim();

            if (!code) {
                alert('Please enter a room code');
                return;
            }

            try {
                const response = await fetch('coop/join_room.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `room_code=${encodeURIComponent(code)}`
                });

                const data = await response.json();

                if (!data.success) {
                    alert(data.message || 'Failed to join room');
                    return;
                }

                window.show_waiting_room(data.roomCode, data.isCreator);
                joinDiv.classList.add('hidden');
            } catch (err) {
                console.error(err);
                alert('Server error');
            }
        });
    }
});