<?php

declare(strict_types=1);

function siteUrl(string $path = ''): string
{
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}

function assetUrl(string $path): string
{
    return rtrim(ASSETS_URL, '/') . '/' . ltrim($path, '/');
}

function e(string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
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
