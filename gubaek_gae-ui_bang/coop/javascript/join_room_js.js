document.addEventListener('DOMContentLoaded', () => {

    console.log('JS loaded');

    const join_btn = document.getElementById('join-room-button');
    const join_div = document.getElementById('join-room-div');
    const join_input = document.getElementById('join-room-code');
    const join_confirm = document.getElementById('confirm-join-room');
    const join_cancel = document.getElementById('cancel-join-room');

    if (join_btn) {
        join_btn.addEventListener('click', () => {
            join_div.classList.remove('hidden');
        });
    }

    if (join_cancel) {
        join_cancel.addEventListener('click', () => {
            join_div.classList.add('hidden');
            join_input.value = '';
        });
    }

    if (join_confirm) {
        join_confirm.addEventListener('click', async () => {
            const code = join_input.value.trim();

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

                console.log('Attempting to join...');

                if (!data.success) {
                    alert(data.message || 'Failed to join room');
                    return;
                }

                window.show_waiting_room(data.room_code, data.isCreator);
                join_div.classList.add('hidden');
            } catch (err) {
                console.error(err);
                alert('Server error');
            }
        });
    }
});