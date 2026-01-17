<?php
return (object) [

    // Application info
    'APP_NAME' => 'Online Escape Room',
    'APP_VERSION' => '0.1',
    'APP_AUTHOR' => 'Symona',

    // URLs & paths
    'BASE_URL' => 'http://localhost/escape_room',
    'ROOT_PATH' => __DIR__,
    'ASSETS_PATH' => '/public/assets',

    // Database config
    'DB_HOST' => '127.0.0.1',
    'DB_NAME' => 'escape_room_db',
    'DB_USER' => 'root',
    'DB_PASS' => '',

    // Game settings
    'DEFAULT_TIME_LIMIT' => 1800, // seconds
    'HINT_INTERVAL' => 900,       // 15 minutes
    'MAX_HINTS' => 3,

    // Feature flags
    'ENABLE_STORY_MODE' => true,
    'ENABLE_COMPETITIVE_MODE' => true
];
