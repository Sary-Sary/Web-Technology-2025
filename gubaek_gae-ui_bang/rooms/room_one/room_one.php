<?php
require_once __DIR__ . '/../../config/config.php';
$config = require __DIR__ . '/../../config/config.php';

$room_title = 'Tutorial Room';
$room_background = 'background_one.jpg';
$initial_scene_id = 'one';

ob_start();
?>

<link rel="stylesheet" href="room_css.css">

<div class="scene-viewport">

    <div class="scene-world active" id="one">
        <button class="item triangle arrow" data-item-key="test_item" onclick="collect_item('test_item')">1</button>
        <button class="item note" onclick="change_scene('two', 'background_two.jpg')">2</button>
    </div>

    <div class="scene-world hidden" id="two">
        <button class="item triangle arrow" onclick="change_scene('one', 'background_one.jpg')">3</button>
        <button class="item note">4</button>
    </div>

</div>

<?php
$room_content = ob_get_clean();

require __DIR__ . '/../room_template.php';
