<?php

declare(strict_types=1);

require_once __DIR__ . '/_init.php';
requireAdmin();

$model = new InquiryModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();
    $action = $_POST['action'] ?? '';
    $id = max(0, (int) ($_POST['id'] ?? 0));

    if ($id > 0 && $action === 'status') {
        $model->updateStatus($id, (string) ($_POST['status'] ?? 'new'));
        setFlash('Inquiry status updated.');
    }

    if ($id > 0 && $action === 'delete') {
        $model->delete($id);
        setFlash('Inquiry deleted.');
    }

    redirectAdmin('inquiries.php');
}

$inquiries = $model->getAll();
$flash = getFlash();
$csrfToken = csrfToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiries | Afterthink Admin</title>
    <link rel="stylesheet" href="<?php echo assetUrl('css/admin.css'); ?>">
</head>
<body>
<div class="admin-wrapper">
    <header class="admin-header"><h1>Contact Inquiries</h1></header>
    <main class="admin-content">
        <p><a class="admin-link" href="dashboard.php">Back to dashboard</a></p>
        <?php if ($flash) : ?><div class="alert <?php echo e($flash['type']); ?>"><?php echo e($flash['message']); ?></div><?php endif; ?>
        <table class="admin-table">
            <thead>
            <tr><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Status</th><th>Received</th><th>Actions</th></tr>
            </thead>
            <tbody>
            <?php foreach ($inquiries as $inquiry) : ?>
                <tr>
                    <td><?php echo e($inquiry['name']); ?></td>
                    <td><?php echo e($inquiry['email']); ?></td>
                    <td><?php echo e((string) ($inquiry['phone'] ?? '')); ?></td>
                    <td><?php echo nl2br(e($inquiry['message'])); ?></td>
                    <td><?php echo e($inquiry['status']); ?></td>
                    <td><?php echo e($inquiry['created_at']); ?></td>
                    <td>
                        <div class="admin-actions">
                            <form method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
                                <input type="hidden" name="action" value="status">
                                <input type="hidden" name="id" value="<?php echo e((string) $inquiry['id']); ?>">
                                <select name="status">
                                    <option value="new" <?php echo $inquiry['status'] === 'new' ? 'selected' : ''; ?>>New</option>
                                    <option value="read" <?php echo $inquiry['status'] === 'read' ? 'selected' : ''; ?>>Read</option>
                                    <option value="archived" <?php echo $inquiry['status'] === 'archived' ? 'selected' : ''; ?>>Archived</option>
                                </select>
                                <button type="submit">Update</button>
                            </form>
                            <form method="post" onsubmit="return confirm('Delete this inquiry?');">
                                <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo e((string) $inquiry['id']); ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($inquiries)) : ?><tr><td colspan="7" class="muted">No inquiries yet.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>
