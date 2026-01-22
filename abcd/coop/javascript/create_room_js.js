document.addEventListener('DOMContentLoaded', () => {
    console.log('Create room JS loaded');

    const create_button = document.getElementById('create-room-button');

    if (!create_button) {
        console.error('Create room button not found');
        return;
    }

    create_button.addEventListener('click', async () => {
        try {
            const response = await fetch('coop/create_co-op_room.php', {
                method: 'POST'
            });

            const data = await response.json();

            if (!data.success) {
                alert(data.message || 'Failed to create room');
                return;
            }

            window.show_waiting_room(data.roomCode, true);

        } catch (err) {
            console.error(err);
            alert('Server error');
        }
    });
});
