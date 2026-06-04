<?php
require_once __DIR__ . '/db.php';

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return $text ?: 'item-' . time();
}

function fetchAll($query, $params = []) {
    global $pdo;
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function fetchOne($query, $params = []) {
    global $pdo;
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    return $stmt->fetch();
}

function execute($query, $params = []) {
    global $pdo;
    $stmt = $pdo->prepare($query);
    return $stmt->execute($params);
}

function adminAuth() {
    if (empty($_SESSION['admin_logged_in'])) {
        header('Location: login.php');
        exit;
    }
}

function redirect($url) {
    header('Location: ' . $url);
    exit;
}

function uploadFile($fileInput, $existingFile = null, $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']) {
    if (empty($_FILES[$fileInput]) || $_FILES[$fileInput]['error'] !== UPLOAD_ERR_OK) {
        return $existingFile;
    }

    $file = $_FILES[$fileInput];
    if (!in_array($file['type'], $allowedTypes)) {
        return $existingFile;
    }

    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('file_') . '.' . $ext;
    $destination = UPLOAD_DIR . $filename;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        if ($existingFile && file_exists(UPLOAD_DIR . $existingFile)) {
            @unlink(UPLOAD_DIR . $existingFile);
        }
        return $filename;
    }

    return $existingFile;
}

function uploadMultipleFiles($fileInput) {
    $uploaded = [];
    if (empty($_FILES[$fileInput])) {
        return $uploaded;
    }

    for ($i = 0; $i < count($_FILES[$fileInput]['name']); $i++) {
        if ($_FILES[$fileInput]['error'][$i] !== UPLOAD_ERR_OK) {
            continue;
        }
        $tmpName = $_FILES[$fileInput]['tmp_name'][$i];
        $name = $_FILES[$fileInput]['name'][$i];
        $type = $_FILES[$fileInput]['type'][$i];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($type, $allowedTypes)) {
            continue;
        }
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $filename = uniqid('file_') . '.' . $ext;
        $destination = UPLOAD_DIR . $filename;
        if (move_uploaded_file($tmpName, $destination)) {
            $uploaded[] = $filename;
        }
    }
    return $uploaded;
}

function getSiteSettings() {
    return fetchOne('SELECT * FROM site_settings LIMIT 1');
}

function getSeoSettings() {
    return fetchOne('SELECT * FROM seo_settings LIMIT 1');
}

function getSocialLinks() {
    return fetchAll('SELECT * FROM social_links WHERE active = 1 ORDER BY sort_order, id');
}

function getContactInfo() {
    return fetchOne('SELECT * FROM contact_info LIMIT 1');
}

function getSafe($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function renderMeta($meta) {
    $title = getSafe($meta['meta_title'] ?? $meta['title'] ?? 'Afterthink Studio');
    $description = getSafe($meta['meta_description'] ?? $meta['description'] ?? 'Luxury architecture and interior design services.');
    $keywords = getSafe($meta['meta_keywords'] ?? 'architecture, interior design, portfolio, luxury homes');
    $ogTitle = getSafe($meta['og_title'] ?? $title);
    $ogDescription = getSafe($meta['og_description'] ?? $description);
    $ogImage = getSafe($meta['og_image'] ?? (UPLOAD_URL . ($meta['og_image'] ?? '')));
    echo "<title>{$title}</title>\n";
    echo "<meta name='description' content='{$description}' />\n";
    echo "<meta name='keywords' content='{$keywords}' />\n";
    echo "<meta property='og:title' content='{$ogTitle}' />\n";
    echo "<meta property='og:description' content='{$ogDescription}' />\n";
    if ($ogImage) {
        echo "<meta property='og:image' content='{$ogImage}' />\n";
    }
}
