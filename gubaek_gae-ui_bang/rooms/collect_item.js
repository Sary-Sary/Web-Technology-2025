async function collect_item(item_key) {
    await fetch(`../collect_item.php`, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `item_key=${encodeURIComponent(item_key)}&room_id=${encodeURIComponent(ROOM_ID)}`
    });

    console.log('Collected item');

    update_inventory();
}
