<?php

declare(strict_types=1);

function siteUrl(string $path = ''): string
{
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}

function assetUrl(string $path): string
{
    $clean = ltrim($path, '/');
    $url = rtrim(ASSETS_URL, '/') . '/' . $clean;

    // Cache-busting: append the file's modification time so browsers fetch a
    // fresh copy whenever an asset changes (production serves assets with a
    // long max-age, so without this, CSS/JS updates would not reach clients).
    $file = dirname(__DIR__, 2) . '/assets/' . $clean;
    if (is_file($file)) {
        $url .= '?v=' . filemtime($file);
    }

    return $url;
}

function e(string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 * Lazily load and cache the global site settings row so layouts can read
 * branding (logo, site name) without each controller passing it explicitly.
 */
function siteSettings(): array
{
    static $cache = null;
    if ($cache === null) {
        try {
            $cache = (new SettingModel())->getSettings();
        } catch (Throwable $exception) {
            $cache = [];
        }
    }
    return $cache;
}

/**
 * Resolve the brand logo to a usable URL. Accepts an absolute URL or an
 * asset-relative path from Settings, falling back to the bundled default.
 */
function logoUrl(): string
{
    $logo = trim((string) (siteSettings()['logo'] ?? ''));
    if ($logo === '') {
        return defined('DEFAULT_LOGO') ? DEFAULT_LOGO : '';
    }

    return preg_match('#^https?://#', $logo) ? $logo : assetUrl($logo);
}

function excerpt(?string $value, int $maxChars = 160): string
{
    $text = trim(preg_replace('/\s+/', ' ', strip_tags((string) $value)) ?? '');
    if (mb_strlen($text) <= $maxChars) {
        return $text;
    }

    return rtrim(mb_substr($text, 0, $maxChars)) . '…';
}

function csrfToken(): string
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verifyCsrfToken(string $token): bool
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    return hash_equals($_SESSION['csrf_token'] ?? '', $token);
}
