<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';
requireAdmin();

$model = new MediaModel();
$db = getDatabase();
$errors = [];
$allowedTypes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp',
    'image/gif' => 'gif',
    'application/pdf' => 'pdf',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();
    $action = $_POST['action'] ?? '';

    if ($action === 'upload') {
        $file = $_FILES['media_file'] ?? null;
        if (!$file || !isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Please choose a valid file.';
        } elseif (($file['size'] ?? 0) > 5 * 1024 * 1024) {
            $errors[] = 'File size must be 5 MB or smaller.';
        } else {
            $tmpName = (string) $file['tmp_name'];
            $mime = mime_content_type($tmpName) ?: '';
            if (!isset($allowedTypes[$mime])) {
                $errors[] = 'Unsupported file type.';
            } else {
                $extension = $allowedTypes[$mime];
                $safeBase = slugify(pathinfo((string) $file['name'], PATHINFO_FILENAME));
                $fileName = $safeBase . '-' . bin2hex(random_bytes(6)) . '.' . $extension;
                $targetPath = rtrim(UPLOADS_PATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName;

                if (!is_dir(UPLOADS_PATH)) {
                    mkdir(UPLOADS_PATH, 0755, true);
                }

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $model->create([
                        'file_name' => $file['name'],
                        'file_path' => 'uploads/' . $fileName,
                        'file_type' => $mime,
                        'file_size' => (int) $file['size'],
                        'uploaded_by' => $_SESSION['admin_id'] ?? null,
                    ]);
                    setFlash('Media uploaded.');
                    redirectAdmin('media.php');
                }
                $errors[] = 'Upload failed.';
            }
        }
    }

    if ($action === 'delete') {
        $id = max(0, (int) ($_POST['id'] ?? 0));
        $media = $id > 0 ? $model->getById($id) : null;
        if ($media) {
            $absolutePath = realpath(__DIR__ . '/../' . $media['file_path']);
            $uploadsRoot = realpath(UPLOADS_PATH);
            if ($absolutePath && $uploadsRoot && str_starts_with($absolutePath, $uploadsRoot) && is_file($absolutePath)) {
                unlink($absolutePath);
            }
            $model->delete($id);
            setFlash('Media deleted.');
        }
        redirectAdmin('media.php');
    }
}

$search = trim((string) ($_GET['q'] ?? ''));
$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 12;

$params = [];
$where = '';
if ($search !== '') {
    $where = ' WHERE file_name LIKE :q OR file_path LIKE :q';
    $params[':q'] = '%' . $search . '%';
}
$countStmt = $db->prepare('SELECT COUNT(*) FROM media_library' . $where);
$countStmt->execute($params);
$total = (int) $countStmt->fetchColumn();
$totalPages = max(1, (int) ceil($total / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$listStmt = $db->prepare('SELECT * FROM media_library' . $where . " ORDER BY uploaded_at DESC LIMIT {$perPage} OFFSET {$offset}");
$listStmt->execute($params);
$mediaItems = $listStmt->fetchAll();

$flash = getFlash();
$csrfToken = csrfToken();
$pageTitle = 'Media Library';
$activeNav = 'media';
require __DIR__ . '/partials/layout_top.php';
?>
<?php if ($flash) : ?><div class="alert <?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div><?php endif; ?>
<?php if (!empty($errors)) : ?><div class="alert danger"><?php foreach ($errors as $error) : ?><p><?php echo e($error); ?></p><?php endforeach; ?></div><?php endif; ?>

<div class="panel">
    <h2 style="margin-top:0;">Upload File</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
        <input type="hidden" name="action" value="upload">
        <div class="form-group">
            <input id="media_file" type="file" name="media_file" accept="image/jpeg,image/png,image/webp,image/gif,application/pdf" required>
            <p class="muted">Allowed: JPG, PNG, WebP, GIF, PDF. Max 5 MB.</p>
        </div>
        <button type="submit">Upload</button>
    </form>
</div>

<div class="panel">
    <div class="list-toolbar">
        <form class="search-form" method="get">
            <input type="text" name="q" value="<?php echo e($search); ?>" placeholder="Search media…">
            <button type="submit">Search</button>
        </form>
        <span class="muted"><?php echo e((string) $total); ?> file<?php echo $total === 1 ? '' : 's'; ?></span>
    </div>
    <table class="admin-table">
        <thead><tr><th>Preview</th><th>File</th><th>Path</th><th>Type</th><th>Size</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($mediaItems as $media) : ?>
            <tr>
                <td>
                    <?php if (strpos((string) $media['file_type'], 'image/') === 0) : ?>
                        <img class="thumb" src="<?php echo e(siteUrl($media['file_path'])); ?>" alt="">
                    <?php else : ?>
                        <span class="badge draft">FILE</span>
                    <?php endif; ?>
                </td>
                <td><?php echo e((string) $media['file_name']); ?></td>
                <td><code><?php echo e((string) $media['file_path']); ?></code></td>
                <td><?php echo e((string) $media['file_type']); ?></td>
                <td><?php echo e((string) round(((int) $media['file_size']) / 1024, 1)); ?> KB</td>
                <td>
                    <div class="admin-actions">
                        <a href="<?php echo e(siteUrl($media['file_path'])); ?>" target="_blank" rel="noopener">View</a>
                        <form method="post" onsubmit="return confirm('Delete this media item?');">
                            <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo e((string) $media['id']); ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($mediaItems)) : ?><tr><td colspan="6" class="muted">No media found.</td></tr><?php endif; ?>
        </tbody>
    </table>
    <?php if ($totalPages > 1) : ?>
        <?php $base = 'media.php?' . ($search !== '' ? 'q=' . urlencode($search) . '&' : '') . 'page='; ?>
        <div class="pagination">
            <a class="<?php echo $page <= 1 ? 'disabled' : ''; ?>" href="<?php echo e($base . ($page - 1)); ?>">‹ Prev</a>
            <?php for ($p = 1; $p <= $totalPages; $p++) : ?>
                <?php if ($p === $page) : ?><span class="current"><?php echo $p; ?></span>
                <?php else : ?><a href="<?php echo e($base . $p); ?>"><?php echo $p; ?></a><?php endif; ?>
            <?php endfor; ?>
            <a class="<?php echo $page >= $totalPages ? 'disabled' : ''; ?>" href="<?php echo e($base . ($page + 1)); ?>">Next ›</a>
        </div>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/partials/layout_bottom.php'; ?>
