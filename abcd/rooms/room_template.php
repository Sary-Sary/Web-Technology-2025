<?php
$room_title   = $room_title   ?? 'Escape Room';
$room_content = $room_content ?? '';
$room_css     = $room_css     ?? null;
$room_js      = $room_js      ?? null;
$room_background  = $room_background ?? null;
$initial_scene_id = $initial_scene_id ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($room_title) ?></title>

    <link rel="stylesheet" href="<?= $config->BASE_URL ?>/base_css/base.css">
    <link rel="stylesheet" href="<?= $config->BASE_URL ?>/base_css/components.css">
    <link rel="stylesheet" href="<?= $config->BASE_URL ?>/rooms/room_template_css.css">

    <?php if ($room_css): ?>
        <link rel="stylesheet" href="../<?= htmlspecialchars($room_css) ?>">
    <?php endif; ?>
</head>
<body>

<div class="room-layout">

    <aside class="room-topbar">
        <button id="hint-button">Hint</button>
        <button id ="leave-button">Return to Menu</button>
    </aside>

    <div id="hint-modal" class="modal hidden">
    <div class="modal-overlay"></div>

    <div class="modal-box">
        <h2>Hints</h2>
        <div id="hint-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    </div>

    <button id="close-hint">Close</button>
    </div>
    </div>

    <main class="room-content">
        <div class="room-canvas">
            <div class="room-scene" id="room-scene"
             style="
            background-image: url('<?= htmlspecialchars($room_background) ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            ">
                <?= $room_content ?>
            </div>
        </div>
    </main>

</div>

<?php if ($room_js): ?>
<script src="../<?= htmlspecialchars($room_js) ?>"></script>
<?php endif; ?>

<script>
    const BASE_URL = <?= json_encode($config->BASE_URL) ?>;
    const INITIAL_SCENE_ID = <?= json_encode($initial_scene_id) ?>;
</script>
<script src="<?= $config->BASE_URL ?>/rooms/room_template_js.js"></script>
<script src="<?= $config->BASE_URL ?>/rooms/change_scene.js"></script>
</body>
</html>

<style>
.triangle {
    background-image: url("<?= $config->BASE_URL ?>/rooms/assets/triangle.png");
    width: 20px;
    height: 20px;
}
</style>
