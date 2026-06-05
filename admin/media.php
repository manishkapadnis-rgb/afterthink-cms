<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';
requireAdmin();

$model = new MediaModel();
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

$mediaItems = $model->getAll();
$flash = getFlash();
$csrfToken = csrfToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Library | Afterthink Admin</title>
    <link rel="stylesheet" href="<?php echo assetUrl('css/admin.css'); ?>">
</head>
<body>
<div class="admin-wrapper">
    <header class="admin-header"><h1>Media Library</h1></header>
    <main class="admin-content">
        <p><a class="admin-link" href="dashboard.php">Back to dashboard</a></p>
        <?php if ($flash) : ?><div class="alert <?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div><?php endif; ?>
        <?php if (!empty($errors)) : ?><div class="alert danger"><?php foreach ($errors as $error) : ?><p><?php echo e($error); ?></p><?php endforeach; ?></div><?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
            <input type="hidden" name="action" value="upload">
            <div class="form-group">
                <label for="media_file">Upload File</label>
                <input id="media_file" type="file" name="media_file" accept="image/jpeg,image/png,image/webp,image/gif,application/pdf" required>
                <p class="muted">Allowed: JPG, PNG, WebP, GIF, PDF. Max 5 MB.</p>
            </div>
            <button type="submit">Upload</button>
        </form>

        <h2>Library</h2>
        <table class="admin-table">
            <thead><tr><th>File</th><th>Path</th><th>Type</th><th>Size</th><th>Uploaded</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($mediaItems as $media) : ?>
                <tr>
                    <td><?php echo e($media['file_name']); ?></td>
                    <td><?php echo e($media['file_path']); ?></td>
                    <td><?php echo e((string) $media['file_type']); ?></td>
                    <td><?php echo e((string) round(((int) $media['file_size']) / 1024, 1)); ?> KB</td>
                    <td><?php echo e($media['uploaded_at']); ?></td>
                    <td>
                        <div class="admin-actions">
                            <a href="<?php echo siteUrl($media['file_path']); ?>" target="_blank" rel="noopener">View</a>
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
            <?php if (empty($mediaItems)) : ?><tr><td colspan="6" class="muted">No media uploaded yet.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>
