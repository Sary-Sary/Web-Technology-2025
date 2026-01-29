document.addEventListener('DOMContentLoaded', () => {
    const hint_button = document.getElementById('hint-button');
    const modal = document.getElementById('hint-modal');
    const close_button = document.getElementById('close-hint');
    const overlay = modal.querySelector('.modal-overlay');

    console.log('Loaded');

    if (!hint_button) {
        console.log('Cannot find button');
        return;
    }
    hint_button.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    close_button.addEventListener('click', close_modal);
    overlay.addEventListener('click', close_modal);

    function close_modal() {
        modal.classList.add('hidden');
    }

    document.getElementById('leave-button').addEventListener('click', () => {
        fetch(`../../coop/leave_waiting_room.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `room_code=${encodeURIComponent(window.ROOM_CODE)}`
        }).finally(() => {
            window.location.href = `../../test.php`;
        });
    });

});
