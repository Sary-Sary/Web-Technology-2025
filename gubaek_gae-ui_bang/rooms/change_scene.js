let current_scene_id = INITIAL_SCENE_ID;

function change_scene(new_scene_id, new_background) {
    const current_scene = document.getElementById(current_scene_id);
    const new_scene = document.getElementById(new_scene_id);
    const room_scene = document.getElementById("room-scene");

    console.log('Here');

    if (!new_scene) return;

    console.log('Found scene');

    if (current_scene) {
        current_scene.classList.add("hidden");
        current_scene.classList.remove("active");
    }

    new_scene.classList.remove("hidden");
    new_scene.classList.add("active");

    room_scene.style.backgroundImage = `url('${new_background}')`;

    current_scene_id = new_scene_id;
}
