function finish_room(roomId) {
    fetch(`${BASE_URL}/rooms/finish_room.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ room_id: roomId })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            window.location.href = BASE_URL + "/menu.php";
        }
    });
}
