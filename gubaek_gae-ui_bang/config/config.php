<?php
return (object) [

    // Application info
    'APP_NAME' => 'Online Escape Room',
    'APP_VERSION' => '0.1',
    'APP_AUTHOR' => 'Symona Antonov',

    // URLs & paths
    'BASE_URL' => 'http://localhost:8080/gubaek_gae-ui_bang',
    'ROOT_PATH' => __DIR__,
    'ASSETS_PATH' => '/rooms/assets',

    // Database config
    'DB_HOST' => '127.0.0.1',
    'DB_NAME' => 'escape_room',
    'DB_USER' => 'root',
    'DB_PASS' => '',

    // Game settings
    'DEFAULT_TIME_LIMIT' => 1800, 
    'HINT_INTERVAL' => 900, 
    'MAX_HINTS' => 3,

    // Feature flags
    'ENABLE_STORY_MODE' => true,
    'ENABLE_COMPETITIVE_MODE' => true
];
