<?php

$config = require __DIR__ . '/config.php';

try {
    $pdo = new PDO(
        "mysql:host={$config->DB_HOST};dbname={$config->DB_NAME};charset=utf8mb4",
        $config->DB_USER,
        $config->DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}
