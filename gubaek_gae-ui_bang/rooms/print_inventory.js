const inventory = document.getElementById('inventory');
const inventoryList = document.getElementById('inventory-list');

document.addEventListener('keydown', (e) => {
    if (e.key.toLowerCase() === 'i') {
        inventory.classList.toggle('hidden');
    }
});

async function update_inventory() {
    const res = await fetch(`../get_inventory_items.php?room_id=${ROOM_ID}`);
    const items = await res.json();

    inventoryList.innerHTML = '';
    items.forEach(item => {
        const li = document.createElement('li');

        const img = document.createElement('img');
        img.src = "../" + item.item_image;
        img.alt = item.item_name;
        img.width = 40;

        const span = document.createElement('span');
        span.textContent = item.item_name;

        li.appendChild(img);
        li.appendChild(span);
        inventoryList.appendChild(li);
    });
}

setInterval(update_inventory, 2000);
update_inventory();
