document.addEventListener('DOMContentLoaded', () => {
    const leave_button = document.getElementById("leave-button");
    if (!leave_button) return;

    leave_button.addEventListener("click", async () => {
        await fetch("../coop/leave_waiting_room.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "room_code=" + encodeURIComponent(ROOM_CODE)
        });

        window.location.href = BASE_URL + "/test.php";
    });
});

console.log('??');

async function update_players() {
    const response = await fetch(
        "coop_players.php?code=" + encodeURIComponent(ROOM_CODE)
    );
    const players = await response.json();

    const ul = document.getElementById("player-list");
    ul.innerHTML = "";

    players.forEach(p => {
        const li = document.createElement("li");
        li.textContent = p;
        ul.appendChild(li);
    });
}

setInterval(update_players, 2000);
update_players();
