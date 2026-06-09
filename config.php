<?php

declare(strict_types=1);

define('APP_ENV', getenv('APP_ENV') ?: 'production');
define('BASE_URL', getenv('BASE_URL') ?: 'https://afterthinkstudio.creative-fusion.co.in');
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_NAME', getenv('DB_NAME') ?: 'u663620806_afterthink');
define('DB_USER', getenv('DB_USER') ?: 'u663620806_afterthink');
define('DB_PASS', getenv('DB_PASS') ?: 'me!?|=S5/');
define('DB_CHARSET', 'utf8mb4');

define('UPLOADS_PATH', __DIR__ . '/uploads');
define('ASSETS_URL', BASE_URL . '/assets');

// Fallback brand logo used when no logo is configured in Settings.
define('DEFAULT_LOGO', ASSETS_URL . '/img/afterthink-logo.jpg');
