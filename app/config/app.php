<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config.php';

return [
    'base_url' => BASE_URL,
    'assets_url' => ASSETS_URL,
    'uploads_path' => UPLOADS_PATH,
    'db' => [
        'host' => DB_HOST,
        'name' => DB_NAME,
        'user' => DB_USER,
        'charset' => DB_CHARSET,
    ],
];
