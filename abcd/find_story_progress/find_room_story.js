document.addEventListener('DOMContentLoaded', () => {
    console.log('Story mode JS loaded');

    const storyButton = document.getElementById('story-mode-button');

    if (!storyButton) {
        console.error('Story mode button not found');
        return;
    }

    storyButton.addEventListener('click', async () => {
        try {
            const response = await fetch('find_story_progress/find_room_story.php', {
                method: 'POST'
            });

            const data = await response.json();

            if (!data.success) {
                alert(data.message || 'Could not find next room');
                return;
            }

            window.location.href = data.room_path;

        } catch (err) {
            console.error(err);
            alert('Server error');
        }
    });
});
