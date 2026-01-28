function render_items(items) {
    items.forEach(item => {
        const el = document.querySelector(`[data-item-key="${item.item_key}"]`);
        if (!el) return;

        if (item.collected) {
            el.style.display = 'none';
        } else {
            el.style.display = '';
        }
    });
}

async function update_room_items() {
    const res = await fetch(`${BASE_URL}/rooms/get_items.php?room_id=${ROOM_ID}`);
    const items = await res.json();
    render_items(items);
}

setInterval(update_room_items, 2000);
update_room_items();
