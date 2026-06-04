<?php
// Core configuration for the Afterthink Studio CMS
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'u663620806_afterthink');
define('DB_USER', 'u663620806_afterthink');
define('DB_PASS', 'oA=5F911mO=');
define('BASE_URL', '/');
define('UPLOAD_DIR', __DIR__ . '/../assets/uploads/');
define('UPLOAD_URL', BASE_URL . 'assets/uploads/');
define('EMAIL_FROM', 'noreply@yourdomain.com');

date_default_timezone_set('UTC');

function baseUrl($path = '') {
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}
