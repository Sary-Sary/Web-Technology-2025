<?php
require_once __DIR__ . '/../../config/config.php';
$config = require __DIR__ . '/../../config/config.php';

$room_title = 'Tutorial Room';

ob_start();
?>

<link rel="stylesheet" href="<?= $config->BASE_URL ?>/rooms/room_one/room_css.css">

<div class="scene-viewport">
    <div class="scene-world">

<button class="item key">1</button>
<button class="item note">2</button>

<img src="background_one.jpg" class="scene-background">

</div>
</div>
<?php
$room_content = ob_get_clean();

require __DIR__ . '/../room_template.php';
