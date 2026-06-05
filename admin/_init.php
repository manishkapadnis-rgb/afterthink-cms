<?php

declare(strict_types=1);

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/models/Model.php';
require_once __DIR__ . '/../app/models/AdminModel.php';
require_once __DIR__ . '/../app/models/LoginAttemptModel.php';
require_once __DIR__ . '/../app/models/ServiceModel.php';
require_once __DIR__ . '/../app/models/ProjectModel.php';
require_once __DIR__ . '/../app/models/TestimonialModel.php';
require_once __DIR__ . '/../app/models/BlogModel.php';
require_once __DIR__ . '/../app/models/InquiryModel.php';
require_once __DIR__ . '/../app/models/MediaModel.php';
require_once __DIR__ . '/../app/models/SettingModel.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax',
        'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
    ]);
    session_start();
}

function requireAdmin(): void
{
    if (empty($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }
}

function adminUrl(string $path): string
{
    return $path;
}

function redirectAdmin(string $path): void
{
    header('Location: ' . adminUrl($path));
    exit;
}

function setFlash(string $message, string $type = 'success'): void
{
    $_SESSION['flash'] = ['message' => $message, 'type' => $type];
}

function getFlash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

function requireValidCsrf(): void
{
    $token = $_POST['csrf_token'] ?? '';
    if (!is_string($token) || !verifyCsrfToken($token)) {
        http_response_code(403);
        echo 'Invalid session token.';
        exit;
    }
}

function slugify(string $value): string
{
    $slug = strtolower(trim($value));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?? '';
    $slug = trim($slug, '-');
    return $slug !== '' ? $slug : 'item-' . time();
}

function normalizeStatus(string $status): string
{
    return in_array($status, ['draft', 'published'], true) ? $status : 'draft';
}
